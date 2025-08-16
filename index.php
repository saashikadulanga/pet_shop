<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get featured pets and products
$featured_pets = getFeaturedPets();
$featured_products = getFeaturedProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPal Online - Your Trusted Pet Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-4">
                            Find Your Perfect <span class="text-primary">Companion</span>
                        </h1>
                        <p class="lead mb-4">
                            Welcome to PetPal Online - your trusted destination for pet adoption, 
                            premium pet products, and expert care advice. Give a loving home to 
                            adorable pets waiting for their forever families.
                        </p>
                        <div class="hero-buttons">
                            <a href="adoption.php" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-heart me-2"></i>Adopt Now
                            </a>
                            <a href="shop.php" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-shopping-cart me-2"></i>Shop Products
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=800" 
                             alt="Happy pets" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Why Choose PetPal?</h2>
                    <p class="lead text-muted">We're committed to connecting loving families with amazing pets</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-heart fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Loving Care</h4>
                        <p class="text-muted">All our pets receive the best care and attention before finding their forever homes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Health Guaranteed</h4>
                        <p class="text-muted">Every pet comes with health certificates and vaccination records.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Expert Support</h4>
                        <p class="text-muted">Our team provides ongoing support and advice for new pet parents.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Pets Section -->
    <section class="featured-pets py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Featured Pets</h2>
                    <p class="lead text-muted">Meet some of our adorable pets looking for loving homes</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($featured_pets as $pet): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="pet-card">
                        <div class="pet-image">
                            <img src="<?php echo htmlspecialchars($pet['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($pet['name']); ?>" 
                                 class="img-fluid">
                            <div class="pet-badge"><?php echo htmlspecialchars($pet['age']); ?></div>
                        </div>
                        <div class="pet-info p-4">
                            <h5 class="fw-bold mb-2"><?php echo htmlspecialchars($pet['name']); ?></h5>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($pet['breed']); ?></p>
                            <div class="pet-details mb-3">
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-venus-mars me-1"></i><?php echo htmlspecialchars($pet['gender']); ?>
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-weight me-1"></i><?php echo htmlspecialchars($pet['size']); ?>
                                </span>
                            </div>
                            <a href="pet-details.php?id=<?php echo $pet['id']; ?>" class="btn btn-primary w-100">
                                <i class="fas fa-heart me-2"></i>Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-5">
                <a href="adoption.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-paw me-2"></i>View All Pets
                </a>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Popular Products</h2>
                    <p class="lead text-muted">Everything your pet needs for a happy and healthy life</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($featured_products as $product): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="img-fluid">
                            <?php if ($product['discount'] > 0): ?>
                            <div class="product-badge">-<?php echo $product['discount']; ?>%</div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info p-4">
                            <h5 class="fw-bold mb-2"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($product['category']); ?></p>
                            <div class="product-rating mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $product['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                                <span class="ms-2 text-muted">(<?php echo $product['reviews']; ?>)</span>
                            </div>
                            <div class="product-price mb-3">
                                <?php if ($product['discount'] > 0): ?>
                                    <span class="text-decoration-line-through text-muted me-2">$<?php echo number_format($product['original_price'], 2); ?></span>
                                <?php endif; ?>
                                <span class="fw-bold text-primary fs-5">$<?php echo number_format($product['price'], 2); ?></span>
                            </div>
                            <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-shopping-cart me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-5">
                <a href="shop.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>Shop All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3">Stay Updated with PetPal</h3>
                    <p class="mb-0">Get the latest news about new arrivals, pet care tips, and special offers.</p>
                </div>
                <div class="col-lg-6">
                    <form class="newsletter-form d-flex gap-2" method="POST" action="includes/newsletter.php">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-light">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>