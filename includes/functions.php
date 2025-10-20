<?php
require_once 'config.php';

/**
 * Services Management Functions
 */
class ServiceManager {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    /**
     * Get all active services
     */
    public function getAllServices() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM services WHERE is_active = 1 ORDER BY category, title");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            handle_error("Get services error: " . $e->getMessage());
            return array();
        }
    }
    
    /**
     * Get services by category
     */
    public function getServicesByCategory($category) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM services WHERE category = ? AND is_active = 1 ORDER BY title");
            $stmt->execute([$category]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            handle_error("Get services by category error: " . $e->getMessage());
            return array();
        }
    }
    
    /**
     * Get service by ID
     */
    public function getServiceById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ? AND is_active = 1");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            handle_error("Get service by ID error: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Add new service (admin only)
     */
    public function addService($title, $description, $category, $image = null) {
        try {
            $stmt = $this->db->prepare("INSERT INTO services (title, description, category, image) VALUES (?, ?, ?, ?)");
            return $stmt->execute([sanitize_input($title), sanitize_input($description), $category, $image]);
        } catch (PDOException $e) {
            handle_error("Add service error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Update service (admin only)
     */
    public function updateService($id, $title, $description, $category, $image = null) {
        try {
            if ($image) {
                $stmt = $this->db->prepare("UPDATE services SET title = ?, description = ?, category = ?, image = ? WHERE id = ?");
                return $stmt->execute([sanitize_input($title), sanitize_input($description), $category, $image, $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE services SET title = ?, description = ?, category = ? WHERE id = ?");
                return $stmt->execute([sanitize_input($title), sanitize_input($description), $category, $id]);
            }
        } catch (PDOException $e) {
            handle_error("Update service error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete service (admin only)
     */
    public function deleteService($id) {
        try {
            $stmt = $this->db->prepare("UPDATE services SET is_active = 0 WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            handle_error("Delete service error: " . $e->getMessage());
            return false;
        }
    }
}

/**
 * Contact Messages Management
 */
class MessageManager {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    /**
     * Save contact message
     */
    public function saveMessage($name, $email, $message) {
        try {
            // Validate input
            if (empty($name) || empty($email) || empty($message)) {
                return array('success' => false, 'message' => 'All fields are required.');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return array('success' => false, 'message' => 'Invalid email format.');
            }
            
            $stmt = $this->db->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
            $result = $stmt->execute([sanitize_input($name), $email, sanitize_input($message)]);
            
            if ($result) {
                return array('success' => true, 'message' => 'Message sent successfully! We will get back to you soon.');
            } else {
                return array('success' => false, 'message' => 'Failed to send message. Please try again.');
            }
            
        } catch (PDOException $e) {
            handle_error("Save message error: " . $e->getMessage());
            return array('success' => false, 'message' => 'Database error occurred.');
        }
    }
    
    /**
     * Get all messages (admin only)
     */
    public function getAllMessages() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM messages ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            handle_error("Get messages error: " . $e->getMessage());
            return array();
        }
    }
    
    /**
     * Mark message as read (admin only)
     */
    public function markAsRead($id) {
        try {
            $stmt = $this->db->prepare("UPDATE messages SET is_read = 1 WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            handle_error("Mark message as read error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete message (admin only)
     */
    public function deleteMessage($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM messages WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            handle_error("Delete message error: " . $e->getMessage());
            return false;
        }
    }
}

/**
 * FAQ Management
 */
class FAQManager {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    /**
     * Get all active FAQs
     */
    public function getAllFAQs() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order, id");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            handle_error("Get FAQs error: " . $e->getMessage());
            return array();
        }
    }
    
    /**
     * Add new FAQ (admin only)
     */
    public function addFAQ($question, $answer, $sort_order = 0) {
        try {
            $stmt = $this->db->prepare("INSERT INTO faqs (question, answer, sort_order) VALUES (?, ?, ?)");
            return $stmt->execute([sanitize_input($question), sanitize_input($answer), $sort_order]);
        } catch (PDOException $e) {
            handle_error("Add FAQ error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Update FAQ (admin only)
     */
    public function updateFAQ($id, $question, $answer, $sort_order = 0) {
        try {
            $stmt = $this->db->prepare("UPDATE faqs SET question = ?, answer = ?, sort_order = ? WHERE id = ?");
            return $stmt->execute([sanitize_input($question), sanitize_input($answer), $sort_order, $id]);
        } catch (PDOException $e) {
            handle_error("Update FAQ error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete FAQ (admin only)
     */
    public function deleteFAQ($id) {
        try {
            $stmt = $this->db->prepare("UPDATE faqs SET is_active = 0 WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            handle_error("Delete FAQ error: " . $e->getMessage());
            return false;
        }
    }
}

/**
 * User Enrollment Management
 */
class EnrollmentManager {
    private $db;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    /**
     * Enroll user in a service/training
     */
    public function enrollUser($user_id, $service_id) {
        try {
            // Check if already enrolled
            $stmt = $this->db->prepare("SELECT id FROM enrollments WHERE user_id = ? AND service_id = ? AND status = 'active'");
            $stmt->execute([$user_id, $service_id]);
            if ($stmt->fetch()) {
                return array('success' => false, 'message' => 'You are already enrolled in this service.');
            }
            
            $stmt = $this->db->prepare("INSERT INTO enrollments (user_id, service_id) VALUES (?, ?)");
            $result = $stmt->execute([$user_id, $service_id]);
            
            if ($result) {
                return array('success' => true, 'message' => 'Successfully enrolled!');
            } else {
                return array('success' => false, 'message' => 'Enrollment failed. Please try again.');
            }
            
        } catch (PDOException $e) {
            handle_error("Enrollment error: " . $e->getMessage());
            return array('success' => false, 'message' => 'Database error occurred.');
        }
    }
    
    /**
     * Get user enrollments
     */
    public function getUserEnrollments($user_id) {
        try {
            $stmt = $this->db->prepare("
                SELECT e.*, s.title, s.description, s.category 
                FROM enrollments e 
                JOIN services s ON e.service_id = s.id 
                WHERE e.user_id = ? 
                ORDER BY e.enrollment_date DESC
            ");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            handle_error("Get enrollments error: " . $e->getMessage());
            return array();
        }
    }
    
    /**
     * Update enrollment status
     */
    public function updateEnrollmentStatus($enrollment_id, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE enrollments SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $enrollment_id]);
        } catch (PDOException $e) {
            handle_error("Update enrollment status error: " . $e->getMessage());
            return false;
        }
    }
}

// Utility functions for template rendering
function formatDate($datetime) {
    return date('M d, Y', strtotime($datetime));
}

function formatDateTime($datetime) {
    return date('M d, Y g:i A', strtotime($datetime));
}

function truncateText($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

function getServiceIcon($category) {
    $icons = array(
        'core' => 'fas fa-cogs',
        'innovation' => 'fas fa-lightbulb',
        'training' => 'fas fa-graduation-cap',
        'consulting' => 'fas fa-handshake',
        'additional' => 'fas fa-plus-circle'
    );
    
    return isset($icons[$category]) ? $icons[$category] : 'fas fa-laptop-code';
}
?>