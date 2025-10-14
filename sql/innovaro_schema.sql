-- Create database (run as root or an appropriate user)
CREATE DATABASE IF NOT EXISTS innovaro DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE innovaro;

-- Services table
CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  slug VARCHAR(150) NOT NULL UNIQUE,
  description TEXT NOT NULL,
  category VARCHAR(80),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inquiries / contact submissions
CREATE TABLE inquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(50),
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional admin users table
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
);

-- Sample services
INSERT INTO services (title, slug, description, category) VALUES
('Artificial Intelligence', 'artificial-intelligence', 'AI solutions including ML models, automation and predictive analytics.', 'Innovation'),
('Cyber Security', 'cyber-security', 'Penetration testing, vulnerability assessments and security strategy.', 'Security'),
('Cloud Computing', 'cloud-computing', 'Cloud architecture, migration and managed cloud services.', 'Infrastructure'),
('Data Analytics', 'data-analytics', 'Data pipelines, dashboards and analytics that inform business decisions.', 'Data'),
('Blockchain Development', 'blockchain-development', 'Smart contracts, DLT consulting and blockchain applications.', 'Innovation'),
('Digital Marketing', 'digital-marketing', 'SEO, social ads, content strategy and marketing automation.', 'Marketing'),
('Product Design', 'product-design', 'UX/UI and product strategy to make usable digital products.', 'Design'),
('Web & Mobile Development', 'web-mobile-development', 'Full-stack web and mobile application development.', 'Development'),
('Project Management', 'project-management', 'Project governance, PMO support and delivery management.', 'Management'),
('IoT Solutions', 'iot', 'IoT design, sensor data integration and edge-to-cloud solutions.', 'Innovation');
