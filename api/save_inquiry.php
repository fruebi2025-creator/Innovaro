<?php
header('Content-Type: application/json');
require __DIR__ . '/db.php';

// Accept only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// read JSON
$input = json_decode(file_get_contents('php://input'), true);
$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$phone = trim($input['phone'] ?? '');
$message = trim($input['message'] ?? '');

if (!$name || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Basic validation (improve as needed)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO inquiries (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':phone' => $phone,
    ':message' => $message
]);

echo json_encode(['success' => true, 'message' => 'Inquiry saved']);
