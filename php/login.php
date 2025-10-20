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
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Attempt login
    $result = $auth->login($email, $password);
    
    if ($result['success']) {
        // Set remember me cookie if requested
        if ($remember) {
            $expire = time() + (30 * 24 * 60 * 60); // 30 days
            setcookie('remember_token', base64_encode($email), $expire, '/');
        }
        
        // Determine redirect URL based on user role
        $redirect_url = 'dashboard.php';
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            $redirect_url = 'admin/dashboard.php';
        }
        
        echo json_encode([
            'success' => true, 
            'message' => $result['message'],
            'redirect' => $redirect_url
        ]);
    } else {
        echo json_encode($result);
    }
    
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An unexpected error occurred. Please try again.'
    ]);
}
?>