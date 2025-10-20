<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/auth.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $auth = new Auth();
    $result = $auth->logout();
    
    if ($result) {
        $response = array(
            'success' => true,
            'message' => 'Logged out successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Logout failed.'
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request method.'
    );
}

echo json_encode($response);
?>