<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$faqManager = new FAQManager();
$faqs = $faqManager->getAllFAQs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions - Innovaro Global Services</title>
    <meta name="description" content="Find answers to common questions about Innovaro Global Services, our IT solutions, training programs, consulting services, and more.">
    <meta name="keywords" content="FAQ, questions, answers, IT services, training, consulting, Innovaro Global Services">
    
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
                    <li><a href="faqs.php" class="active">FAQs</a></li>
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
                    <h1>Frequently Asked Questions</h1>
                    <p class="slogan">Find Quick Answers to Common Questions</p>
                    <p style="font-size: 1.2rem; margin-top: 2rem; max-width: 800px; margin-left: auto; margin-right: auto;">
                        Got questions? We've got answers. Browse through our comprehensive FAQ section to find information about our services, processes, and more.
                    </p>
                </div>
            </div>
        </section>

        <!-- Search FAQ Section -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="search-faq text-center">
                                    <h3 class="text-dark-blue mb-3">
                                        <i class="fas fa-search text-gold mr-2"></i>Search FAQs
                                    </h3>
                                    <div class="form-group">
                                        <input type="text" id="faqSearch" class="form-control" 
                                               placeholder="Type your question or keywords to search...">
                                    </div>
                                    <p class="text-muted">Can't find what you're looking for? <a href="contact.php" class="text-gold">Contact us directly</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Categories -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>Browse by Category</h2>
                    <p>Find answers organized by topic</p>
                </div>
                
                <div class="row">
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-cogs" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>General Services</h5>
                                <p>Information about our core IT services and offerings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-graduation-cap" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Training Programs</h5>
                                <p>Details about enrollment, certification, and course content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-handshake" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Consulting & Projects</h5>
                                <p>Questions about project timelines, pricing, and processes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-user-cog" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Account & Support</h5>
                                <p>Help with accounts, technical support, and platform usage</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ List Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>All Questions & Answers</h2>
                    <p>Click on any question to view the answer</p>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div id="faqContainer">
                            <?php if (!empty($faqs)): ?>
                                <?php foreach ($faqs as $faq): ?>
                                <div class="faq-item" data-faq-id="<?php echo $faq['id']; ?>">
                                    <div class="faq-question">
                                        <h4><?php echo htmlspecialchars($faq['question']); ?></h4>
                                        <span class="faq-toggle">+</span>
                                    </div>
                                    <div class="faq-answer">
                                        <p><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <i class="fas fa-question-circle text-gold" style="font-size: 4rem;"></i>
                                            <h3 class="mt-3">No FAQs Available</h3>
                                            <p>We're currently updating our FAQ section. Please <a href="contact.php">contact us</a> directly for any questions.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div id="noResults" class="text-center" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-search text-gold" style="font-size: 3rem;"></i>
                                    <h4 class="mt-3">No results found</h4>
                                    <p>We couldn't find any FAQs matching your search. Try different keywords or <a href="contact.php">contact us</a> directly.</p>
                                    <button class="btn btn-outline" onclick="clearSearch()">Clear Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Still Have Questions Section -->
        <section class="section section-alt">
            <div class="container">
                <div class="section-title">
                    <h2>Still Have Questions?</h2>
                    <p>We're here to help with personalized support</p>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-envelope" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Send us a Message</h5>
                                <p>Get detailed answers to complex questions via our contact form.</p>
                                <a href="contact.php" class="btn btn-primary">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-phone" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Call Us Directly</h5>
                                <p>Speak with our experts for immediate assistance and guidance.</p>
                                <a href="tel:+2348053367426" class="btn btn-outline">+234 805 336 7426</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon text-gold mb-3">
                                    <i class="fas fa-calendar-check" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5>Schedule a Consultation</h5>
                                <p>Book a free consultation to discuss your specific needs in detail.</p>
                                <a href="contact.php" class="btn btn-outline">Book Now</a>
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
    <script>
        // Enhanced FAQ search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('faqSearch');
            const faqContainer = document.getElementById('faqContainer');
            const noResults = document.getElementById('noResults');
            const allFaqs = document.querySelectorAll('.faq-item');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasResults = false;
                
                allFaqs.forEach(faq => {
                    const question = faq.querySelector('.faq-question h4').textContent.toLowerCase();
                    const answer = faq.querySelector('.faq-answer p').textContent.toLowerCase();
                    
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        faq.style.display = 'block';
                        hasResults = true;
                    } else {
                        faq.style.display = 'none';
                    }
                });
                
                if (searchTerm.length > 0 && !hasResults) {
                    faqContainer.style.display = 'none';
                    noResults.style.display = 'block';
                } else {
                    faqContainer.style.display = 'block';
                    noResults.style.display = 'none';
                }
            });
        });
        
        function clearSearch() {
            const searchInput = document.getElementById('faqSearch');
            const faqContainer = document.getElementById('faqContainer');
            const noResults = document.getElementById('noResults');
            const allFaqs = document.querySelectorAll('.faq-item');
            
            searchInput.value = '';
            allFaqs.forEach(faq => faq.style.display = 'block');
            faqContainer.style.display = 'block';
            noResults.style.display = 'none';
        }
    </script>
</body>
</html>