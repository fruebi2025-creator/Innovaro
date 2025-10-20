<?php
/**
 * Database Configuration for Innovaro Global Services
 * Update these settings according to your server configuration
 */

// Database connection parameters
define('DB_HOST', 'localhost');
define('DB_NAME', 'innovaro_db');
define('DB_USER', 'root');  // Change this to your MySQL username
define('DB_PASS', '');      // Change this to your MySQL password

// Site configuration
define('SITE_NAME', 'Innovaro Global Services');
define('SITE_URL', 'http://localhost/innovaro-website');
define('CONTACT_EMAIL', 'igs@innovaro.com.ng');

// Security settings
define('HASH_ALGORITHM', PASSWORD_BCRYPT);
define('HASH_COST', 12);

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection class
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                )
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // Prevent cloning and unserialization
    private function __clone() {}
    public function __wakeup() {}
}

// Get database connection
function getDB() {
    return Database::getInstance()->getConnection();
}

// Utility functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function is_admin() {
    return is_logged_in() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function require_login() {
    if (!is_logged_in()) {
        redirect('login.php');
    }
}

function require_admin() {
    if (!is_admin()) {
        redirect('index.php');
    }
}

// Error handling
function handle_error($message) {
    error_log($message);
    if (!empty($_SESSION)) {
        $_SESSION['error'] = 'An error occurred. Please try again.';
    }
}

// Flash message functions
function set_flash_message($type, $message) {
    $_SESSION['flash_' . $type] = $message;
}

function get_flash_message($type) {
    if (isset($_SESSION['flash_' . $type])) {
        $message = $_SESSION['flash_' . $type];
        unset($_SESSION['flash_' . $type]);
        return $message;
    }
    return null;
}
?>