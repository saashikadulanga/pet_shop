<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = getProductById($product_id);

if (!$product) {
    header('Location: shop.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Product Details Section -->
    <section class="product-details py-5 mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" 
                             class="img-fluid rounded-4 shadow-lg">
                        <?php if ($product['discount'] > 0): ?>
                        <div class="product-badge">-<?php echo $product['discount']; ?>%</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-info">
                        <div class="product-category mb-2">
                            <span class="badge bg-light text-dark"><?php echo ucfirst(htmlspecialchars($product['category'])); ?></span>
                        </div>
                        
                        <h1 class="display-4 fw-bold mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
                        
                        <div class="product-rating mb-4">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= $product['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                            <?php endfor; ?>
                            <span class="ms-2 text-muted">(<?php echo $product['reviews']; ?> reviews)</span>
                        </div>
                        
                        <div class="product-price mb-4">
                            <?php if ($product['discount'] > 0): ?>
                                <span class="text-decoration-line-through text-muted me-3 fs-4">$<?php echo number_format($product['original_price'], 2); ?></span>
                            <?php endif; ?>
                            <span class="fw-bold text-primary display-5">$<?php echo number_format($product['price'], 2); ?></span>
                            <?php if ($product['discount'] > 0): ?>
                                <span class="badge bg-danger ms-3">Save <?php echo $product['discount']; ?>%</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-description mb-4">
                            <h5 class="fw-bold mb-3">Product Description</h5>
                            <p class="text-muted"><?php echo htmlspecialchars($product['description']); ?></p>
                        </div>
                        
                        <div class="product-features mb-4">
                            <h5 class="fw-bold mb-3">Features</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>High quality materials</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Safe for pets</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Easy to use</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Durable construction</li>
                            </ul>
                        </div>
                        
                        <div class="product-actions">
                            <div class="quantity-selector mb-3">
                                <label class="form-label fw-bold">Quantity:</label>
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                                    <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-primary btn-lg me-3" onclick="addToCart()">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                                <a href="shop.php" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Shop
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="related-products py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Related Products</h2>
                    <p class="lead text-muted">You might also like these products</p>
                </div>
            </div>
            <div class="row g-4">
                <?php 
                $all_products = getAllProducts();
                $related_products = array_filter($all_products, function($p) use ($product) {
                    return $p['category'] === $product['category'] && $p['id'] !== $product['id'];
                });
                $related_products = array_slice($related_products, 0, 3);
                ?>
                <?php foreach ($related_products as $related): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($related['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($related['name']); ?>" 
                                 class="img-fluid">
                            <?php if ($related['discount'] > 0): ?>
                            <div class="product-badge">-<?php echo $related['discount']; ?>%</div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info p-4">
                            <h5 class="fw-bold mb-2"><?php echo htmlspecialchars($related['name']); ?></h5>
                            <p class="text-muted mb-3"><?php echo ucfirst(htmlspecialchars($related['category'])); ?></p>
                            <div class="product-rating mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $related['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                                <span class="ms-2 text-muted">(<?php echo $related['reviews']; ?>)</span>
                            </div>
                            <div class="product-price mb-3">
                                <?php if ($related['discount'] > 0): ?>
                                    <span class="text-decoration-line-through text-muted me-2">$<?php echo number_format($related['original_price'], 2); ?></span>
                                <?php endif; ?>
                                <span class="fw-bold text-primary fs-5">$<?php echo number_format($related['price'], 2); ?></span>
                            </div>
                            <a href="product-details.php?id=<?php echo $related['id']; ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-shopping-cart me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
        
        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
        
        function addToCart() {
            const quantity = document.getElementById('quantity').value;
            alert(`Added ${quantity} item(s) to cart! (This is a demo - no actual cart functionality)`);
        }
    </script>
</body>
</html>