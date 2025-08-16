<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error_message = '';
$success_message = '';

// Handle login form submission
if ($_POST && isset($_POST['login'])) {
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validation
    if (empty($email) || empty($password)) {
        $error_message = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // Check credentials (in a real app, this would check against database)
        $user = authenticateUser($email, $password);
        
        if ($user) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            
            // Redirect to intended page or home
            $redirect = $_GET['redirect'] ?? 'index.php';
            header('Location: ' . $redirect);
            exit;
        } else {
            $error_message = 'Invalid email or password.';
        }
    }
}

// Handle registration form submission
if ($_POST && isset($_POST['register'])) {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validation
    $errors = [];
    
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($password)) $errors[] = 'Password is required';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters';
    if ($password !== $confirm_password) $errors[] = 'Passwords do not match';
    
    if (empty($errors)) {
        // Check if user already exists
        if (userExists($email)) {
            $error_message = 'An account with this email already exists.';
        } else {
            // Create new user (in a real app, this would save to database)
            $user_id = createUser($name, $email, $password);
            
            if ($user_id) {
                $success_message = 'Account created successfully! You can now log in.';
                // Clear form data
                $name = $email = '';
            } else {
                $error_message = 'Failed to create account. Please try again.';
            }
        }
    } else {
        $error_message = implode('<br>', $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Login Section -->
    <section class="login-section py-5 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-0 shadow-lg rounded-4 overflow-hidden">
                        <!-- Login Form -->
                        <div class="col-lg-6">
                            <div class="login-form p-5">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold">Welcome Back</h2>
                                    <p class="text-muted">Sign in to your PetPal account</p>
                                </div>

                                <?php if ($error_message): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($success_message): ?>
                                    <div class="alert alert-success" role="alert">
                                        <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="loginEmail" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="loginEmail" name="email" 
                                                   value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="loginPassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                    </button>
                                </form>

                                <div class="text-center">
                                    <a href="#" class="text-decoration-none">Forgot your password?</a>
                                </div>

                                <hr class="my-4">

                                <div class="text-center">
                                    <p class="mb-0">Don't have an account? <a href="#" onclick="showRegisterForm()" class="text-decoration-none fw-bold">Sign up</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Register Form -->
                        <div class="col-lg-6 bg-light">
                            <div class="register-form p-5">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold">Create Account</h2>
                                    <p class="text-muted">Join the PetPal community</p>
                                </div>

                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="registerName" class="form-label">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="registerName" name="name" 
                                                   value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registerEmail" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="registerEmail" name="email" 
                                                   value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registerPassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                                        </div>
                                        <div class="form-text">Password must be at least 6 characters long.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                        <label class="form-check-label" for="agreeTerms">
                                            I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                        </label>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-outline-primary w-100 mb-3">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </form>

                                <div class="text-center">
                                    <p class="mb-0">Already have an account? <a href="#" onclick="showLoginForm()" class="text-decoration-none fw-bold">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function showRegisterForm() {
            // This could be enhanced with smooth transitions
            document.querySelector('.login-form').style.display = 'none';
            document.querySelector('.register-form').style.display = 'block';
        }

        function showLoginForm() {
            document.querySelector('.register-form').style.display = 'none';
            document.querySelector('.login-form').style.display = 'block';
        }

        // Demo credentials helper
        document.addEventListener('DOMContentLoaded', function() {
            const loginEmail = document.getElementById('loginEmail');
            const loginPassword = document.getElementById('loginPassword');
            
            // Add demo credentials hint
            const demoHint = document.createElement('div');
            demoHint.className = 'alert alert-info mt-3';
            demoHint.innerHTML = '<strong>Demo Credentials:</strong><br>Email: demo@petpal.com<br>Password: demo123';
            document.querySelector('.login-form form').appendChild(demoHint);
        });
    </script>
</body>
</html>