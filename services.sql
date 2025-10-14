-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 03:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innovaro`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `description`, `category`, `created_at`) VALUES
(2, 'Artificial Intelligence', 'artificial-intelligence', 'AI solutions including ML models, automation and predictive analytics.', 'Innovation', '2025-10-14 10:38:45'),
(3, 'Cyber Security', 'cyber-security', 'Penetration testing, vulnerability assessments and security strategy.', 'Security', '2025-10-14 10:38:45'),
(4, 'Cloud Computing', 'cloud-computing', 'Cloud architecture, migration and managed cloud services.', 'Infrastructure', '2025-10-14 10:38:45'),
(5, 'Data Analytics', 'data-analytics', 'Data pipelines, dashboards and analytics that inform business decisions.', 'Data', '2025-10-14 10:38:45'),
(6, 'Blockchain Development', 'blockchain-development', 'Smart contracts, DLT consulting and blockchain applications.', 'Innovation', '2025-10-14 10:38:45'),
(7, 'Digital Marketing', 'digital-marketing', 'SEO, social ads, content strategy and marketing automation.', 'Marketing', '2025-10-14 10:38:45'),
(8, 'Product Design', 'product-design', 'UX/UI and product strategy to make usable digital products.', 'Design', '2025-10-14 10:38:45'),
(9, 'Web & Mobile Development', 'web-mobile-development', 'Full-stack web and mobile application development.', 'Development', '2025-10-14 10:38:45'),
(10, 'Project Management', 'project-management', 'Project governance, PMO support and delivery management.', 'Management', '2025-10-14 10:38:45'),
(11, 'IoT Solutions', 'iot', 'IoT design, sensor data integration and edge-to-cloud solutions.', 'Innovation', '2025-10-14 10:38:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
