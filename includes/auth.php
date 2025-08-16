<?php
// Authentication helper functions

function authenticateUser($email, $password) {
    // In a real application, this would query a database
    // For demo purposes, we'll use hardcoded users
    $users = [
        [
            'id' => 1,
            'name' => 'Demo User',
            'email' => 'demo@petpal.com',
            'password' => password_hash('demo123', PASSWORD_DEFAULT),
            'role' => 'user'
        ],
        [
            'id' => 2,
            'name' => 'Admin User',
            'email' => 'admin@petpal.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ]
    ];
    
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            return $user;
        }
    }
    
    return false;
}

function userExists($email) {
    // In a real application, this would query a database
    $existing_emails = ['demo@petpal.com', 'admin@petpal.com'];
    return in_array($email, $existing_emails);
}

function createUser($name, $email, $password) {
    // In a real application, this would insert into database
    // For demo purposes, we'll simulate success
    return rand(100, 999); // Return fake user ID
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        $current_page = $_SERVER['REQUEST_URI'];
        header('Location: login.php?redirect=' . urlencode($current_page));
        exit;
    }
}

function getUserName() {
    return $_SESSION['user_name'] ?? 'Guest';
}

function getUserEmail() {
    return $_SESSION['user_email'] ?? '';
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}
?>