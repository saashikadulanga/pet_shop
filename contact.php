<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

$success_message = '';
$error_message = '';

// Handle form submission
if ($_POST) {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    
    // Validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // Process the form (in a real application, you would save to database or send email)
        $email_subject = "Contact Form: " . $subject;
        $email_body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";
        
        // In a real application, you would send the email here
        // For now, we'll just show a success message
        $success_message = 'Thank you for your message! We will get back to you soon.';
        
        // Clear form data
        $name = $email = $phone = $subject = $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Page Header -->
    <section class="page-header bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
                    <p class="lead text-muted">We'd love to hear from you. Get in touch with our team!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-4">
                    <div class="contact-info">
                        <h3 class="fw-bold mb-4">Get in Touch</h3>
                        <p class="text-muted mb-4">Have questions about our pets, products, or services? We're here to help!</p>
                        
                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h5 class="fw-bold">Address</h5>
                                <p class="text-muted">123 Pet Street<br>City, State 12345</p>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h5 class="fw-bold">Phone</h5>
                                <p class="text-muted">(555) 123-4567</p>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h5 class="fw-bold">Email</h5>
                                <p class="text-muted">info@petpal.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h5 class="fw-bold">Business Hours</h5>
                                <p class="text-muted">
                                    Mon - Fri: 9:00 AM - 6:00 PM<br>
                                    Sat: 10:00 AM - 4:00 PM<br>
                                    Sun: Closed
                                </p>
                            </div>
                        </div>
                        
                        <div class="social-links">
                            <h5 class="fw-bold mb-3">Follow Us</h5>
                            <a href="#" class="social-link me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h3 class="fw-bold mb-4">Send us a Message</h3>
                        
                        <?php if ($success_message): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo htmlspecialchars($phone ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Select a subject...</option>
                                        <option value="adoption" <?php echo (isset($subject) && $subject === 'adoption') ? 'selected' : ''; ?>>Pet Adoption</option>
                                        <option value="products" <?php echo (isset($subject) && $subject === 'products') ? 'selected' : ''; ?>>Product Inquiry</option>
                                        <option value="care" <?php echo (isset($subject) && $subject === 'care') ? 'selected' : ''; ?>>Pet Care Advice</option>
                                        <option value="general" <?php echo (isset($subject) && $subject === 'general') ? 'selected' : ''; ?>>General Question</option>
                                        <option value="other" <?php echo (isset($subject) && $subject === 'other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" 
                                              placeholder="Tell us how we can help you..." required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9663095343008!2d-74.00425878459418!3d40.74844097932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80f9cfce5383d5d!2sGoogle!5e0!3m2!1sen!2sus!4v1635959592521!5m2!1sen!2sus" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>