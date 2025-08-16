<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get all products
$products = getAllProducts();

// Handle filtering
$filtered_products = $products;
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$category = isset($_GET['category']) ? sanitizeInput($_GET['category']) : '';
$price_range = isset($_GET['price_range']) ? sanitizeInput($_GET['price_range']) : '';
$sort = isset($_GET['sort']) ? sanitizeInput($_GET['sort']) : 'name';

// Apply filters
if (!empty($search)) {
    $filtered_products = array_filter($filtered_products, function($product) use ($search) {
        return stripos($product['name'], $search) !== false || 
               stripos($product['category'], $search) !== false;
    });
}

if (!empty($category)) {
    $filtered_products = array_filter($filtered_products, function($product) use ($category) {
        return $product['category'] === $category;
    });
}

if (!empty($price_range)) {
    $filtered_products = array_filter($filtered_products, function($product) use ($price_range) {
        switch ($price_range) {
            case '0-25':
                return $product['price'] <= 25;
            case '25-50':
                return $product['price'] > 25 && $product['price'] <= 50;
            case '50-100':
                return $product['price'] > 50 && $product['price'] <= 100;
            case '100+':
                return $product['price'] > 100;
            default:
                return true;
        }
    });
}

// Apply sorting
switch ($sort) {
    case 'price-low':
        usort($filtered_products, function($a, $b) {
            return $a['price'] <=> $b['price'];
        });
        break;
    case 'price-high':
        usort($filtered_products, function($a, $b) {
            return $b['price'] <=> $a['price'];
        });
        break;
    case 'rating':
        usort($filtered_products, function($a, $b) {
            return $b['rating'] <=> $a['rating'];
        });
        break;
    default:
        usort($filtered_products, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - PetPal Online</title>
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
                    <h1 class="display-4 fw-bold mb-3">Pet Products Shop</h1>
                    <p class="lead text-muted">Everything your furry friends need for a happy life</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Section -->
    <section class="shop-section py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="filters-sidebar">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-filter me-2"></i>Filters
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="">
                                    <!-- Search -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Search Products</label>
                                        <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                                    </div>

                                    <!-- Category Filter -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Category</label>
                                        <select name="category" class="form-select">
                                            <option value="">All Categories</option>
                                            <option value="food" <?php echo $category === 'food' ? 'selected' : ''; ?>>Food & Treats</option>
                                            <option value="toys" <?php echo $category === 'toys' ? 'selected' : ''; ?>>Toys</option>
                                            <option value="accessories" <?php echo $category === 'accessories' ? 'selected' : ''; ?>>Accessories</option>
                                            <option value="health" <?php echo $category === 'health' ? 'selected' : ''; ?>>Health & Care</option>
                                        </select>
                                    </div>

                                    <!-- Price Range -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Price Range</label>
                                        <select name="price_range" class="form-select">
                                            <option value="">All Prices</option>
                                            <option value="0-25" <?php echo $price_range === '0-25' ? 'selected' : ''; ?>>$0 - $25</option>
                                            <option value="25-50" <?php echo $price_range === '25-50' ? 'selected' : ''; ?>>$25 - $50</option>
                                            <option value="50-100" <?php echo $price_range === '50-100' ? 'selected' : ''; ?>>$50 - $100</option>
                                            <option value="100+" <?php echo $price_range === '100+' ? 'selected' : ''; ?>>$100+</option>
                                        </select>
                                    </div>

                                    <!-- Sort By -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Sort By</label>
                                        <select name="sort" class="form-select">
                                            <option value="name" <?php echo $sort === 'name' ? 'selected' : ''; ?>>Name</option>
                                            <option value="price-low" <?php echo $sort === 'price-low' ? 'selected' : ''; ?>>Price: Low to High</option>
                                            <option value="price-high" <?php echo $sort === 'price-high' ? 'selected' : ''; ?>>Price: High to Low</option>
                                            <option value="rating" <?php echo $sort === 'rating' ? 'selected' : ''; ?>>Rating</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 mb-2">Apply Filters</button>
                                    <a href="shop.php" class="btn btn-outline-secondary w-100">Clear All Filters</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    <div class="products-header d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="text-muted">Showing <?php echo count($filtered_products); ?> of <?php echo count($products); ?> products</span>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php if (empty($filtered_products)): ?>
                            <div class="col-12 text-center py-5">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <h4>No products found</h4>
                                <p class="text-muted">Try adjusting your filters or search terms.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($filtered_products as $product): ?>
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
                                        <p class="text-muted mb-3"><?php echo ucfirst(htmlspecialchars($product['category'])); ?></p>
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
                        <?php endif; ?>
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