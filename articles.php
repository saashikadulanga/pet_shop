<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get all articles
$articles = getArticles();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care Articles - PetPal Online</title>
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
                    <h1 class="display-4 fw-bold mb-3">Pet Care Articles</h1>
                    <p class="lead text-muted">Expert advice and tips for keeping your pets happy and healthy</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="articles-section py-5">
        <div class="container">
            <div class="row g-4">
                <?php foreach ($articles as $article): ?>
                <div class="col-lg-4 col-md-6">
                    <article class="article-card">
                        <div class="article-image">
                            <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($article['title']); ?>" 
                                 class="img-fluid">
                            <div class="article-category"><?php echo htmlspecialchars($article['category']); ?></div>
                        </div>
                        <div class="article-content p-4">
                            <div class="article-meta mb-3">
                                <span class="text-muted">
                                    <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($article['author']); ?>
                                </span>
                                <span class="text-muted ms-3">
                                    <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($article['date'])); ?>
                                </span>
                                <span class="text-muted ms-3">
                                    <i class="fas fa-clock me-1"></i><?php echo htmlspecialchars($article['read_time']); ?>
                                </span>
                            </div>
                            <h5 class="fw-bold mb-3">
                                <a href="article-details.php?id=<?php echo $article['id']; ?>" class="text-decoration-none text-dark">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                            </h5>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                            <a href="article-details.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-right me-2"></i>Read More
                            </a>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3">Get Pet Care Tips in Your Inbox</h3>
                    <p class="mb-0">Subscribe to receive the latest articles and expert advice for your pets.</p>
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