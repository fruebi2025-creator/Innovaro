<?php
require_once 'includes/config.php';

// Redirect if already logged in
if (is_logged_in()) {
    redirect('dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Innovaro Global Services</title>
    <meta name="description" content="Create your Innovaro Global Services account to access our comprehensive IT training programs and services.">
    
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
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="faqs.php">FAQs</a></li>
                </ul>
                
                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="auth-buttons">
                    <a href="login.php" class="btn btn-secondary">Login</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="section" style="padding: 120px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-user-plus" style="font-size: 3rem;"></i>
                                </div>
                                <h2>Join Innovaro Global Services</h2>
                                <p>Create your account and unlock access to our comprehensive IT solutions</p>
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

                                <form id="registerForm" method="POST">
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
                                                <label for="password">
                                                    <i class="fas fa-lock mr-2"></i>Password *
                                                </label>
                                                <input type="password" id="password" name="password" class="form-control" required 
                                                       placeholder="Create a password (min. 6 characters)">
                                                <small class="text-muted">Password must be at least 6 characters long</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="confirm_password">
                                                    <i class="fas fa-lock mr-2"></i>Confirm Password *
                                                </label>
                                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required 
                                                       placeholder="Confirm your password">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="role">
                                            <i class="fas fa-user-tag mr-2"></i>Account Type
                                        </label>
                                        <select id="role" name="role" class="form-control">
                                            <option value="client">Client - Access services and training programs</option>
                                            <option value="admin">Administrator - Manage services and content</option>
                                        </select>
                                        <small class="text-muted">Choose the account type that best fits your needs</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="d-flex align-items-center">
                                            <input type="checkbox" name="terms" required style="margin-right: 0.5rem;">
                                            I agree to the <a href="#" class="text-gold">Terms of Service</a> and 
                                            <a href="#" class="text-gold">Privacy Policy</a> *
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="d-flex align-items-center">
                                            <input type="checkbox" name="newsletter" style="margin-right: 0.5rem;">
                                            Subscribe to our newsletter for updates on new services and training programs
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                                        <i class="fas fa-user-plus mr-2"></i>Create My Account
                                    </button>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <p>Already have an account? 
                                    <a href="login.php" class="text-gold">
                                        <strong>Sign in here</strong>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Account Benefits Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h3>What You Get With Your Account</h3>
                            <p>Join thousands of professionals who trust Innovaro Global Services</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-book-open" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Comprehensive Learning</h5>
                                <p>Access to all our training programs including AI, Cybersecurity, Cloud Computing, and more.</p>
                                <ul style="text-align: left; list-style: none; padding: 0;">
                                    <li><i class="fas fa-check text-gold mr-2"></i>Software Development</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Business Analysis</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Project Management</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Digital Marketing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-certificate" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Professional Certification</h5>
                                <p>Earn industry-recognized certificates upon completion of training programs.</p>
                                <ul style="text-align: left; list-style: none; padding: 0;">
                                    <li><i class="fas fa-check text-gold mr-2"></i>Certificate of Completion</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Digital Badges</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>LinkedIn Integration</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Portfolio Building</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-users-cog" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Expert Support</h5>
                                <p>Get personalized guidance from our team of experienced IT professionals.</p>
                                <ul style="text-align: left; list-style: none; padding: 0;">
                                    <li><i class="fas fa-check text-gold mr-2"></i>24/7 Technical Support</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>One-on-One Mentoring</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Community Forum</li>
                                    <li><i class="fas fa-check text-gold mr-2"></i>Career Guidance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card" style="background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);">
                            <div class="card-body text-center">
                                <h4 class="text-dark-blue mb-4">Trusted by Professionals Across Nigeria</h4>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <i class="fas fa-users text-gold" style="font-size: 2rem;"></i>
                                            <h3 class="text-dark-blue mt-2">500+</h3>
                                            <p class="text-muted">Active Students</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <i class="fas fa-graduation-cap text-gold" style="font-size: 2rem;"></i>
                                            <h3 class="text-dark-blue mt-2">50+</h3>
                                            <p class="text-muted">Training Programs</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <i class="fas fa-award text-gold" style="font-size: 2rem;"></i>
                                            <h3 class="text-dark-blue mt-2">1000+</h3>
                                            <p class="text-muted">Certificates Issued</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <i class="fas fa-star text-gold" style="font-size: 2rem;"></i>
                                            <h3 class="text-dark-blue mt-2">4.9/5</h3>
                                            <p class="text-muted">Student Rating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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