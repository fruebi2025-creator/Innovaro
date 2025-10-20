<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Innovaro Global Services</title>
    <meta name="description" content="Get in touch with Innovaro Global Services. Located at 35 Bonny Street, Port Harcourt. Call us at +234 805 336 7426 or email igs@innovaro.com.ng">
    <meta name="keywords" content="contact, Innovaro Global Services, Port Harcourt, IT company, consultation">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    
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
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
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
                    <h1>Contact Us</h1>
                    <p class="slogan">Let's Start the Conversation</p>
                    <p style="font-size: 1.2rem; margin-top: 2rem; max-width: 800px; margin-left: auto; margin-right: auto;">
                        Ready to transform your business? Get in touch with our team of experts and discover how we can help you achieve your digital transformation goals.
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Form & Information Section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <!-- Contact Form -->
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h2><i class="fas fa-envelope text-gold mr-2"></i>Send Us a Message</h2>
                                <p>Fill out the form below and we'll get back to you within 24 hours</p>
                            </div>
                            <div class="card-body">
                                <!-- Flash Messages -->
                                <?php 
                                $success_message = get_flash_message('success');
                                $error_message = get_flash_message('error');
                                
                                if ($success_message): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle mr-2"></i><?php echo $success_message; ?>
                                    </div>
                                <?php endif; 
                                
                                if ($error_message): ?>
                                    <div class="alert alert-error">
                                        <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error_message; ?>
                                    </div>
                                <?php endif; ?>

                                <form id="contactForm" method="POST">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">
                                                    <i class="fas fa-user mr-2"></i>Full Name *
                                                </label>
                                                <input type="text" id="name" name="name" class="form-control" required 
                                                       placeholder="Enter your full name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">
                                                    <i class="fas fa-envelope mr-2"></i>Email Address *
                                                </label>
                                                <input type="email" id="email" name="email" class="form-control" required 
                                                       placeholder="Enter your email address">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="phone">
                                                    <i class="fas fa-phone mr-2"></i>Phone Number
                                                </label>
                                                <input type="tel" id="phone" name="phone" class="form-control" 
                                                       placeholder="Enter your phone number (optional)">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="subject">
                                                    <i class="fas fa-tag mr-2"></i>Subject *
                                                </label>
                                                <select id="subject" name="subject" class="form-control" required>
                                                    <option value="">Select a subject</option>
                                                    <option value="General Inquiry">General Inquiry</option>
                                                    <option value="Service Consultation">Service Consultation</option>
                                                    <option value="Training Program">Training Program</option>
                                                    <option value="Project Quote">Project Quote Request</option>
                                                    <option value="Technical Support">Technical Support</option>
                                                    <option value="Partnership">Partnership Opportunity</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="message">
                                            <i class="fas fa-comment mr-2"></i>Message *
                                        </label>
                                        <textarea id="message" name="message" class="form-control" rows="6" required 
                                                  placeholder="Please describe your inquiry in detail. Include any specific requirements, timeline, or questions you may have."></textarea>
                                        <small class="text-muted">Minimum 20 characters required</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="d-flex align-items-center">
                                            <input type="checkbox" name="newsletter" style="margin-right: 0.5rem;">
                                            Subscribe to our newsletter for updates on services and training programs
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane mr-2"></i>Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-map-marker-alt text-gold mr-2"></i>Get in Touch</h3>
                            </div>
                            <div class="card-body">
                                <div class="contact-info-item mb-4">
                                    <div class="icon text-gold mb-2">
                                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h5>Our Office</h5>
                                    <p>35 Bonny Street<br>
                                    Port Harcourt, Rivers State<br>
                                    Nigeria</p>
                                </div>
                                
                                <div class="contact-info-item mb-4">
                                    <div class="icon text-gold mb-2">
                                        <i class="fas fa-phone" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h5>Phone Numbers</h5>
                                    <p>
                                        <a href="tel:+2348053367426">+234 805 336 7426</a><br>
                                        <a href="tel:+2348061615760">+234 806 161 5760</a>
                                    </p>
                                </div>
                                
                                <div class="contact-info-item mb-4">
                                    <div class="icon text-gold mb-2">
                                        <i class="fas fa-envelope" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h5>Email Address</h5>
                                    <p><a href="mailto:igs@innovaro.com.ng">igs@innovaro.com.ng</a></p>
                                </div>
                                
                                <div class="contact-info-item mb-4">
                                    <div class="icon text-gold mb-2">
                                        <i class="fas fa-globe" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h5>Website</h5>
                                    <p><a href="https://www.innovaro.com.ng" target="_blank">www.innovaro.com.ng</a></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Business Hours -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3><i class="fas fa-clock text-gold mr-2"></i>Business Hours</h3>
                            </div>
                            <div class="card-body">
                                <div class="business-hours">
                                    <div class="hours-item mb-2">
                                        <strong>Monday - Friday</strong><br>
                                        <span class="text-muted">8:00 AM - 6:00 PM</span>
                                    </div>
                                    <div class="hours-item mb-2">
                                        <strong>Saturday</strong><br>
                                        <span class="text-muted">9:00 AM - 4:00 PM</span>
                                    </div>
                                    <div class="hours-item mb-2">
                                        <strong>Sunday</strong><br>
                                        <span class="text-muted">Closed</span>
                                    </div>
                                    <div class="hours-item">
                                        <strong>Emergency Support</strong><br>
                                        <span class="text-gold">24/7 Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alternative Contact Methods -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>Other Ways to Reach Us</h2>
                    <p>Choose the communication method that works best for you</p>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-calendar-alt" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Schedule a Meeting</h4>
                                <p>Book a consultation with our experts to discuss your project requirements in detail.</p>
                                <a href="#" class="btn btn-outline">Schedule Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-comments" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Live Chat Support</h4>
                                <p>Get instant answers to your questions through our live chat support during business hours.</p>
                                <a href="#" class="btn btn-outline">Start Chat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-video" style="font-size: 3rem;"></i>
                                </div>
                                <h4>Video Consultation</h4>
                                <p>Connect with our team via video call for more complex discussions and demonstrations.</p>
                                <a href="#" class="btn btn-outline">Book Video Call</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                    <p>Quick answers to common questions about our services</p>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-dark-blue">How quickly do you respond to inquiries?</h5>
                                <p>We typically respond to all inquiries within 24 hours during business days, and within 2 hours for urgent matters during business hours.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-dark-blue">Do you offer free consultations?</h5>
                                <p>Yes! We offer free initial consultations to understand your needs and provide preliminary recommendations for your project.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="faqs.php" class="btn btn-outline btn-lg">
                        <i class="fas fa-question-circle mr-2"></i>View All FAQs
                    </a>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="section" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%); color: white;">
            <div class="container text-center">
                <h2 style="color: white;">Ready to Get Started?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #FCD34D;">
                    Don't wait any longer. Contact us today and let's discuss how we can help transform your business.
                </p>
                <div class="hero-actions">
                    <?php if (!is_logged_in()): ?>
                        <a href="register.php" class="btn btn-primary btn-lg mr-3">
                            <i class="fas fa-user-plus mr-2"></i>Create Account
                        </a>
                    <?php endif; ?>
                    <a href="services.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-list mr-2"></i>View Services
                    </a>
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