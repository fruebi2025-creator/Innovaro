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
    <title>Login - Innovaro Global Services</title>
    <meta name="description" content="Login to your Innovaro Global Services account to access our services and manage your enrollments.">
    
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
                    <a href="register.php" class="btn btn-primary">Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="section" style="padding: 120px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-sign-in-alt" style="font-size: 3rem;"></i>
                                </div>
                                <h2>Welcome Back</h2>
                                <p>Sign in to your Innovaro Global Services account</p>
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

                                <form id="loginForm" method="POST">
                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-envelope mr-2"></i>Email Address
                                        </label>
                                        <input type="email" id="email" name="email" class="form-control" required 
                                               placeholder="Enter your email address">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="fas fa-lock mr-2"></i>Password
                                        </label>
                                        <input type="password" id="password" name="password" class="form-control" required 
                                               placeholder="Enter your password">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="d-flex align-items-center">
                                            <input type="checkbox" name="remember" style="margin-right: 0.5rem;">
                                            Remember me for 30 days
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                                    </button>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <p>Don't have an account? 
                                    <a href="register.php" class="text-gold">
                                        <strong>Sign up here</strong>
                                    </a>
                                </p>
                                <p><a href="forgot-password.php" class="text-blue">Forgot your password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Benefits Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h3>Why Create an Account?</h3>
                            <p>Unlock exclusive benefits and streamlined access to our services</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-graduation-cap" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Enroll in Training</h5>
                                <p>Access our comprehensive IT training programs and enhance your skills.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-tachometer-alt" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Personal Dashboard</h5>
                                <p>Track your progress, manage enrollments, and access exclusive content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-bell" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Stay Updated</h5>
                                <p>Receive notifications about new services, training programs, and updates.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-headset" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Priority Support</h5>
                                <p>Get faster response times and dedicated support for your inquiries.</p>
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