<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

// Ensure user is logged in
if (!is_logged_in()) {
    redirect('../index.php');
}

$auth = new Auth();
$auth->logout();

// Clear remember me cookie if it exists
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/');
}

// Set success message
set_flash_message('success', 'You have been successfully logged out.');

// Redirect to home page
redirect('../index.php');
?>