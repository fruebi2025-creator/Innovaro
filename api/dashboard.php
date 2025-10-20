<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if user is logged in
    if (!is_logged_in()) {
        $response = array(
            'success' => false,
            'message' => 'You must be logged in to access dashboard data.'
        );
        echo json_encode($response);
        exit;
    }
    
    try {
        $auth = new Auth();
        $enrollmentManager = new EnrollmentManager();
        $serviceManager = new ServiceManager();
        
        $currentUser = $auth->getCurrentUser();
        $userEnrollments = $enrollmentManager->getUserEnrollments($_SESSION['user_id']);
        $recentServices = array_slice($serviceManager->getAllServices(), 0, 6);
        
        // Add service icons to recent services
        foreach ($recentServices as &$service) {
            $service['icon'] = getServiceIcon($service['category']);
        }
        
        // Calculate enrollment statistics
        $totalEnrollments = count($userEnrollments);
        $completedEnrollments = array_filter($userEnrollments, function($e) { 
            return $e['status'] === 'completed'; 
        });
        $activeEnrollments = array_filter($userEnrollments, function($e) { 
            return $e['status'] === 'active'; 
        });
        
        $response = array(
            'success' => true,
            'user' => $currentUser,
            'enrollments' => $userEnrollments,
            'recentServices' => $recentServices,
            'stats' => array(
                'totalEnrollments' => $totalEnrollments,
                'completedEnrollments' => count($completedEnrollments),
                'activeEnrollments' => count($activeEnrollments),
                'memberSince' => formatDate($currentUser['created_at'])
            )
        );
    } catch (Exception $e) {
        $response = array(
            'success' => false,
            'message' => 'Error fetching dashboard data: ' . $e->getMessage()
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