<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Innovaro Global Services</title>
    <meta name="description" content="Learn about Innovaro Global Services, a pioneering IT company dedicated to reshaping the digital landscape through innovative solutions across multiple domains.">
    <meta name="keywords" content="IT company, digital transformation, innovation, technology solutions, Nigeria">
    
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
                    <li><a href="about.php" class="active">About</a></li>
                    <li><a href="services.php">Services</a></li>
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
                    <h1>About Innovaro Global Services</h1>
                    <p class="slogan">Pioneering IT Solutions for the Digital Future</p>
                </div>
            </div>
        </section>

        <!-- Company Description Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Our Company</h2>
                    <p>Driving digital transformation with innovation and excellence</p>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p style="font-size: 1.2rem; line-height: 1.8; text-align: center; margin-bottom: 2rem; color: #1E40AF; font-weight: 600;">
                                    "Innovaro Global Services is a pioneering IT company dedicated to reshaping the digital landscape through innovative solutions across multiple domains."
                                </p>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <p>Founded with a vision to transform businesses through cutting-edge technology, Innovaro Global Services has established itself as a trusted partner for organizations seeking digital excellence. We combine deep technical expertise with strategic business insight to deliver solutions that not only meet current needs but also prepare our clients for future challenges.</p>
                                        
                                        <p>Our comprehensive approach encompasses every aspect of digital transformation, from initial consultation and strategic planning to implementation, training, and ongoing support. We pride ourselves on our ability to understand each client's unique requirements and deliver tailored solutions that drive real business value.</p>
                                    </div>
                                    <div class="col-6">
                                        <p>At Innovaro Global Services, we believe that technology should empower businesses to achieve their full potential. Our team of experienced professionals brings together diverse skills and perspectives, enabling us to tackle complex challenges and deliver innovative solutions across various industries.</p>
                                        
                                        <p>With a commitment to excellence and a passion for innovation, we continue to expand our capabilities and explore new frontiers in technology. Our dedication to quality, integrity, and customer satisfaction has earned us the trust of clients across Nigeria and beyond.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission, Vision, Values Section -->
        <section class="section section-alt">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon">
                                    <i class="fas fa-bullseye"></i>
                                </div>
                                <h3>Our Mission</h3>
                            </div>
                            <div class="card-body">
                                <p>To deliver exceptional business and software solutions that empower organizations to thrive in the digital age. We are committed to providing innovative, reliable, and scalable technology solutions that drive growth, efficiency, and competitive advantage for our clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <h3>Our Vision</h3>
                            </div>
                            <div class="card-body">
                                <p>To be the leading IT solutions provider in Africa, recognized for our innovation, excellence, and transformative impact on businesses and communities. We envision a future where technology seamlessly integrates with business processes to create unprecedented opportunities for growth and success.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h3>Our Values</h3>
                            </div>
                            <div class="card-body">
                                <ul style="list-style-type: none; padding: 0;">
                                    <li><i class="fas fa-check text-gold"></i> <strong>Innovation:</strong> Embracing new ideas and technologies</li>
                                    <li><i class="fas fa-check text-gold"></i> <strong>Excellence:</strong> Delivering the highest quality solutions</li>
                                    <li><i class="fas fa-check text-gold"></i> <strong>Integrity:</strong> Building trust through honest practices</li>
                                    <li><i class="fas fa-check text-gold"></i> <strong>Collaboration:</strong> Working together for success</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Expertise Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Our Expertise</h2>
                    <p>Comprehensive capabilities across multiple technology domains</p>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="icon">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <h4>Technology Solutions</h4>
                            </div>
                            <div class="card-body">
                                <ul style="list-style-type: none; padding: 0;">
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Custom Software Development</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Web & Mobile Applications</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Cloud Computing Solutions</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Artificial Intelligence & Machine Learning</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Blockchain Development</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Internet of Things (IoT)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4>Business Solutions</h4>
                            </div>
                            <div class="card-body">
                                <ul style="list-style-type: none; padding: 0;">
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Cybersecurity Services</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Data Analytics & Business Intelligence</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Digital Marketing & Strategy</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Product Design & User Experience</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> Graphics Design & Branding</li>
                                    <li style="margin-bottom: 0.5rem;"><i class="fas fa-arrow-right text-gold mr-2"></i> CAD Services (AutoCAD/ArchiCAD)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>Why Choose Innovaro Global Services?</h2>
                    <p>What sets us apart in the competitive technology landscape</p>
                </div>
                
                <div class="row">
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-users" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Expert Team</h4>
                                <p>Our team consists of highly skilled professionals with years of experience in their respective fields, ensuring top-quality deliverables.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-rocket" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Innovation Focus</h4>
                                <p>We stay at the forefront of technology trends, continuously exploring new solutions and methodologies to benefit our clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-handshake" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Client Partnership</h4>
                                <p>We believe in building long-term partnerships with our clients, working closely to understand and exceed their expectations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-clock" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Timely Delivery</h4>
                                <p>We are committed to delivering projects on time and within budget, without compromising on quality or functionality.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Get in Touch</h2>
                    <p>Ready to start your digital transformation journey?</p>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Contact Information</h3>
                            </div>
                            <div class="card-body">
                                <ul class="contact-info" style="color: #374151;">
                                    <li style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                                        <i class="fas fa-map-marker-alt text-gold" style="width: 20px; font-size: 1.2rem;"></i>
                                        <div>
                                            <strong>Address:</strong><br>
                                            35 Bonny Street<br>
                                            Port Harcourt, Rivers State<br>
                                            Nigeria
                                        </div>
                                    </li>
                                    <li style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                                        <i class="fas fa-envelope text-gold" style="width: 20px; font-size: 1.2rem;"></i>
                                        <div>
                                            <strong>Email:</strong><br>
                                            <a href="mailto:igs@innovaro.com.ng">igs@innovaro.com.ng</a>
                                        </div>
                                    </li>
                                    <li style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                                        <i class="fas fa-phone text-gold" style="width: 20px; font-size: 1.2rem;"></i>
                                        <div>
                                            <strong>Phone:</strong><br>
                                            <a href="tel:+2348053367426">+234 805 336 7426</a><br>
                                            <a href="tel:+2348061615760">+234 806 161 5760</a>
                                        </div>
                                    </li>
                                    <li style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                                        <i class="fas fa-globe text-gold" style="width: 20px; font-size: 1.2rem;"></i>
                                        <div>
                                            <strong>Website:</strong><br>
                                            <a href="https://www.innovaro.com.ng" target="_blank">www.innovaro.com.ng</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Business Hours</h3>
                            </div>
                            <div class="card-body">
                                <div style="margin-bottom: 1.5rem;">
                                    <h5 class="text-dark-blue">Office Hours</h5>
                                    <p>Monday - Friday: 8:00 AM - 6:00 PM<br>
                                    Saturday: 9:00 AM - 4:00 PM<br>
                                    Sunday: Closed</p>
                                </div>
                                <div style="margin-bottom: 1.5rem;">
                                    <h5 class="text-dark-blue">Support Hours</h5>
                                    <p>24/7 Emergency Support Available<br>
                                    Remote Support: Monday - Sunday</p>
                                </div>
                                <div>
                                    <h5 class="text-dark-blue">Response Time</h5>
                                    <p>Email Inquiries: Within 24 hours<br>
                                    Phone Calls: Immediate during business hours<br>
                                    Emergency Support: Within 2 hours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <a href="contact.php" class="btn btn-primary btn-lg mr-3">Contact Us Today</a>
                    <a href="services.php" class="btn btn-outline btn-lg">View Our Services</a>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="section" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%); color: white;">
            <div class="container text-center">
                <h2 style="color: white;">Ready to Work With Us?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #FCD34D;">
                    Join hundreds of satisfied clients who trust Innovaro Global Services for their technology needs.
                </p>
                <div class="hero-actions">
                    <a href="contact.php" class="btn btn-primary btn-lg mr-3">Start Your Project</a>
                    <a href="register.php" class="btn btn-secondary btn-lg">Join Our Platform</a>
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