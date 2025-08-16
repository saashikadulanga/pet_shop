<?php
session_start();
include_once 'config.php';
include_once 'functions.php';

if ($_POST) {
    // Sanitize input data
    $pet_id = sanitizeInput($_POST['pet_id'] ?? '');
    $pet_name = sanitizeInput($_POST['pet_name'] ?? '');
    $first_name = sanitizeInput($_POST['first_name'] ?? '');
    $last_name = sanitizeInput($_POST['last_name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $address = sanitizeInput($_POST['address'] ?? '');
    $housing_type = sanitizeInput($_POST['housing_type'] ?? '');
    $rent_own = sanitizeInput($_POST['rent_own'] ?? '');
    $reason = sanitizeInput($_POST['reason'] ?? '');
    $experience = sanitizeInput($_POST['experience'] ?? '');
    
    // Validation
    $errors = [];
    
    if (empty($first_name)) $errors[] = 'First name is required';
    if (empty($last_name)) $errors[] = 'Last name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($phone)) $errors[] = 'Phone number is required';
    if (empty($address)) $errors[] = 'Address is required';
    if (empty($housing_type)) $errors[] = 'Housing type is required';
    if (empty($rent_own)) $errors[] = 'Rent/own status is required';
    if (empty($reason)) $errors[] = 'Reason for adoption is required';
    
    if (empty($errors)) {
        // In a real application, you would save this to a database
        // For now, we'll simulate success and send an email
        
        $subject = "New Adoption Application for $pet_name";
        $message = "
            <h2>New Adoption Application</h2>
            <p><strong>Pet:</strong> $pet_name (ID: $pet_id)</p>
            <p><strong>Applicant:</strong> $first_name $last_name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Address:</strong> $address</p>
            <p><strong>Housing:</strong> $housing_type ($rent_own)</p>
            <p><strong>Reason:</strong> $reason</p>
            <p><strong>Experience:</strong> $experience</p>
        ";
        
        // In a real application, you would send this email
        // sendEmail(ADMIN_EMAIL, $subject, $message);
        
        // Set success message in session
        $_SESSION['success_message'] = "Thank you for your adoption application! We will review your application and contact you within 2-3 business days.";
        
        // Redirect back to adoption page
        header('Location: ../adoption.php');
        exit;
    } else {
        // Set error messages in session
        $_SESSION['error_message'] = implode('<br>', $errors);
        header('Location: ../adoption.php');
        exit;
    }
} else {
    header('Location: ../adoption.php');
    exit;
}
?>