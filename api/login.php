<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/auth.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        $input = $_POST; // Fallback to form data
    }
    
    $email = isset($input['email']) ? trim($input['email']) : '';
    $password = isset($input['password']) ? $input['password'] : '';
    
    if (empty($email) || empty($password)) {
        $response = array(
            'success' => false,
            'message' => 'Email and password are required.'
        );
    } else {
        $auth = new Auth();
        $result = $auth->login($email, $password);
        $response = $result;
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request method.'
    );
}

echo json_encode($response);
?>