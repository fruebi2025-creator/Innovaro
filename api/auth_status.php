<?php
header('Content-Type: application/json');
require_once '../includes/config.php';

$response = array();

if (is_logged_in()) {
    $response = array(
        'success' => true,
        'isLoggedIn' => true,
        'user' => array(
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role']
        )
    );
} else {
    $response = array(
        'success' => true,
        'isLoggedIn' => false,
        'user' => null
    );
}

echo json_encode($response);
?>