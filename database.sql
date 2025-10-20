-- Innovaro Global Services Database Schema
-- Created for the complete company website

CREATE DATABASE IF NOT EXISTS innovaro_db;
USE innovaro_db;

-- Users table for authentication and user management
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Services table for managing company services
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Messages table for contact form submissions
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- FAQs table for frequently asked questions
CREATE TABLE faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- User enrollments for training programs (future use)
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'completed', 'cancelled') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Insert default admin user
INSERT INTO users (name, email, password, role) VALUES 
('Administrator', 'admin@innovaro.com.ng', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert default services
INSERT INTO services (title, description, category, image) VALUES
('Software Management', 'Comprehensive software lifecycle management solutions for businesses of all sizes.', 'core', 'software-management.jpg'),
('Business Analysis', 'Expert business analysis services to optimize your operations and drive growth.', 'core', 'business-analysis.jpg'),
('Project Management', 'Professional project management services ensuring successful delivery on time and budget.', 'core', 'project-management.jpg'),
('IT Innovation Solutions Development', 'Cutting-edge IT solutions tailored to transform your business operations.', 'innovation', 'it-innovation.jpg'),
('IT Trainings', 'Professional IT training programs to enhance your team\'s technical capabilities.', 'training', 'it-training.jpg'),
('IT Consulting', 'Expert IT consulting services to guide your digital transformation journey.', 'consulting', 'it-consulting.jpg'),
('Artificial Intelligence', 'AI-powered solutions to automate and optimize your business processes.', 'additional', 'ai.jpg'),
('Cyber Security', 'Comprehensive cybersecurity solutions to protect your digital assets.', 'additional', 'cybersecurity.jpg'),
('Cloud Computing', 'Scalable cloud solutions for modern business infrastructure needs.', 'additional', 'cloud-computing.jpg'),
('Data Analytics', 'Advanced data analytics to derive actionable insights from your business data.', 'additional', 'data-analytics.jpg'),
('Blockchain Development', 'Secure blockchain solutions for transparent and decentralized applications.', 'additional', 'blockchain.jpg'),
('Digital Marketing', 'Strategic digital marketing services to enhance your online presence.', 'additional', 'digital-marketing.jpg'),
('Product Design', 'User-centered product design for exceptional user experiences.', 'additional', 'product-design.jpg'),
('Mobile & Web Development', 'Custom mobile and web applications tailored to your business needs.', 'additional', 'web-mobile-dev.jpg'),
('IoT', 'Internet of Things solutions for smart, connected business operations.', 'additional', 'iot.jpg'),
('Game Development', 'Engaging game development services for entertainment and training applications.', 'additional', 'game-development.jpg'),
('Graphics Design', 'Professional graphic design services for compelling visual communications.', 'additional', 'graphics-design.jpg'),
('AutoCAD/ArchiCAD', 'Professional CAD services for architectural and engineering projects.', 'additional', 'autocad.jpg');

-- Insert sample FAQs
INSERT INTO faqs (question, answer, sort_order) VALUES
('What services does Innovaro Global Services offer?', 'Innovaro Global Services offers a comprehensive range of IT solutions including Software Management, Business Analysis, Project Management, IT Training, Consulting, AI, Cybersecurity, Cloud Computing, and many more specialized services.', 1),
('How can I get started with your services?', 'You can get started by contacting us through our contact form, calling our phone numbers, or sending an email. Our team will assess your needs and provide a customized solution.', 2),
('Do you provide training programs?', 'Yes, we offer comprehensive IT training programs designed to enhance your team\'s technical capabilities across various domains including software development, cybersecurity, cloud computing, and more.', 3),
('What makes Innovaro Global Services different?', 'We combine technical expertise with business acumen to deliver solutions that not only work technically but also drive real business value. Our commitment to precision and passion sets us apart.', 4),
('Do you work with small businesses or just large enterprises?', 'We work with businesses of all sizes, from startups to large enterprises. Our solutions are scalable and can be customized to meet the specific needs and budget of any organization.', 5);