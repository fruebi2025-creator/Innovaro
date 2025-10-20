<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/functions.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $serviceManager = new ServiceManager();
    
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;
    
    try {
        if ($category) {
            $services = $serviceManager->getServicesByCategory($category);
        } else {
            $services = $serviceManager->getAllServices();
        }
        
        // Apply limit if specified
        if ($limit && count($services) > $limit) {
            $services = array_slice($services, 0, $limit);
        }
        
        // Add service icons
        foreach ($services as &$service) {
            $service['icon'] = getServiceIcon($service['category']);
        }
        
        $response = array(
            'success' => true,
            'services' => $services
        );
    } catch (Exception $e) {
        $response = array(
            'success' => false,
            'message' => 'Error fetching services: ' . $e->getMessage()
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