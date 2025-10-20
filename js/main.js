/**
 * Innovaro Global Services - Main JavaScript File
 * Handles navigation, forms, animations, and interactive features
 */

// DOM Content Loaded Event
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initNavigation();
    initForms();
    initFAQ();
    initAnimations();
    initScrollEffects();
});

/**
 * Navigation Functionality
 */
function initNavigation() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-menu a');

    // Mobile menu toggle
    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            
            // Animate hamburger icon
            const spans = navToggle.querySelectorAll('span');
            spans.forEach((span, index) => {
                if (navMenu.classList.contains('active')) {
                    if (index === 0) span.style.transform = 'rotate(45deg) translate(5px, 5px)';
                    if (index === 1) span.style.opacity = '0';
                    if (index === 2) span.style.transform = 'rotate(-45deg) translate(7px, -6px)';
                } else {
                    span.style.transform = 'none';
                    span.style.opacity = '1';
                }
            });
        });
    }

    // Close mobile menu when clicking on links
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                const spans = navToggle.querySelectorAll('span');
                spans.forEach(span => {
                    span.style.transform = 'none';
                    span.style.opacity = '1';
                });
            }
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                const spans = navToggle.querySelectorAll('span');
                spans.forEach(span => {
                    span.style.transform = 'none';
                    span.style.opacity = '1';
                });
            }
        }
    });

    // Active navigation highlighting
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href').split('/').pop();
        if (linkPage === currentPage || (currentPage === '' && linkPage === 'index.php')) {
            link.classList.add('active');
        }
    });
}

/**
 * Form Validation and Handling
 */
function initForms() {
    // Contact form validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            validateAndSubmitContactForm();
        });
    }

    // Login form validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            validateAndSubmitLoginForm();
        });
    }

    // Registration form validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            validateAndSubmitRegisterForm();
        });
    }

    // Real-time validation for form inputs
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateInput(this);
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateInput(this);
            }
        });
    });
}

/**
 * Validate individual form input
 */
function validateInput(input) {
    const value = input.value.trim();
    let isValid = true;
    let errorMessage = '';

    // Remove existing error state
    input.classList.remove('error');
    removeErrorMessage(input);

    // Required field validation
    if (input.hasAttribute('required') && value === '') {
        isValid = false;
        errorMessage = 'This field is required';
    }
    
    // Email validation
    else if (input.type === 'email' && value !== '') {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }
    
    // Password validation
    else if (input.type === 'password' && value !== '') {
        if (value.length < 6) {
            isValid = false;
            errorMessage = 'Password must be at least 6 characters long';
        }
    }
    
    // Password confirmation validation
    else if (input.name === 'confirm_password') {
        const passwordField = document.querySelector('input[name="password"]');
        if (passwordField && value !== passwordField.value) {
            isValid = false;
            errorMessage = 'Passwords do not match';
        }
    }

    if (!isValid) {
        input.classList.add('error');
        showErrorMessage(input, errorMessage);
    }

    return isValid;
}

/**
 * Show error message for input field
 */
function showErrorMessage(input, message) {
    let errorElement = input.parentNode.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        input.parentNode.appendChild(errorElement);
    }
    errorElement.textContent = message;
}

/**
 * Remove error message for input field
 */
function removeErrorMessage(input) {
    const errorElement = input.parentNode.querySelector('.error-message');
    if (errorElement) {
        errorElement.remove();
    }
}

/**
 * Validate and submit contact form
 */
function validateAndSubmitContactForm() {
    const form = document.getElementById('contactForm');
    const inputs = form.querySelectorAll('.form-control');
    let isFormValid = true;

    inputs.forEach(input => {
        if (!validateInput(input)) {
            isFormValid = false;
        }
    });

    if (isFormValid) {
        submitForm(form, 'php/contact.php');
    }
}

/**
 * Validate and submit login form
 */
function validateAndSubmitLoginForm() {
    const form = document.getElementById('loginForm');
    const inputs = form.querySelectorAll('.form-control');
    let isFormValid = true;

    inputs.forEach(input => {
        if (!validateInput(input)) {
            isFormValid = false;
        }
    });

    if (isFormValid) {
        submitForm(form, 'php/login.php');
    }
}

/**
 * Validate and submit registration form
 */
