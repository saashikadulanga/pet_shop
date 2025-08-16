<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Require login to access this page
requireLogin();

$success_message = '';
$error_message = '';

// Handle profile update
if ($_POST) {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $address = sanitizeInput($_POST['address'] ?? '');
    
    // Validation
    if (empty($name) || empty($email)) {
        $error_message = 'Name and email are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // In a real application, you would update the database
        // For now, we'll just update session data
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        
        $success_message = 'Profile updated successfully!';
    }
}

// Get current user data
$user_name = getUserName();
$user_email = getUserEmail();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Profile Section -->
    <section class="profile-section py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="profile-sidebar">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="profile-avatar mb-3">
                                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                                </div>
                                <h5 class="fw-bold"><?php echo htmlspecialchars($user_name); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($user_email); ?></p>
                            </div>
                        </div>
                        
                        <div class="profile-menu mt-4">
                            <div class="list-group">
                                <a href="profile.php" class="list-group-item list-group-item-action active">
                                    <i class="fas fa-user me-2"></i>Profile Settings
                                </a>
                                <a href="my-adoptions.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-heart me-2"></i>My Adoptions
                                </a>
                                <a href="my-orders.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-shopping-bag me-2"></i>My Orders
                                </a>
                                <a href="logout.php" class="list-group-item list-group-item-action text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="profile-content">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Profile Settings
                                </h4>
                            </div>
                            <div class="card-body">
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
                                                   value="<?php echo htmlspecialchars($user_name); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address *</label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="<?php echo htmlspecialchars($user_email); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>Update Profile
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    <i class="fas fa-lock me-2"></i>Change Password
                                </h4>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="currentPassword" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="currentPassword">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newPassword">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmNewPassword">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="fas fa-key me-2"></i>Change Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
</body>
</html>