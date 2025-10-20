# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

Innovaro Global Services is a complete PHP-based company website built with HTML5, CSS3, JavaScript, PHP 8+, and MySQL. It's designed as a comprehensive business solution for an IT services company offering software management, business analysis, project management, and various technology services.

## Development Environment & Setup

### Prerequisites
- **Web Server**: Apache/Nginx (typically XAMPP for Windows development)
- **PHP**: Version 8.0+ with PDO extension
- **MySQL**: Version 5.7+ or MariaDB
- **Browser**: Modern web browser for testing

### Database Setup
```sql
-- Import the database schema
mysql -u username -p < database.sql
-- Or use phpMyAdmin to import database.sql
```

### Configuration
The main configuration is in `includes/config.php`:
- Database credentials (DB_HOST, DB_NAME, DB_USER, DB_PASS)
- Site settings (SITE_NAME, SITE_URL, CONTACT_EMAIL)
- Security settings (password hashing, session config)

### Local Development
1. Place files in web server directory (e.g., `C:/xampp/htdocs/innovaro-website/`)
2. Start Apache and MySQL services
3. Import `database.sql` into MySQL
4. Update database credentials in `includes/config.php`
5. Access via `http://localhost/innovaro-website/`

## Architecture Overview

### MVC-Style Architecture
The codebase follows a modular PHP architecture with clear separation of concerns:

**Configuration Layer** (`includes/config.php`):
- Singleton Database class with PDO
- Security settings and session management
- Global utility functions (sanitization, authentication checks)

**Data Layer** (`includes/functions.php`):
- ServiceManager: Handles all service-related operations
- MessageManager: Manages contact form submissions
- FAQManager: Handles FAQ content
- EnrollmentManager: User enrollment in services
- Auth class (`includes/auth.php`): User authentication and management

**Presentation Layer** (Root PHP files):
- Public pages: `index.php`, `about.php`, `services.php`, `contact.php`, `faqs.php`
- User system: `login.php`, `register.php`, `dashboard.php`
- Processing handlers in `php/` directory

### Database Schema
Five main tables with relational structure:
- `users`: Authentication and user profiles (with role-based access)
- `services`: Company services catalog (categorized by type)
- `messages`: Contact form submissions
- `faqs`: Frequently asked questions
- `enrollments`: User service enrollments (with foreign keys)

### Security Implementation
- **Password Security**: bcrypt hashing with configurable cost
- **SQL Injection Protection**: PDO prepared statements throughout
- **XSS Prevention**: Input sanitization via `sanitize_input()`
- **Session Security**: httpOnly cookies, secure session handling
- **Authentication**: Role-based access control (client/admin)

## Key Development Patterns

### Database Operations
All database interactions use the singleton Database class:
```php
$db = getDB(); // Gets PDO connection
$stmt = $db->prepare("SELECT * FROM table WHERE id = ?");
$stmt->execute([$id]);
```

### Authentication Flow
- Authentication handled by Auth class in `includes/auth.php`
- Session-based with utility functions: `is_logged_in()`, `is_admin()`, `require_login()`
- Flash messaging system for user feedback

### Manager Classes
Each major feature has a dedicated manager class:
- Instantiate with `new ServiceManager()`, `new MessageManager()`, etc.
- All methods return consistent response arrays with 'success' and 'message' keys
- Error handling with logging via `handle_error()`

## Common Development Tasks

### Testing the Application
Since this is a traditional PHP application without a formal testing framework:
- **Manual Testing**: Use browser to test all pages and functionality
- **Database Testing**: Verify CRUD operations through the web interface
- **Form Testing**: Test all forms (contact, login, registration, enrollment)
- **Authentication Testing**: Verify login/logout and access controls

### Adding New Features
1. **Database Changes**: Update `database.sql` with new tables/columns
2. **Manager Class**: Add methods to appropriate manager in `includes/functions.php`
3. **Frontend Pages**: Create/update PHP files in root directory
4. **Styling**: Update `css/style.css` or `assets/css/style.css`
5. **JavaScript**: Add functionality to `js/main.js` or `assets/js/main.js`

### Code Quality Checks
No formal linting/testing commands exist. Manual verification includes:
- Check PHP syntax: `php -l filename.php`
- Validate HTML markup in browser developer tools
- Test database connectivity and operations
- Verify responsive design across device sizes

### Debugging
- PHP errors logged via `error_log()` in `handle_error()` function
- Database errors caught and logged in try-catch blocks
- Use browser developer tools for frontend debugging
- Check Apache/PHP error logs for server-side issues

## File Structure & Organization

### Core Application Files
- `index.php`: Homepage with service showcases
- `about.php`: Company information and mission
- `services.php`: Complete services catalog with enrollment
- `contact.php`: Contact form with backend processing
- `faqs.php`: Interactive FAQ system with search
- `dashboard.php`: User dashboard for enrolled services
- `login.php` / `register.php`: Authentication pages

### Backend Structure
- `includes/`: Core PHP classes and configuration
- `php/`: Form processing handlers and API endpoints
- `api/`: REST-like endpoints for AJAX operations
- `sql/`: Database schema and additional SQL files

### Frontend Assets
- `css/` and `assets/css/`: Stylesheets (duplicate locations)
- `js/` and `assets/js/`: JavaScript files (duplicate locations)
- `assets/images/`: Image assets and media files

### Data Management
- All user input sanitized via `sanitize_input()` before database operations
- Prepared statements used consistently for SQL operations
- Role-based access control enforced at both PHP and database levels

## Business Logic Notes

### Service Categories
Services are organized by category: 'core', 'innovation', 'training', 'consulting', 'additional'

### User Roles
Two user types: 'client' (default) and 'admin' with different access levels

### Enrollment System
Users can enroll in services/training programs through the dashboard

### Contact System
Contact forms save to database and can be managed by administrators

This codebase represents a complete, production-ready business website with user management, service catalog, and content management capabilities built on traditional LAMP stack technologies.