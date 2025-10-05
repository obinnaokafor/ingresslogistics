<?php
// Server logic - headers and request validation handled by api.php

require 'vendor/autoload.php';

// Parse JSON input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate JSON parsing
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data']);
    exit();
}

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Validate required environment variables
$required_env = ['SENDER_EMAIL', 'RECEPIENT_EMAIL', 'AWS_REGION', 'AWS_ACCESS_KEY_ID', 'AWS_SECRET_ACCESS_KEY'];
foreach ($required_env as $var) {
    if (!isset($_ENV[$var])) {
        http_response_code(500);
        echo json_encode(['error' => 'Server configuration error']);
        exit();
    }
}

// Validate required fields
$required_fields = ['name', 'email', 'phone', 'service', 'pickup', 'delivery', 'pickup_floor', 'delivery_floor', 'date'];
foreach ($required_fields as $field) {
    if (!isset($data[$field]) || trim($data[$field]) === '') {
        http_response_code(400);
        echo json_encode(['error' => "Missing required field: $field"]);
        exit();
    }
}

// Validate email format
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email format']);
    exit();
}

// Sanitize input data
foreach ($data as $key => $value) {
    if (is_string($value)) {
        $data[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
}

// Construct email message with sanitized data
$email_body = "New moving service request:\n\n";
$email_body .= "Name: " . $data['name'] . "\n";
$email_body .= "Email: " . $data['email'] . "\n";
$email_body .= "Phone: " . $data['phone'] . "\n";
$email_body .= "Service: " . $data['service'] . "\n";
$email_body .= "Pickup Address: " . $data['pickup'] . "\n";
$email_body .= "Pickup Floor: " . $data['pickup_floor'] . "\n";
$email_body .= "Delivery Address: " . $data['delivery'] . "\n";
$email_body .= "Delivery Floor: " . $data['delivery_floor'] . "\n";
$email_body .= "Date: " . $data['date'] . "\n";
$email_body .= "Additional Details: " . ($data['details'] ?? 'None') . "\n";
$sender_email = $_ENV['SENDER_EMAIL'];
$recipient_email = $_ENV['RECEPIENT_EMAIL'];
$subject = 'New Quote Request';
$body_html = "<h1>New Moving Service Request</h1>
              <p><strong>Name:</strong> " . $data['name'] . "</p>
              <p><strong>Email:</strong> " . $data['email'] . "</p>
              <p><strong>Phone:</strong> " . $data['phone'] . "</p>
              <p><strong>Service:</strong> " . $data['service'] . "</p>
              <p><strong>Pickup Address:</strong> " . $data['pickup'] . "</p>
              <p><strong>Pickup Floor:</strong> " . $data['pickup_floor'] . "</p>
              <p><strong>Delivery Address:</strong> " . $data['delivery'] . "</p>
              <p><strong>Delivery Floor:</strong> " . $data['delivery_floor'] . "</p>
              <p><strong>Date:</strong> " . $data['date'] . "</p>
              <p><strong>Additional Details:</strong> " . ($data['details'] ?? 'None') . "</p>";
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
    
    // Return success response
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Quote request sent successfully',
        'messageId' => $result['MessageId']
    ]);
    
} catch (AwsException $e) {
    // Log error for debugging (consider using proper logging)
    error_log('AWS SES Error: ' . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to send email. Please try again later.'
    ]);
} catch (Exception $e) {
    // Handle any other errors
    error_log('General Error: ' . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Server error. Please try again later.'
    ]);
}
?>
