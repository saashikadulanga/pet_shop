<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Require login to access this page
requireLogin();

// Get user's adoption applications (in a real app, this would come from database)
$adoptions = [
    [
        'id' => 1,
        'pet_name' => 'Buddy',
        'pet_image' => 'https://images.pexels.com/photos/1805164/pexels-photo-1805164.jpeg?auto=compress&cs=tinysrgb&w=400',
        'application_date' => '2024-01-15',
        'status' => 'pending',
        'status_color' => 'warning'
    ],
    [
        'id' => 2,
        'pet_name' => 'Luna',
        'pet_image' => 'https://images.pexels.com/photos/1170986/pexels-photo-1170986.jpeg?auto=compress&cs=tinysrgb&w=400',
        'application_date' => '2024-01-10',
        'status' => 'approved',
        'status_color' => 'success'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Adoptions - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- My Adoptions Section -->
    <section class="my-adoptions-section py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="profile-sidebar">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="profile-avatar mb-3">
                                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                                </div>
                                <h5 class="fw-bold"><?php echo htmlspecialchars(getUserName()); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars(getUserEmail()); ?></p>
                            </div>
                        </div>
                        
                        <div class="profile-menu mt-4">
                            <div class="list-group">
                                <a href="profile.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-user me-2"></i>Profile Settings
                                </a>
                                <a href="my-adoptions.php" class="list-group-item list-group-item-action active">
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
                    <div class="adoptions-content">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    <i class="fas fa-heart me-2"></i>My Adoption Applications
                                </h4>
                            </div>
                            <div class="card-body">
                                <?php if (empty($adoptions)): ?>
                                    <div class="text-center py-5">
                                        <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                                        <h5>No adoption applications yet</h5>
                                        <p class="text-muted">You haven't submitted any adoption applications.</p>
                                        <a href="adoption.php" class="btn btn-primary">
                                            <i class="fas fa-paw me-2"></i>Browse Pets
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="row g-4">
                                        <?php foreach ($adoptions as $adoption): ?>
                                        <div class="col-md-6">
                                            <div class="adoption-card">
                                                <div class="card">
                                                    <div class="row g-0">
                                                        <div class="col-4">
                                                            <img src="<?php echo htmlspecialchars($adoption['pet_image']); ?>" 
                                                                 alt="<?php echo htmlspecialchars($adoption['pet_name']); ?>" 
                                                                 class="img-fluid h-100 object-fit-cover">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo htmlspecialchars($adoption['pet_name']); ?></h5>
                                                                <p class="card-text">
                                                                    <small class="text-muted">
                                                                        Applied: <?php echo date('M j, Y', strtotime($adoption['application_date'])); ?>
                                                                    </small>
                                                                </p>
                                                                <span class="badge bg-<?php echo $adoption['status_color']; ?>">
                                                                    <?php echo ucfirst($adoption['status']); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
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