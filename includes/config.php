<?php
// Database configuration (for future use)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'petpal');

// Site configuration
define('SITE_NAME', 'PetPal Online');
define('SITE_URL', 'http://localhost');
define('ADMIN_EMAIL', 'admin@petpal.com');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>