# Innovaro Global Services

A modern, responsive website for Innovaro Global Services - a premium IT innovation, training, and consulting company specializing in AI, Cybersecurity, Cloud Computing, Data Analytics, and more.

## 🚀 Features

- **Responsive Design**: Modern, mobile-first design that works across all devices
- **Dynamic Services Display**: Services are loaded dynamically from the database via AJAX
- **Contact Form**: Functional contact form with form validation and AJAX submission
- **Clean Architecture**: Well-organized PHP backend with separate API endpoints
- **Database Integration**: MySQL database with proper schema and sample data
- **Security**: XSS protection and input validation
- **SEO Optimized**: Proper meta tags and semantic HTML structure

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Server**: Apache/Nginx with PHP support
- **Development**: XAMPP (local development)

## 📋 Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP (for local development)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/innovaro-site.git
   cd innovaro-site
   ```

2. **Set up the database**
   - Import the SQL schema:
   ```bash
   mysql -u root -p < sql/innovaro_schema.sql
   ```

3. **Configure database connection**
   - Edit `api/db.php` and update the database credentials:
   ```php
   $DB_HOST = '127.0.0.1';
   $DB_NAME = 'innovaro';
   $DB_USER = 'your_username';
   $DB_PASS = 'your_password';
   ```

4. **Deploy to web server**
   - Copy all files to your web server's document root
   - Ensure PHP and MySQL are properly configured
   - Set appropriate file permissions

## 🏗️ Project Structure

```
innovaro-site/
├── api/                    # Backend API endpoints
│   ├── db.php             # Database connection
│   ├── get_services.php   # Fetch services from database
│   └── save_inquiry.php   # Save contact form submissions
├── assets/                # Static assets
│   ├── css/
│   │   └── style.css      # Main stylesheet
│   ├── images/            # Images and logos
│   └── js/
│       └── main.js        # Frontend JavaScript
├── sql/
│   └── innovaro_schema.sql # Database schema and sample data
├── index.php              # Main website page
└── README.md              # This file
```

## 🔧 Configuration

### Database Setup
The application uses a MySQL database with three main tables:

- **services**: Stores company services and offerings
- **inquiries**: Stores contact form submissions
- **admins**: Optional admin users table

### API Endpoints

- `GET api/get_services.php` - Retrieves all services from the database
- `POST api/save_inquiry.php` - Saves contact form submissions

## 📱 Usage

1. **View Services**: The homepage automatically loads and displays all services from the database
2. **Contact Form**: Users can submit inquiries through the contact form
3. **Responsive Navigation**: Smooth navigation between sections

## 🎨 Customization

### Adding New Services
Add services directly to the database:
```sql
INSERT INTO services (title, slug, description, category) 
VALUES ('Your Service', 'your-service', 'Service description', 'Category');
```

### Styling
Modify `assets/css/style.css` to customize the appearance:
- Color scheme
- Typography
- Layout and spacing
- Responsive breakpoints

## 🔒 Security Features

- Input validation and sanitization
- XSS protection with HTML escaping
- SQL injection prevention with prepared statements
- CSRF protection considerations
- Email validation

## 🚀 Deployment

### Production Deployment
1. Set up a production web server (Apache/Nginx)
2. Configure PHP and MySQL
3. Update database credentials in `api/db.php`
4. Set proper file permissions
5. Enable HTTPS for secure form submissions

### Environment Variables
For better security, consider using environment variables for database credentials instead of hardcoding them.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📞 Contact

**Innovaro Global Services**
- 📍 Address: 35 Bonny Street, Port Harcourt, Rivers State
- 📱 Phone: +234 805-336-7426
- 🌐 Website: [Your Website URL]

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Built with modern web standards and best practices
- Responsive design principles
- Security-first development approach

---

**Innovaro Global Services** - Delivering Business and Software Solutions with Precision and Passion
