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

try {
    $messageManager = new MessageManager();
    
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $newsletter = isset($_POST['newsletter']);
    
    // Additional validation
    if (strlen($message) < 20) {
        echo json_encode([
            'success' => false, 
            'message' => 'Message must be at least 20 characters long.'
        ]);
        exit;
    }
    
    if (empty($subject)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Please select a subject for your message.'
        ]);
        exit;
    }
    
    // Validate name length
    if (strlen($name) < 2) {
        echo json_encode([
            'success' => false, 
            'message' => 'Name must be at least 2 characters long.'
        ]);
        exit;
    }
    
    // Prepare full message with additional details
    $full_message = "Subject: $subject\n";
    if (!empty($phone)) {
        $full_message .= "Phone: $phone\n";
    }
    if ($newsletter) {
        $full_message .= "Newsletter: Requested subscription\n";
    }
    $full_message .= "\nMessage:\n" . $message;
    
    // Attempt to save message
    $result = $messageManager->saveMessage($name, $email, $full_message);
    
    if ($result['success']) {
        // Log the contact form submission
        error_log("Contact form submission from: $email (Subject: $subject)");
        
        // If newsletter subscription is requested, we could add that logic here
        if ($newsletter) {
            // TODO: Add to newsletter subscription list
            // This could be implemented later with a newsletter service
        }
        
        echo json_encode($result);
    } else {
        echo json_encode($result);
    }
    
} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An unexpected error occurred. Please try again or contact us directly.'
    ]);
}
?>