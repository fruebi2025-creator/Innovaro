<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/functions.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!is_logged_in()) {
        $response = array(
            'success' => false,
            'message' => 'You must be logged in to enroll in services.'
        );
        echo json_encode($response);
        exit;
    }
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        $input = $_POST; // Fallback to form data
    }
    
    $service_id = isset($input['service_id']) ? intval($input['service_id']) : 0;
    
    if (empty($service_id)) {
        $response = array(
            'success' => false,
            'message' => 'Service ID is required.'
        );
    } else {
        $enrollmentManager = new EnrollmentManager();
        $result = $enrollmentManager->enrollUser($_SESSION['user_id'], $service_id);
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