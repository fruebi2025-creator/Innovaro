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
    
    $name = isset($input['name']) ? trim($input['name']) : '';
    $email = isset($input['email']) ? trim($input['email']) : '';
    $password = isset($input['password']) ? $input['password'] : '';
    $confirm_password = isset($input['confirm_password']) ? $input['confirm_password'] : '';
    $role = isset($input['role']) ? $input['role'] : 'client';
    
    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $response = array(
            'success' => false,
            'message' => 'All fields are required.'
        );
    } elseif ($password !== $confirm_password) {
        $response = array(
            'success' => false,
            'message' => 'Passwords do not match.'
        );
    } elseif (strlen($password) < 6) {
        $response = array(
            'success' => false,
            'message' => 'Password must be at least 6 characters long.'
        );
    } else {
        $auth = new Auth();
        $result = $auth->register($name, $email, $password, $role);
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