<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require 'vendor/autoload.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
// load dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$data = json_decode(file_get_contents('php://input'), true);
// allow CORS for local development

// construct an email message with the details
$email_body = "New moving service request:\n\n";
$email_body .= "Name: " . ($data['name'] ?? 'N/A') . "\n";
$email_body .= "Email: " . ($data['email'] ?? 'N/A') . "\n";
$email_body .= "Phone: " . ($data['phone'] ?? 'N/A') . "\n";
$email_body .= "Service: " . ($data['service'] ?? 'N/A') . "\n";
$email_body .= "Pickup Address: " . ($data['pickup'] ?? 'N/A') . "\n";
$email_body .= "Pickup Floor: " . ($data['pickup_floor'] ?? 'N/A') . "\n";
$email_body .= "Delivery Address: " . ($data['delivery'] ?? 'N/A') . "\n";
$email_body .= "Delivery Floor: " . ($data['delivery_floor'] ?? 'N/A') . "\n";
$email_body .= "Date: " . ($data['date'] ?? 'N/A') . "\n";
$email_body .= "Additional Details: " . ($data['details'] ?? 'N/A') . "\n";
$sender_email = $_ENV['SENDER_EMAIL'];
$recipient_email = $_ENV['RECEPIENT_EMAIL'];
$subject = 'New Quote Request';
$body_html = "<h1>New Moving Service Request</h1>
              <p><strong>Name:</strong> " . ($data['name'] ?? 'N/A') . "</p>
              <p><strong>Email:</strong> " . ($data['email'] ?? 'N/A') . "</p>
              <p><strong>Phone:</strong> " . ($data['phone'] ?? 'N/A') . "</p>
              <p><strong>Service:</strong> " . ($data['service'] ?? 'N/A') . "</p>
              <p><strong>Pickup Address:</strong> " . ($data['pickup'] ?? 'N/A') . "</p>
              <p><strong>Pickup Floor:</strong> " . ($data['pickup_floor'] ?? 'N/A') . "</p>
              <p><strong>Delivery Address:</strong> " . ($data['delivery'] ?? 'N/A') . "</p>
              <p><strong>Delivery Floor:</strong> " . ($data['delivery_floor'] ?? 'N/A') . "</p>
              <p><strong>Date:</strong> " . ($data['date'] ?? 'N/A') . "</p>
              <p><strong>Additional Details:</strong> " . ($data['details'] ?? 'N/A') . "</p>";
$client = new SesClient([
    'version' => 'latest',
    'region'  => $_ENV['AWS_REGION'],
    'credentials' => [
        'key' => $_ENV['AWS_ACCESS_KEY_ID'],
        'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
    ],
]);
try {
    $result = $client->sendEmail([
        'Destination' => [
            'ToAddresses' => [$recipient_email],
        ],
        'Source' => $sender_email,
        'Message' => [
            'Subject' => [
                'Charset' => 'UTF-8',
                'Data' => $subject,
            ],
            'Body' => [
                'Html' => [
                    'Charset' => 'UTF-8',
                    'Data' => $body_html,
                ],
                'Text' => [
                    'Charset' => 'UTF-8',
                    'Data' => $email_body,
                ],
            ],
        ],
    ]);
    echo "Email sent! Message ID: " . $result['MessageId'] . "\n";
} catch (AwsException $e) {
    echo "Error sending email: " . $e->getMessage() . "\n";
}
?>