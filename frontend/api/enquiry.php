<?php
/* ============================================================
   Ingress Logistics — enquiry handler (same-origin)
   Served from the main site at /api/enquiry.php, so there is NO CORS:
   the browser only ever talks to its own origin.

   Security:
   - POST only
   - same-origin Origin check (when the header is present)
   - CSRF token (validated against the PHP session)
   - honeypot field ("company") to trap bots
   - simple per-IP rate limit
   - input validation + length caps
   Composer deps (AWS SDK) and .env live OUTSIDE the web root (../../server).
   ============================================================ */

declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

function respond(int $code, array $payload): void {
    http_response_code($code);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

/* ---- Method ---- */
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    respond(405, ['ok' => false, 'error' => 'method_not_allowed']);
}

/* ---- Same-origin guard (Origin header is sent on cross-origin POSTs) ---- */
$host = $_SERVER['HTTP_HOST'] ?? '';
if (!empty($_SERVER['HTTP_ORIGIN'])) {
    $originHost = parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST) ?? '';
    if ($originHost !== '' && strcasecmp($originHost, $host) !== 0) {
        respond(403, ['ok' => false, 'error' => 'bad_origin']);
    }
}

session_start();

$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data)) {
    respond(400, ['ok' => false, 'error' => 'bad_request']);
}

/* ---- Honeypot: bots fill hidden fields. Pretend success, send nothing. ---- */
if (!empty($data['company'])) {
    respond(200, ['ok' => true]);
}

/* ---- CSRF ---- */
$token = (string)($data['csrf_token'] ?? '');
if ($token === '' || !hash_equals((string)($_SESSION['csrf_token'] ?? ''), $token)) {
    respond(419, ['ok' => false, 'error' => 'invalid_token']);
}

/* ---- Rate limit: max 5 submissions / 10 min per IP ---- */
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rlFile = sys_get_temp_dir() . '/il_rl_' . md5($ip);
$now = time(); $window = 600; $max = 5;
$hits = is_file($rlFile) ? (json_decode((string)file_get_contents($rlFile), true) ?: []) : [];
$hits = array_values(array_filter($hits, fn($t) => $t > $now - $window));
if (count($hits) >= $max) {
    respond(429, ['ok' => false, 'error' => 'rate_limited']);
}
$hits[] = $now;
@file_put_contents($rlFile, json_encode($hits), LOCK_EX);

/* ---- Validation ---- */
$clean = static function ($v): string {
    if (is_array($v)) $v = implode(', ', $v);
    $v = trim((string)$v);
    return mb_substr($v, 0, 2000);
};
$name  = $clean($data['name'] ?? '');
$email = $clean($data['email'] ?? '');
$phone = $clean($data['phone'] ?? '');

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $phone === '') {
    respond(422, ['ok' => false, 'error' => 'validation', 'message' => 'Name, a valid email and a phone number are required.']);
}

/* ============================================================
   Build the email (renders whatever fields the form sent).
   ============================================================ */
$lines = [
    'removals'     => 'Home Removals',
    'storage'      => 'Storage',
    'waste'        => 'Waste Removal',
    'decluttering' => 'Decluttering & Reorganisation',
    'contact'      => 'General Enquiry',
];
$line     = (string)($data['service_line'] ?? '');
$lineName = $lines[$line] ?? 'New Enquiry';
$subject  = 'New ' . $lineName . ' Enquiry';

$labels = [
    'service' => 'Service', 'pickup' => 'Pickup Address', 'pickup_floor' => 'Pickup Floor',
    'delivery' => 'Delivery Address', 'delivery_floor' => 'Delivery Floor',
    'date' => 'Preferred Date', 'details' => 'Additional Details',
    'storage_type' => 'Storage Type', 'duration' => 'Storage Duration', 'volume' => 'Approx. Volume / Items',
    'waste_type' => 'Waste Type', 'amount' => 'Approx. Amount', 'access' => 'Access',
    'area' => 'Area / Focus', 'property_size' => 'Property Size',
    'postcode' => 'Postcode', 'location' => 'Location', 'message' => 'Message',
];
$skip = ['csrf_token', 'service_line', 'company', 'name', 'email', 'phone'];

$rows = [];
foreach ($data as $key => $value) {
    if (in_array($key, $skip, true)) continue;
    $val = $clean($value);
    if ($val === '') continue;
    $rows[$labels[$key] ?? ucwords(str_replace('_', ' ', $key))] = $val;
}
// Contact details last
$rows['Name']  = $name;
$rows['Email'] = $email;
$rows['Phone'] = $phone;

$email_body = "New {$lineName} enquiry:\n\n";
$body_html  = "<h1>New {$lineName} Enquiry</h1>";
foreach ($rows as $label => $value) {
    $email_body .= $label . ": " . $value . "\n";
    $body_html  .= "<p><strong>" . htmlspecialchars($label) . ":</strong> " . nl2br(htmlspecialchars($value)) . "</p>";
}

/* ---- Composer deps + .env (kept outside the web root) ---- */
$autoloads = [
    __DIR__ . '/../../server/vendor/autoload.php',
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../vendor/autoload.php',
];
$autoload = null;
foreach ($autoloads as $cand) { if (is_file($cand)) { $autoload = $cand; break; } }
if ($autoload === null) {
    error_log('enquiry.php: composer autoload not found');
    respond(503, ['ok' => false, 'error' => 'unavailable']);
}
require $autoload;

$envDir = null;
foreach ([__DIR__ . '/../../server', __DIR__ . '/..', __DIR__ . '/../..'] as $cand) {
    if (is_file($cand . '/.env')) { $envDir = $cand; break; }
}
if ($envDir !== null) {
    Dotenv\Dotenv::createImmutable($envDir)->safeLoad();
}

try {
    $client = new Aws\Ses\SesClient([
        'version' => 'latest',
        'region'  => $_ENV['AWS_REGION'] ?? 'eu-west-2',
        'credentials' => [
            'key'    => $_ENV['AWS_ACCESS_KEY_ID'] ?? '',
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'] ?? '',
        ],
    ]);
    $client->sendEmail([
        'Destination' => ['ToAddresses' => [$_ENV['RECEPIENT_EMAIL'] ?? '']],
        'Source'      => $_ENV['SENDER_EMAIL'] ?? '',
        'ReplyToAddresses' => [$email],
        'Message' => [
            'Subject' => ['Charset' => 'UTF-8', 'Data' => $subject],
            'Body'    => [
                'Html' => ['Charset' => 'UTF-8', 'Data' => $body_html],
                'Text' => ['Charset' => 'UTF-8', 'Data' => $email_body],
            ],
        ],
    ]);
    respond(200, ['ok' => true]);
} catch (Throwable $e) {
    error_log('enquiry.php SES error: ' . $e->getMessage());
    respond(502, ['ok' => false, 'error' => 'send_failed']);
}
