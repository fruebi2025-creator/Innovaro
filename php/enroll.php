<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Check if user is logged in
if (!is_logged_in()) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to enroll in services.']);
    exit;
}

try {
    $enrollmentManager = new EnrollmentManager();
    
    // Get form data
    $service_id = intval($_POST['service_id'] ?? 0);
    
    // Validate service ID
    if ($service_id <= 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'Invalid service ID provided.'
        ]);
        exit;
    }
    
    // Verify service exists
    $serviceManager = new ServiceManager();
    $service = $serviceManager->getServiceById($service_id);
    
    if (!$service) {
        echo json_encode([
            'success' => false, 
            'message' => 'Service not found or no longer available.'
        ]);
        exit;
    }
    
    // Attempt enrollment
    $result = $enrollmentManager->enrollUser($_SESSION['user_id'], $service_id);
    
    if ($result['success']) {
        // Log successful enrollment
        error_log("User enrolled: {$_SESSION['user_email']} in service: {$service['title']} (ID: $service_id)");
        
        echo json_encode($result);
    } else {
        echo json_encode($result);
    }
    
} catch (Exception $e) {
    error_log("Enrollment error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An unexpected error occurred during enrollment. Please try again.'
    ]);
}
?>