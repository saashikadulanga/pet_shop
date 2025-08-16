<?php
session_start();
include_once 'config.php';
include_once 'functions.php';

if ($_POST) {
    $email = sanitizeInput($_POST['email'] ?? '');
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Please enter a valid email address.';
    } else {
        // In a real application, you would save this to a database
        // For now, we'll just show a success message
        $_SESSION['success_message'] = 'Thank you for subscribing to our newsletter!';
    }
    
    // Redirect back to the referring page
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header('Location: ' . $referer);
    exit;
} else {
    header('Location: ../index.php');
    exit;
}
?>