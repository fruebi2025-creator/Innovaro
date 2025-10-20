<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/functions.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $faqManager = new FAQManager();
    
    try {
        $faqs = $faqManager->getAllFAQs();
        
        $response = array(
            'success' => true,
            'faqs' => $faqs
        );
    } catch (Exception $e) {
        $response = array(
            'success' => false,
            'message' => 'Error fetching FAQs: ' . $e->getMessage()
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