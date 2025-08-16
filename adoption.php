<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get all pets
$pets = getAllPets();

// Handle filtering
$filtered_pets = $pets;
$type = isset($_GET['type']) ? sanitizeInput($_GET['type']) : '';
$age = isset($_GET['age']) ? sanitizeInput($_GET['age']) : '';
$size = isset($_GET['size']) ? sanitizeInput($_GET['size']) : '';

// Apply filters
if (!empty($type)) {
    $filtered_pets = array_filter($filtered_pets, function($pet) use ($type) {
        return $pet['type'] === $type;
    });
}

if (!empty($age)) {
    $filtered_pets = array_filter($filtered_pets, function($pet) use ($age) {
        $pet_age = strtolower($pet['age']);
        switch ($age) {
            case 'puppy':
                return strpos($pet_age, 'month') !== false || 
                       (strpos($pet_age, 'year') !== false && intval($pet_age) <= 1);
            case 'young':
                return strpos($pet_age, 'year') !== false && 
                       intval($pet_age) >= 1 && intval($pet_age) <= 3;
            case 'adult':
                return strpos($pet_age, 'year') !== false && 
                       intval($pet_age) >= 3 && intval($pet_age) <= 7;
            case 'senior':
                return strpos($pet_age, 'year') !== false && intval($pet_age) > 7;
            default:
                return true;
        }
    });
}

if (!empty($size)) {
    $filtered_pets = array_filter($filtered_pets, function($pet) use ($size) {
        return strtolower($pet['size']) === strtolower($size);
    });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption - PetPal Online</title>
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
                    <h1 class="display-4 fw-bold mb-3">Find Your Perfect Companion</h1>
                    <p class="lead text-muted">Give a loving home to these adorable pets waiting for their forever families</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Adoption Process -->
    <section class="adoption-process py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Adoption Process</h2>
                    <p class="lead text-muted">Simple steps to bring your new family member home</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="process-step text-center">
                        <div class="step-number">1</div>
                        <h5 class="fw-bold mt-3">Browse Pets</h5>
                        <p class="text-muted">Find the perfect pet that matches your lifestyle</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-step text-center">
                        <div class="step-number">2</div>
                        <h5 class="fw-bold mt-3">Submit Application</h5>
                        <p class="text-muted">Fill out our adoption application form</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-step text-center">
                        <div class="step-number">3</div>
                        <h5 class="fw-bold mt-3">Meet & Greet</h5>
                        <p class="text-muted">Visit and spend time with your chosen pet</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-step text-center">
                        <div class="step-number">4</div>
                        <h5 class="fw-bold mt-3">Take Home</h5>
                        <p class="text-muted">Complete the adoption and welcome your new family member</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pet Filters -->
    <section class="pet-filters py-4 bg-light">
        <div class="container">
            <form method="GET" action="">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="dog" <?php echo $type === 'dog' ? 'selected' : ''; ?>>Dogs</option>
                            <option value="cat" <?php echo $type === 'cat' ? 'selected' : ''; ?>>Cats</option>
                            <option value="bird" <?php echo $type === 'bird' ? 'selected' : ''; ?>>Birds</option>
                            <option value="rabbit" <?php echo $type === 'rabbit' ? 'selected' : ''; ?>>Rabbits</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="age" class="form-select">
                            <option value="">All Ages</option>
                            <option value="puppy" <?php echo $age === 'puppy' ? 'selected' : ''; ?>>Puppy/Kitten</option>
                            <option value="young" <?php echo $age === 'young' ? 'selected' : ''; ?>>Young</option>
                            <option value="adult" <?php echo $age === 'adult' ? 'selected' : ''; ?>>Adult</option>
                            <option value="senior" <?php echo $age === 'senior' ? 'selected' : ''; ?>>Senior</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="size" class="form-select">
                            <option value="">All Sizes</option>
                            <option value="small" <?php echo $size === 'small' ? 'selected' : ''; ?>>Small</option>
                            <option value="medium" <?php echo $size === 'medium' ? 'selected' : ''; ?>>Medium</option>
                            <option value="large" <?php echo $size === 'large' ? 'selected' : ''; ?>>Large</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100 me-2">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Available Pets -->
    <section class="available-pets py-5">
        <div class="container">
            <div class="row g-4">
                <?php if (empty($filtered_pets)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                        <h4>No pets found</h4>
                        <p class="text-muted">Try adjusting your filters to see more pets.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($filtered_pets as $pet): ?>
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
                                <div class="pet-health mb-3">
                                    <?php if ($pet['vaccinated']): ?>
                                        <span class="badge bg-success me-1">
                                            <i class="fas fa-check me-1"></i>Vaccinated
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($pet['spayed_neutered']): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Spayed/Neutered
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <p class="text-muted mb-3"><?php echo htmlspecialchars($pet['description']); ?></p>
                                <div class="d-grid gap-2">
                                    <a href="pet-details.php?id=<?php echo $pet['id']; ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </a>
                                    <button class="btn btn-primary" onclick="openAdoptionModal(<?php echo $pet['id']; ?>, '<?php echo htmlspecialchars($pet['name']); ?>')">
                                        <i class="fas fa-heart me-2"></i>Adopt <?php echo htmlspecialchars($pet['name']); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Adoption Modal -->
    <div class="modal fade" id="adoptionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adoption Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="adoptionForm" method="POST" action="includes/process-adoption.php">
                        <input type="hidden" name="pet_id" id="petId">
                        <input type="hidden" name="pet_name" id="petName">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone *</label>
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address *</label>
                                <textarea name="address" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Housing Type *</label>
                                <select name="housing_type" class="form-select" required>
                                    <option value="">Select...</option>
                                    <option value="house">House</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="condo">Condo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Do you rent or own? *</label>
                                <select name="rent_own" class="form-select" required>
                                    <option value="">Select...</option>
                                    <option value="own">Own</option>
                                    <option value="rent">Rent</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Why do you want to adopt this pet? *</label>
                                <textarea name="reason" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Do you have experience with pets?</label>
                                <textarea name="experience" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="adoptionForm" class="btn btn-primary">Submit Application</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function openAdoptionModal(petId, petName) {
            document.getElementById('petId').value = petId;
            document.getElementById('petName').value = petName;
            document.querySelector('#adoptionModal .modal-title').textContent = 'Adoption Application for ' + petName;
            new bootstrap.Modal(document.getElementById('adoptionModal')).show();
        }
    </script>
</body>
</html>