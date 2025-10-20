<?php
require_once 'config.php';

class Auth {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    /**
     * Register a new user
     */
    public function register($name, $email, $password, $role = 'client') {
        try {
            // Validate input
            if (empty($name) || empty($email) || empty($password)) {
                return array('success' => false, 'message' => 'All fields are required.');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return array('success' => false, 'message' => 'Invalid email format.');
            }
            
            if (strlen($password) < 6) {
                return array('success' => false, 'message' => 'Password must be at least 6 characters long.');
            }
            
            // Check if user already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                return array('success' => false, 'message' => 'Email already exists.');
            }
            
            // Hash password
            $hashed_password = password_hash($password, HASH_ALGORITHM, ['cost' => HASH_COST]);
            
            // Insert new user
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([sanitize_input($name), $email, $hashed_password, $role]);
            
            if ($result) {
                return array('success' => true, 'message' => 'Registration successful!');
            } else {
                return array('success' => false, 'message' => 'Registration failed. Please try again.');
            }
            
        } catch (PDOException $e) {
            handle_error("Registration error: " . $e->getMessage());
            return array('success' => false, 'message' => 'Database error occurred.');
        }
    }
    
    /**
     * Authenticate user login
     */
    public function login($email, $password) {
        try {
            // Validate input
            if (empty($email) || empty($password)) {
                return array('success' => false, 'message' => 'Email and password are required.');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return array('success' => false, 'message' => 'Invalid email format.');
            }
            
            // Get user from database
            $stmt = $this->db->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if (!$user) {
                return array('success' => false, 'message' => 'Invalid email or password.');
            }
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['login_time'] = time();
                
                return array('success' => true, 'message' => 'Login successful!', 'user' => $user);
            } else {
                return array('success' => false, 'message' => 'Invalid email or password.');
            }
            
        } catch (PDOException $e) {
            handle_error("Login error: " . $e->getMessage());
            return array('success' => false, 'message' => 'Database error occurred.');
        }
    }
    
    /**
     * Logout user
     */
    public function logout() {
        // Destroy session
        $_SESSION = array();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        
        session_destroy();
        return true;
    }
    
    /**
     * Get current user information
     */
    public function getCurrentUser() {
        if (is_logged_in()) {
            try {
                $stmt = $this->db->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                return $stmt->fetch();
            } catch (PDOException $e) {
                handle_error("Get user error: " . $e->getMessage());
                return null;
            }
        }
        return null;
    }
    
    /**
     * Update user profile
     */
    public function updateProfile($name, $email) {
        if (!is_logged_in()) {
            return array('success' => false, 'message' => 'User not logged in.');
        }
        
        try {
            // Validate input
            if (empty($name) || empty($email)) {
                return array('success' => false, 'message' => 'Name and email are required.');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return array('success' => false, 'message' => 'Invalid email format.');
            }
            
            // Check if email exists for another user
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$email, $_SESSION['user_id']]);
            if ($stmt->fetch()) {
                return array('success' => false, 'message' => 'Email already exists.');
            }
            
            // Update user
            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $result = $stmt->execute([sanitize_input($name), $email, $_SESSION['user_id']]);
            
            if ($result) {
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                return array('success' => true, 'message' => 'Profile updated successfully!');
            } else {
                return array('success' => false, 'message' => 'Update failed. Please try again.');
            }
            
        } catch (PDOException $e) {
            handle_error("Update profile error: " . $e->getMessage());
            return array('success' => false, 'message' => 'Database error occurred.');
        }
    }
    
    /**
     * Change user password
     */
    public function changePassword($current_password, $new_password) {
        if (!is_logged_in()) {
            return array('success' => false, 'message' => 'User not logged in.');
        }
        
        try {
            // Validate input
            if (empty($current_password) || empty($new_password)) {
                return array('success' => false, 'message' => 'Current and new passwords are required.');
            }
            
            if (strlen($new_password) < 6) {
                return array('success' => false, 'message' => 'New password must be at least 6 characters long.');
            }
            
            // Get current password hash
            $stmt = $this->db->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();
            
            if (!$user || !password_verify($current_password, $user['password'])) {
                return array('success' => false, 'message' => 'Current password is incorrect.');
            }
            
            // Hash new password
            $hashed_password = password_hash($new_password, HASH_ALGORITHM, ['cost' => HASH_COST]);
            
            // Update password
            $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
            $result = $stmt->execute([$hashed_password, $_SESSION['user_id']]);
            
            if ($result) {
                return array('success' => true, 'message' => 'Password changed successfully!');
            } else {
                return array('success' => false, 'message' => 'Password change failed. Please try again.');
            }
            
        } catch (PDOException $e) {
            handle_error("Change password error: " . $e->getMessage());
            return array('success' => false, 'message' => 'Database error occurred.');
        }
    }
}
?>