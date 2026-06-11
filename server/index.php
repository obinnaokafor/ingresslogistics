<?php
session_start();
header("Access-Control-Allow-Origin: https://ingresslogistics.com");
header("Access-Control-Allow-Origin: http://localhost:8111");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// CORS preflight
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require 'vendor/autoload.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$data = json_decode(file_get_contents('php://input'), true) ?: [];

// NOTE: known no-op CSRF check carried over from the original. Both sides are
// currently undefined so this passes — left in place intentionally; harden later
// (issue a token server-side, send + validate it). See project notes.
if (($data['csrf_token'] ?? null) !== ($_SERVER['csrf_token'] ?? null)) {
    exit(0);
}

/* ------------------------------------------------------------------
   Generic enquiry renderer.
   Every form posts a `service_line` plus whatever fields are relevant
   to that line; we render all of them rather than hardcoding per form.
   ------------------------------------------------------------------ */

// Per-line email subject + human heading
$lines = [
    'removals'     => 'Home Removals',
    'storage'      => 'Storage',
    'waste'        => 'Waste Removal',
    'decluttering' => 'Decluttering & Reorganisation',
    'contact'      => 'General Enquiry',
];
$line     = $data['service_line'] ?? '';
$lineName = $lines[$line] ?? 'New Enquiry';
$subject  = 'New ' . $lineName . ' Enquiry';

// Friendly labels for known keys; anything else is humanised automatically.
$labels = [
    'name' => 'Name', 'email' => 'Email', 'phone' => 'Phone',
    'service' => 'Service', 'service_line' => 'Service line',
    'pickup' => 'Pickup Address', 'pickup_floor' => 'Pickup Floor',
    'delivery' => 'Delivery Address', 'delivery_floor' => 'Delivery Floor',
    'date' => 'Preferred Date', 'details' => 'Additional Details',
    'storage_type' => 'Storage Type', 'duration' => 'Storage Duration',
    'volume' => 'Approx. Volume / Items',
    'waste_type' => 'Waste Type', 'amount' => 'Approx. Amount', 'access' => 'Access',
    'area' => 'Area / Focus', 'property_size' => 'Property Size',
    'postcode' => 'Postcode', 'location' => 'Location', 'message' => 'Message',
];

// Order: contact details last; keep service_line out of the visible list (used in subject)
$skip = ['csrf_token', 'service_line'];
$contactKeys = ['name', 'email', 'phone'];

$rows = [];
foreach ($data as $key => $value) {
    if (in_array($key, $skip, true)) continue;
    if (in_array($key, $contactKeys, true)) continue;
    if ($value === '' || $value === null) continue;
    $label = $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
    $rows[$label] = is_array($value) ? implode(', ', $value) : $value;
}
// Append contact details at the end
foreach ($contactKeys as $key) {
    if (!empty($data[$key])) {
        $rows[$labels[$key]] = $data[$key];
    }
}

// Build text + HTML bodies
$email_body = "New {$lineName} enquiry:\n\n";
$body_html  = "<h1>New {$lineName} Enquiry</h1>";
foreach ($rows as $label => $value) {
    $email_body .= $label . ": " . $value . "\n";
    $body_html  .= "<p><strong>" . htmlspecialchars($label) . ":</strong> " . htmlspecialchars($value) . "</p>";
}

$sender_email    = $_ENV['SENDER_EMAIL'];
$recipient_email = $_ENV['RECEPIENT_EMAIL'];

$client = new SesClient([
    'version' => 'latest',
    'region'  => $_ENV['AWS_REGION'],
    'credentials' => [
        'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
        'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
    ],
]);

try {
    $result = $client->sendEmail([
        'Destination' => ['ToAddresses' => [$recipient_email]],
        'Source'      => $sender_email,
        'Message'     => [
            'Subject' => ['Charset' => 'UTF-8', 'Data' => $subject],
            'Body'    => [
                'Html' => ['Charset' => 'UTF-8', 'Data' => $body_html],
                'Text' => ['Charset' => 'UTF-8', 'Data' => $email_body],
            ],
        ],
    ]);
    echo "Email sent! Message ID: " . $result['MessageId'] . "\n";
} catch (AwsException $e) {
    echo "Error sending email: " . $e->getMessage() . "\n";
}
?>
