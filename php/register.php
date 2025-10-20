<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $auth = new Auth();
    
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'client';
    $terms = isset($_POST['terms']);
    $newsletter = isset($_POST['newsletter']);
    
    // Additional validation
    if (!$terms) {
        echo json_encode([
            'success' => false, 
            'message' => 'You must agree to the Terms of Service and Privacy Policy.'
        ]);
        exit;
    }
    
    if ($password !== $confirm_password) {
        echo json_encode([
            'success' => false, 
            'message' => 'Passwords do not match.'
        ]);
        exit;
    }
    
    if (strlen($password) < 6) {
        echo json_encode([
            'success' => false, 
            'message' => 'Password must be at least 6 characters long.'
        ]);
        exit;
    }
    
    // Validate name
    if (strlen($name) < 2) {
        echo json_encode([
            'success' => false, 
            'message' => 'Name must be at least 2 characters long.'
        ]);
        exit;
    }
    
    // Ensure role is valid
    if (!in_array($role, ['client', 'admin'])) {
        $role = 'client';
    }
    
    // Attempt registration
    $result = $auth->register($name, $email, $password, $role);
    
    if ($result['success']) {
        // If newsletter subscription is requested, we could add that logic here
        if ($newsletter) {
            // TODO: Add to newsletter subscription list
            // This could be implemented later with a newsletter service
        }
        
        // Log successful registration
        error_log("New user registered: $email ($role)");
        
        echo json_encode([
            'success' => true,
            'message' => 'Registration successful! Please log in to access your account.'
        ]);
    } else {
        echo json_encode($result);
    }
    
} catch (Exception $e) {
    error_log("Registration error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An unexpected error occurred. Please try again.'
    ]);
}
?>