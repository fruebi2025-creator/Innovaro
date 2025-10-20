<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/functions.php';

// Require login
require_login();

$auth = new Auth();
$enrollmentManager = new EnrollmentManager();
$serviceManager = new ServiceManager();

$currentUser = $auth->getCurrentUser();
$userEnrollments = $enrollmentManager->getUserEnrollments($_SESSION['user_id']);
$recentServices = array_slice($serviceManager->getAllServices(), 0, 6);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Innovaro Global Services</title>
    <meta name="description" content="Manage your Innovaro Global Services account, view enrolled services, track your progress, and access your personalized content.">
    
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
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="php/logout.php">Logout</a></li>
                </ul>
                
                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="auth-buttons">
                    <span class="text-gold">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Dashboard Header -->
        <section class="hero" style="padding: 100px 0 60px 0;">
            <div class="container">
                <div class="hero-content">
                    <h1><i class="fas fa-tachometer-alt mr-3"></i>My Dashboard</h1>
                    <p class="slogan">Manage Your Learning Journey</p>
                    <p style="font-size: 1.1rem; margin-top: 1rem;">
                        Welcome back, <?php echo htmlspecialchars($currentUser['name']); ?>! 
                        Track your progress, manage enrollments, and explore new opportunities.
                    </p>
                </div>
            </div>
        </section>

        <!-- Quick Stats -->
        <section class="section" style="padding-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-2">
                                    <i class="fas fa-graduation-cap" style="font-size: 2.5rem;"></i>
                                </div>
                                <h3 class="text-dark-blue"><?php echo count($userEnrollments); ?></h3>
                                <p>Enrolled Services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-2">
                                    <i class="fas fa-certificate" style="font-size: 2.5rem;"></i>
                                </div>
                                <h3 class="text-dark-blue">
                                    <?php 
                                    $completed = array_filter($userEnrollments, function($e) { return $e['status'] === 'completed'; });
                                    echo count($completed); 
                                    ?>
                                </h3>
                                <p>Completed Programs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-2">
                                    <i class="fas fa-clock" style="font-size: 2.5rem;"></i>
                                </div>
                                <h3 class="text-dark-blue">
                                    <?php 
                                    $active = array_filter($userEnrollments, function($e) { return $e['status'] === 'active'; });
                                    echo count($active); 
                                    ?>
                                </h3>
                                <p>In Progress</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-2">
                                    <i class="fas fa-calendar-alt" style="font-size: 2.5rem;"></i>
                                </div>
                                <h3 class="text-dark-blue">
                                    <?php echo formatDate($currentUser['created_at']); ?>
                                </h3>
                                <p>Member Since</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- My Enrollments -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>My Enrolled Services</h2>
                    <p>Track your progress and manage your learning journey</p>
                </div>
                
                <?php if (!empty($userEnrollments)): ?>
                    <div class="row">
                        <?php foreach ($userEnrollments as $enrollment): ?>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4><?php echo htmlspecialchars($enrollment['title']); ?></h4>
                                            <small class="text-muted">Category: <?php echo ucfirst($enrollment['category']); ?></small>
                                        </div>
                                        <div>
                                            <?php if ($enrollment['status'] === 'active'): ?>
                                                <span class="badge bg-blue text-white" style="padding: 0.5rem 1rem; border-radius: 20px;">In Progress</span>
                                            <?php elseif ($enrollment['status'] === 'completed'): ?>
                                                <span class="badge bg-gold text-white" style="padding: 0.5rem 1rem; border-radius: 20px;">Completed</span>
                                            <?php else: ?>
                                                <span class="badge" style="background: #6B7280; color: white; padding: 0.5rem 1rem; border-radius: 20px;">Cancelled</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p><?php echo truncateText($enrollment['description'], 120); ?></p>
                                    <div class="enrollment-meta mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar mr-1"></i>
                                            Enrolled: <?php echo formatDate($enrollment['enrollment_date']); ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php if ($enrollment['status'] === 'active'): ?>
                                        <a href="#" class="btn btn-primary">Continue Learning</a>
                                        <a href="#" class="btn btn-outline ml-2">View Materials</a>
                                    <?php elseif ($enrollment['status'] === 'completed'): ?>
                                        <a href="#" class="btn btn-outline">Download Certificate</a>
                                        <a href="#" class="btn btn-outline ml-2">View Materials</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-graduation-cap text-gold" style="font-size: 4rem;"></i>
                                    <h3 class="mt-3">No Enrollments Yet</h3>
                                    <p>You haven't enrolled in any services yet. Explore our comprehensive training programs and services to get started.</p>
                                    <a href="services.php" class="btn btn-primary btn-lg">Browse Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Recommended Services -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>Recommended for You</h2>
                    <p>Discover new services that match your interests</p>
                </div>
                
                <div class="row">
                    <?php foreach ($recentServices as $service): ?>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="icon">
                                    <i class="<?php echo getServiceIcon($service['category']); ?>"></i>
                                </div>
                                <h4><?php echo htmlspecialchars($service['title']); ?></h4>
                            </div>
                            <div class="card-body">
                                <p><?php echo truncateText($service['description'], 100); ?></p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="enrollInService(<?php echo $service['id']; ?>)">
                                    <i class="fas fa-plus mr-2"></i>Enroll Now
                                </button>
                                <a href="services.php" class="btn btn-outline ml-2">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Account Management -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>Account Management</h2>
                    <p>Update your profile and manage account settings</p>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-user text-gold mr-2"></i>Profile Information</h3>
                            </div>
                            <div class="card-body">
                                <form id="profileForm">
                                    <div class="form-group">
                                        <label for="profile_name">Full Name</label>
                                        <input type="text" id="profile_name" name="name" class="form-control" 
                                               value="<?php echo htmlspecialchars($currentUser['name']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_email">Email Address</label>
                                        <input type="email" id="profile_email" name="email" class="form-control" 
                                               value="<?php echo htmlspecialchars($currentUser['email']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Type</label>
                                        <input type="text" class="form-control" 
                                               value="<?php echo ucfirst($currentUser['role']); ?>" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-lock text-gold mr-2"></i>Change Password</h3>
                            </div>
                            <div class="card-body">
                                <form id="passwordForm">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" id="current_password" name="current_password" 
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" id="new_password" name="new_password" 
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_new_password">Confirm New Password</label>
                                        <input type="password" id="confirm_new_password" name="confirm_new_password" 
                                               class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-bolt text-gold mr-2"></i>Quick Actions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <a href="services.php" class="btn btn-outline btn-lg" style="width: 100%;">
                                            <i class="fas fa-search d-block mb-2" style="font-size: 2rem;"></i>
                                            Browse Services
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="contact.php" class="btn btn-outline btn-lg" style="width: 100%;">
                                            <i class="fas fa-envelope d-block mb-2" style="font-size: 2rem;"></i>
                                            Contact Support
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="#" class="btn btn-outline btn-lg" style="width: 100%;">
                                            <i class="fas fa-download d-block mb-2" style="font-size: 2rem;"></i>
                                            Download Materials
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="faqs.php" class="btn btn-outline btn-lg" style="width: 100%;">
                                            <i class="fas fa-question-circle d-block mb-2" style="font-size: 2rem;"></i>
                                            View FAQs
                                        </a>
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