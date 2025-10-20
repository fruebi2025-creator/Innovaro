<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$serviceManager = new ServiceManager();
$coreServices = $serviceManager->getServicesByCategory('core');
$innovationServices = $serviceManager->getServicesByCategory('innovation');
$trainingServices = $serviceManager->getServicesByCategory('training');
$consultingServices = $serviceManager->getServicesByCategory('consulting');
$additionalServices = $serviceManager->getServicesByCategory('additional');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Innovaro Global Services</title>
    <meta name="description" content="Explore comprehensive IT services including Software Management, Business Analysis, Project Management, AI, Cybersecurity, and more from Innovaro Global Services.">
    <meta name="keywords" content="IT services, software management, business analysis, project management, AI, cybersecurity, cloud computing, Nigeria">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <i class="fas fa-code text-gold"></i>
                    Innovaro Global Services
                </div>
                
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php" class="active">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="faqs.php">FAQs</a></li>
                    <?php if (is_logged_in()): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="php/logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
                
                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <?php if (!is_logged_in()): ?>
                <div class="auth-buttons">
                    <a href="login.php" class="btn btn-secondary">Login</a>
                    <a href="register.php" class="btn btn-primary">Sign Up</a>
                </div>
                <?php else: ?>
                <div class="auth-buttons">
                    <span class="text-gold">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
                </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Page Header -->
        <section class="hero" style="padding: 100px 0;">
            <div class="container">
                <div class="hero-content">
                    <h1>Our Services</h1>
                    <p class="slogan">Comprehensive IT Solutions for Your Business Success</p>
                    <p style="font-size: 1.2rem; margin-top: 2rem; max-width: 800px; margin-left: auto; margin-right: auto;">
                        From core business services to cutting-edge technology solutions, we provide everything you need to thrive in the digital age.
                    </p>
                </div>
            </div>
        </section>

        <!-- Core Services Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Core Services</h2>
                    <p>Essential services that form the foundation of your digital transformation</p>
                </div>
                
                <div class="row">
                    <?php foreach ($coreServices as $service): ?>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon">
                                    <i class="<?php echo getServiceIcon($service['category']); ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                            </div>
                            <div class="card-body">
                                <p><?php echo htmlspecialchars($service['description']); ?></p>
                            </div>
                            <div class="card-footer">
                                <?php if (is_logged_in()): ?>
                                    <button class="btn btn-primary" onclick="enrollInService(<?php echo $service['id']; ?>)">
                                        <i class="fas fa-plus mr-2"></i>Enroll Now
                                    </button>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-outline">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Enroll
                                    </a>
                                <?php endif; ?>
                                <a href="service-detail.php?id=<?php echo $service['id']; ?>" class="btn btn-outline ml-2">
                                    <i class="fas fa-info-circle mr-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- IT Innovation Solutions Section -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>IT Innovation Solutions Development</h2>
                    <p>Cutting-edge technology solutions for forward-thinking businesses</p>
                </div>
                
                <div class="row">
                    <?php foreach ($innovationServices as $service): ?>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="icon">
                                    <i class="<?php echo getServiceIcon($service['category']); ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                            </div>
                            <div class="card-body">
                                <p><?php echo htmlspecialchars($service['description']); ?></p>
                            </div>
                            <div class="card-footer">
                                <?php if (is_logged_in()): ?>
                                    <button class="btn btn-primary" onclick="enrollInService(<?php echo $service['id']; ?>)">
                                        Enroll Now
                                    </button>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-outline">Login to Enroll</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center mt-4">
                    <a href="innovation-solutions.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-lightbulb mr-2"></i>Explore Innovation Solutions
                    </a>
                </div>
            </div>
        </section>

        <!-- IT Training Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>IT Training Programs</h2>
                    <p>Professional training to enhance your team's technical capabilities</p>
                </div>
                
                <div class="row">
                    <?php foreach ($trainingServices as $service): ?>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="icon">
                                    <i class="<?php echo getServiceIcon($service['category']); ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                            </div>
                            <div class="card-body">
                                <p><?php echo htmlspecialchars($service['description']); ?></p>
                            </div>
                            <div class="card-footer">
                                <?php if (is_logged_in()): ?>
                                    <button class="btn btn-primary" onclick="enrollInService(<?php echo $service['id']; ?>)">
                                        Enroll Now
                                    </button>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-outline">Login to Enroll</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center mt-4">
                    <a href="it-training.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-graduation-cap mr-2"></i>View All Training Programs
                    </a>
                </div>
            </div>
        </section>

        <!-- IT Consulting Section -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>IT Consulting Services</h2>
                    <p>Expert guidance for your digital transformation journey</p>
                </div>
                
                <div class="row">
                    <?php foreach ($consultingServices as $service): ?>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="icon">
                                    <i class="<?php echo getServiceIcon($service['category']); ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                            </div>
                            <div class="card-body">
                                <p><?php echo htmlspecialchars($service['description']); ?></p>
                            </div>
                            <div class="card-footer">
                                <?php if (is_logged_in()): ?>
                                    <button class="btn btn-primary" onclick="enrollInService(<?php echo $service['id']; ?>)">
                                        Enroll Now
                                    </button>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-outline">Login to Enroll</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center mt-4">
                    <a href="it-consulting.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-handshake mr-2"></i>Learn About Our Consulting
                    </a>
                </div>
            </div>
        </section>

        <!-- Additional Services Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Additional Technology Services</h2>
                    <p>Specialized solutions to meet your unique business needs</p>
                </div>
                
                <div class="row">
                    <?php foreach ($additionalServices as $service): ?>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon">
                                    <i class="<?php echo getServiceIcon($service['category']); ?>"></i>
                                </div>
                                <h4><?php echo htmlspecialchars($service['title']); ?></h4>
                            </div>
                            <div class="card-body">
                                <p><?php echo truncateText($service['description'], 120); ?></p>
                            </div>
                            <div class="card-footer">
                                <?php if (is_logged_in()): ?>
                                    <button class="btn btn-primary btn-sm" onclick="enrollInService(<?php echo $service['id']; ?>)">
                                        Enroll
                                    </button>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-outline btn-sm">Login</a>
                                <?php endif; ?>
                                <a href="service-detail.php?id=<?php echo $service['id']; ?>" class="btn btn-outline btn-sm ml-1">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Service Categories Navigation -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>Explore by Category</h2>
                    <p>Navigate to specific service areas that interest you most</p>
                </div>
                
                <div class="row">
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-lightbulb" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Innovation Solutions</h4>
                                <p>Cutting-edge IT solutions for digital transformation</p>
                                <a href="innovation-solutions.php" class="btn btn-outline">Explore</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-graduation-cap" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Training Programs</h4>
                                <p>Professional IT training for skill development</p>
                                <a href="it-training.php" class="btn btn-outline">Explore</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-handshake" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Consulting Services</h4>
                                <p>Expert guidance and strategic IT consulting</p>
                                <a href="it-consulting.php" class="btn btn-outline">Explore</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-cogs" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Custom Solutions</h4>
                                <p>Tailored services for your specific requirements</p>
                                <a href="contact.php" class="btn btn-outline">Discuss</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="section" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%); color: white;">
            <div class="container text-center">
                <h2 style="color: white;">Ready to Get Started?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #FCD34D;">
                    Choose the services that best fit your needs and begin your digital transformation today.
                </p>
                <div class="hero-actions">
                    <a href="contact.php" class="btn btn-primary btn-lg mr-3">
                        <i class="fas fa-envelope mr-2"></i>Request Consultation
                    </a>
                    <?php if (!is_logged_in()): ?>
                        <a href="register.php" class="btn btn-secondary btn-lg">
                            <i class="fas fa-user-plus mr-2"></i>Create Account
                        </a>
                    <?php else: ?>
                        <a href="dashboard.php" class="btn btn-secondary btn-lg">
                            <i class="fas fa-tachometer-alt mr-2"></i>Go to Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Innovaro Global Services</h3>
                    <p>Delivering Business and Software Solutions with Precision and Passion. We are your trusted partner in digital transformation.</p>
                    <p><strong>Pioneering IT solutions for the digital future.</strong></p>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="index.php">Home</a>
                    <a href="about.php">About Us</a>
                    <a href="services.php">Services</a>
                    <a href="contact.php">Contact</a>
                    <a href="faqs.php">FAQs</a>
                </div>
                
                <div class="footer-section">
                    <h3>Services</h3>
                    <a href="services.php">Software Management</a>
                    <a href="services.php">Business Analysis</a>
                    <a href="services.php">Project Management</a>
                    <a href="services.php">IT Training</a>
                    <a href="services.php">IT Consulting</a>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 35 Bonny Street, Port Harcourt, Rivers State</li>
                        <li><i class="fas fa-envelope"></i> igs@innovaro.com.ng</li>
                        <li><i class="fas fa-phone"></i> +234 805 336 7426</li>
                        <li><i class="fas fa-phone"></i> +234 806 161 5760</li>
                        <li><i class="fas fa-globe"></i> www.innovaro.com.ng</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 Innovaro Global Services. All rights reserved. | Designed and Developed by Innovaro Global Services</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/main.js"></script>
</body>
</html>