function validateAndSubmitRegisterForm() {
    const form = document.getElementById('registerForm');
    const inputs = form.querySelectorAll('.form-control');
    let isFormValid = true;

    inputs.forEach(input => {
        if (!validateInput(input)) {
            isFormValid = false;
        }
    });

    if (isFormValid) {
        submitForm(form, 'php/register.php');
    }
}

/**
 * Submit form via AJAX
 */
function submitForm(form, actionUrl) {
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.textContent;

    // Show loading state
    submitBtn.textContent = 'Sending...';
    submitBtn.disabled = true;

    fetch(actionUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            if (form.id === 'contactForm') {
                form.reset();
            } else if (form.id === 'loginForm' && data.redirect) {
                window.location.href = data.redirect;
            } else if (form.id === 'registerForm') {
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            }
        } else {
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred. Please try again.');
    })
    .finally(() => {
        submitBtn.textContent = originalBtnText;
        submitBtn.disabled = false;
    });
}

/**
 * Show alert message
 */
function showAlert(type, message) {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());

    // Create new alert
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;

    // Insert alert at the top of the main content
    const main = document.querySelector('main');
    const firstChild = main.firstElementChild;
    if (firstChild) {
        firstChild.insertAdjacentElement('beforebegin', alert);
    } else {
        main.appendChild(alert);
    }

    // Auto-remove alert after 5 seconds
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);

    // Scroll to alert
    alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * FAQ Functionality
 */
function initFAQ() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const isActive = this.classList.contains('active');

            // Close all FAQ items
            faqQuestions.forEach(q => {
                q.classList.remove('active');
                q.nextElementSibling.classList.remove('active');
            });

            // Toggle current item
            if (!isActive) {
                this.classList.add('active');
                answer.classList.add('active');
            }
        });
    });
}

/**
 * Animation Effects
 */
function initAnimations() {
    // Fade in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.card, .service-item, .section-title');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(element);
    });
}

/**
 * Scroll Effects
 */
function initScrollEffects() {
    let lastScrollTop = 0;
    const header = document.querySelector('header');
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Header hide/show on scroll
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Enrollment functionality
 */
function enrollInService(serviceId) {
    if (!confirm('Are you sure you want to enroll in this service?')) {
        return;
    }

    const data = new FormData();
    data.append('service_id', serviceId);

    fetch('php/enroll.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            // Update button state
            const enrollBtn = document.querySelector(`[onclick="enrollInService(${serviceId})"]`);
            if (enrollBtn) {
                enrollBtn.textContent = 'Enrolled';
                enrollBtn.disabled = true;
                enrollBtn.classList.remove('btn-primary');
                enrollBtn.classList.add('btn-secondary');
            }
        } else {
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred. Please try again.');
    });
}

/**
 * Load more content (for services or other paginated content)
 */
function loadMoreContent(page, container, endpoint) {
    const loadMoreBtn = document.querySelector('.load-more-btn');
    
    if (loadMoreBtn) {
        loadMoreBtn.textContent = 'Loading...';
        loadMoreBtn.disabled = true;
    }

    fetch(`${endpoint}?page=${page}`)
    .then(response => response.json())
    .then(data => {
        if (data.success && data.content) {
            const containerElement = document.querySelector(container);
            containerElement.insertAdjacentHTML('beforeend', data.content);
            
            if (!data.hasMore) {
                if (loadMoreBtn) {
                    loadMoreBtn.remove();
                }
            } else {
                if (loadMoreBtn) {
                    loadMoreBtn.textContent = 'Load More';
                    loadMoreBtn.disabled = false;
                    loadMoreBtn.onclick = () => loadMoreContent(page + 1, container, endpoint);
                }
            }
        } else {
            showAlert('error', 'Failed to load more content.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while loading content.');
    })
    .finally(() => {
        if (loadMoreBtn) {
            loadMoreBtn.textContent = 'Load More';
            loadMoreBtn.disabled = false;
        }
    });
}

/**
 * Search functionality
 */
function initSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    
    if (searchInput && searchResults) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
                return;
            }
            
            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        });
    }
}

function performSearch(query) {
    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '<div class="spinner"></div>';
    searchResults.style.display = 'block';
    
    fetch(`php/search.php?q=${encodeURIComponent(query)}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            searchResults.innerHTML = data.results;
        } else {
            searchResults.innerHTML = '<p>No results found.</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        searchResults.innerHTML = '<p>Search error occurred.</p>';
    });
}

/**
 * Utility Functions
 */

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-NG', {
        style: 'currency',
        currency: 'NGN'
    }).format(amount);
}

// Format date
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}