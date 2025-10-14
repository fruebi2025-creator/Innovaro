<?php
// index.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Innovaro Global Services</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="assets/css/style.css ">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
</head>
<body>
  <header class="site-header">
    <div class="container header-inner">
      <div class="brand">
        <div class="logo-circle"><a href="index.php"><img src="assets/images/logo.png" alt=""></a></div>
        <div class="brand-text">
          <h1>INNOVARO</h1>
          <small>Global Services</small>
        </div>
      </div>
      <nav class="main-nav">
        <a href="#services" class="underline-center">Services</a>
        <a href="#training" class="underline-center">Training</a>
        <a href="#contact" class="underline-center">Contact</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="container hero-inner">
        <div class="hero-left">
          <h2>Delivering Business and Software Solutions with Precision and Passion</h2>
          <p>Premium IT innovation, training and consulting — AI, Cybersecurity, Cloud, Data and more.</p>
          <a class="btn primary" href="#services">Explore Services</a>
        </div>
        <div class="hero-right">
          <img src="assets/images/hero-placeholder.png" alt="Hero illustration">
        </div>
      </div>
    </section>

    <section id="services" class="services container">
      <h3>Our Services</h3>
      <p class="lead">We render premium IT and business services across multiple domains.</p>
      <div id="services-list" class="grid"></div>
    </section>

    <section id="training" class="container training">
      <h3>IT Trainings</h3>
      <p>Comprehensive training programs: AI, Cybersecurity, Data Analytics, Web & Mobile Development, Graphics and more.</p>
    </section>

    <section id="contact" class="container contact-section">
      <h3>Contact Us</h3>
      <p>35 Bonny Street, Port Harcourt, Rivers State — +234 805-336-7426</p>

      <form id="contactForm" class="contact-form" onsubmit="return false;">
        <label>
          <span>Name</span>
          <input type="text" name="name" required>
        </label>
        <label>
          <span>Email</span>
          <input type="email" name="email" required>
        </label>
        <label>
          <span>Phone</span>
          <input type="text" name="phone">
        </label>
        <label>
          <span>Message</span>
          <textarea name="message" rows="4" required></textarea>
        </label>
        <button id="contactSubmit" class="btn gold">Send Message</button>
        <div id="contactResult" role="status" style="margin-top:12px;"></div>
      </form>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Innovaro Global Services — All Rights Reserved</p>
    </div>
  </footer>

  <script src="assets\js\main.js"></script>
</body>
</html>
