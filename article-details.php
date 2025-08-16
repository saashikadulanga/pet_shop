<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get article ID from URL
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$article = getArticleById($article_id);

if (!$article) {
    header('Location: articles.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Article Header -->
    <section class="article-header py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="article-category mb-3">
                        <span class="badge bg-primary"><?php echo htmlspecialchars($article['category']); ?></span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4"><?php echo htmlspecialchars($article['title']); ?></h1>
                    <div class="article-meta mb-4">
                        <span class="text-muted me-4">
                            <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($article['author']); ?>
                        </span>
                        <span class="text-muted me-4">
                            <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($article['date'])); ?>
                        </span>
                        <span class="text-muted">
                            <i class="fas fa-clock me-1"></i><?php echo htmlspecialchars($article['read_time']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="article-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="article-image mb-5">
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                             alt="<?php echo htmlspecialchars($article['title']); ?>" 
                             class="img-fluid rounded-4 shadow-lg">
                    </div>
                    
                    <div class="article-body">
                        <p class="lead mb-4"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                        
                        <div class="article-text">
                            <?php 
                            // In a real application, you would store the full article content
                            // For this demo, we'll generate some sample content
                            $full_content = $article['content'] . "
                            
                            <h3>Getting Started</h3>
                            <p>When you first bring your new pet home, it's important to create a safe and comfortable environment. This means pet-proofing your home, setting up a designated space for your pet, and having all necessary supplies ready.</p>
                            
                            <h3>Essential Supplies</h3>
                            <ul>
                                <li>Food and water bowls</li>
                                <li>High-quality pet food</li>
                                <li>Comfortable bedding</li>
                                <li>Toys for mental stimulation</li>
                                <li>Collar and leash (for dogs)</li>
                                <li>Litter box and litter (for cats)</li>
                            </ul>
                            
                            <h3>Building a Routine</h3>
                            <p>Pets thrive on routine. Establish regular feeding times, exercise schedules, and sleep patterns. This helps your pet feel secure and makes training easier.</p>
                            
                            <h3>Health and Wellness</h3>
                            <p>Schedule a veterinary checkup within the first week of bringing your pet home. Discuss vaccination schedules, spaying/neutering, and preventive care with your veterinarian.</p>
                            
                            <h3>Patience and Love</h3>
                            <p>Remember that adjusting to a new home takes time. Be patient with your pet as they learn the rules and routines of their new family. With love, consistency, and proper care, you'll build a strong bond that will last a lifetime.</p>
                            ";
                            echo $full_content;
                            ?>
                        </div>
                    </div>
                    
                    <div class="article-footer mt-5 pt-4 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="article-tags">
                                    <span class="fw-bold me-2">Tags:</span>
                                    <span class="badge bg-light text-dark me-1">Pet Care</span>
                                    <span class="badge bg-light text-dark me-1">New Owners</span>
                                    <span class="badge bg-light text-dark">Tips</span>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="article-share">
                                    <span class="fw-bold me-2">Share:</span>
                                    <a href="#" class="text-decoration-none me-2"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-decoration-none me-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-decoration-none"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <a href="articles.php" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Back to Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <section class="related-articles py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Related Articles</h2>
                    <p class="lead text-muted">More helpful tips for pet owners</p>
                </div>
            </div>
            <div class="row g-4">
                <?php 
                $all_articles = getArticles();
                $related_articles = array_filter($all_articles, function($a) use ($article) {
                    return $a['id'] !== $article['id'];
                });
                $related_articles = array_slice($related_articles, 0, 2);
                ?>
                <?php foreach ($related_articles as $related): ?>
                <div class="col-lg-6">
                    <article class="article-card">
                        <div class="article-image">
                            <img src="<?php echo htmlspecialchars($related['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($related['title']); ?>" 
                                 class="img-fluid">
                            <div class="article-category"><?php echo htmlspecialchars($related['category']); ?></div>
                        </div>
                        <div class="article-content p-4">
                            <div class="article-meta mb-3">
                                <span class="text-muted">
                                    <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($related['author']); ?>
                                </span>
                                <span class="text-muted ms-3">
                                    <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($related['date'])); ?>
                                </span>
                                <span class="text-muted ms-3">
                                    <i class="fas fa-clock me-1"></i><?php echo htmlspecialchars($related['read_time']); ?>
                                </span>
                            </div>
                            <h5 class="fw-bold mb-3">
                                <a href="article-details.php?id=<?php echo $related['id']; ?>" class="text-decoration-none text-dark">
                                    <?php echo htmlspecialchars($related['title']); ?>
                                </a>
                            </h5>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($related['excerpt']); ?></p>
                            <a href="article-details.php?id=<?php echo $related['id']; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-right me-2"></i>Read More
                            </a>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>