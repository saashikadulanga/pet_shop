<?php
session_start();
include_once 'includes/config.php';
include_once 'includes/functions.php';

// Get pet ID from URL
$pet_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pet = getPetById($pet_id);

if (!$pet) {
    header('Location: adoption.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pet['name']); ?> - Pet Details - PetPal Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Pet Details Section -->
    <section class="pet-details py-5 mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="pet-image-container">
                        <img src="<?php echo htmlspecialchars($pet['image']); ?>" 
                             alt="<?php echo htmlspecialchars($pet['name']); ?>" 
                             class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pet-info">
                        <h1 class="display-4 fw-bold mb-3"><?php echo htmlspecialchars($pet['name']); ?></h1>
                        <p class="lead text-muted mb-4"><?php echo htmlspecialchars($pet['breed']); ?></p>
                        
                        <div class="pet-details-grid mb-4">
                            <div class="detail-item">
                                <i class="fas fa-birthday-cake text-primary"></i>
                                <span class="fw-bold">Age:</span>
                                <span><?php echo htmlspecialchars($pet['age']); ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-venus-mars text-primary"></i>
                                <span class="fw-bold">Gender:</span>
                                <span><?php echo htmlspecialchars($pet['gender']); ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-weight text-primary"></i>
                                <span class="fw-bold">Size:</span>
                                <span><?php echo htmlspecialchars($pet['size']); ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-paw text-primary"></i>
                                <span class="fw-bold">Type:</span>
                                <span><?php echo ucfirst(htmlspecialchars($pet['type'])); ?></span>
                            </div>
                        </div>
                        
                        <div class="pet-health mb-4">
                            <h5 class="fw-bold mb-3">Health Status</h5>
                            <div class="health-badges">
                                <?php if ($pet['vaccinated']): ?>
                                    <span class="badge bg-success me-2 mb-2">
                                        <i class="fas fa-check me-1"></i>Vaccinated
                                    </span>
                                <?php endif; ?>
                                <?php if ($pet['spayed_neutered']): ?>
                                    <span class="badge bg-success me-2 mb-2">
                                        <i class="fas fa-check me-1"></i>Spayed/Neutered
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning me-2 mb-2">
                                        <i class="fas fa-times me-1"></i>Not Spayed/Neutered
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="pet-description mb-4">
                            <h5 class="fw-bold mb-3">About <?php echo htmlspecialchars($pet['name']); ?></h5>
                            <p class="text-muted"><?php echo htmlspecialchars($pet['description']); ?></p>
                        </div>
                        
                        <div class="adoption-actions">
                            <button class="btn btn-primary btn-lg me-3" onclick="openAdoptionModal(<?php echo $pet['id']; ?>, '<?php echo htmlspecialchars($pet['name']); ?>')">
                                <i class="fas fa-heart me-2"></i>Adopt <?php echo htmlspecialchars($pet['name']); ?>
                            </button>
                            <a href="adoption.php" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to All Pets
                            </a>
                        </div>
                    </div>
                </div>
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