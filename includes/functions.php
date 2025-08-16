<?php
// Include authentication functions
include_once 'auth.php';

// Include authentication functions
include_once 'auth.php';

// Sample data functions (replace with database queries in production)

function getFeaturedPets() {
    return [
        [
            'id' => 1,
            'name' => 'Buddy',
            'breed' => 'Golden Retriever',
            'age' => '2 years',
            'gender' => 'Male',
            'size' => 'Large',
            'image' => 'https://images.pexels.com/photos/1805164/pexels-photo-1805164.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Friendly and energetic dog looking for an active family.'
        ],
        [
            'id' => 2,
            'name' => 'Luna',
            'breed' => 'Persian Cat',
            'age' => '1 year',
            'gender' => 'Female',
            'size' => 'Medium',
            'image' => 'https://images.pexels.com/photos/1170986/pexels-photo-1170986.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Gentle and affectionate cat perfect for a quiet home.'
        ],
        [
            'id' => 3,
            'name' => 'Max',
            'breed' => 'German Shepherd',
            'age' => '3 years',
            'gender' => 'Male',
            'size' => 'Large',
            'image' => 'https://images.pexels.com/photos/1490908/pexels-photo-1490908.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Loyal and intelligent dog, great with children.'
        ]
    ];
}

function getFeaturedProducts() {
    return [
        [
            'id' => 1,
            'name' => 'Premium Dog Food',
            'category' => 'Food & Treats',
            'price' => 45.99,
            'original_price' => 55.99,
            'discount' => 18,
            'rating' => 5,
            'reviews' => 124,
            'image' => 'https://images.pexels.com/photos/7210754/pexels-photo-7210754.jpeg?auto=compress&cs=tinysrgb&w=400'
        ],
        [
            'id' => 2,
            'name' => 'Interactive Cat Toy',
            'category' => 'Toys',
            'price' => 19.99,
            'original_price' => 19.99,
            'discount' => 0,
            'rating' => 4,
            'reviews' => 89,
            'image' => 'https://images.pexels.com/photos/1404819/pexels-photo-1404819.jpeg?auto=compress&cs=tinysrgb&w=400'
        ],
        [
            'id' => 3,
            'name' => 'Comfortable Pet Bed',
            'category' => 'Accessories',
            'price' => 79.99,
            'original_price' => 99.99,
            'discount' => 20,
            'rating' => 5,
            'reviews' => 156,
            'image' => 'https://images.pexels.com/photos/4498185/pexels-photo-4498185.jpeg?auto=compress&cs=tinysrgb&w=400'
        ]
    ];
}

function getAllPets() {
    return [
        [
            'id' => 1,
            'name' => 'Buddy',
            'breed' => 'Golden Retriever',
            'age' => '2 years',
            'gender' => 'Male',
            'size' => 'Large',
            'type' => 'dog',
            'image' => 'https://images.pexels.com/photos/1805164/pexels-photo-1805164.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Friendly and energetic dog looking for an active family.',
            'vaccinated' => true,
            'spayed_neutered' => true
        ],
        [
            'id' => 2,
            'name' => 'Luna',
            'breed' => 'Persian Cat',
            'age' => '1 year',
            'gender' => 'Female',
            'size' => 'Medium',
            'type' => 'cat',
            'image' => 'https://images.pexels.com/photos/1170986/pexels-photo-1170986.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Gentle and affectionate cat perfect for a quiet home.',
            'vaccinated' => true,
            'spayed_neutered' => true
        ],
        [
            'id' => 3,
            'name' => 'Max',
            'breed' => 'German Shepherd',
            'age' => '3 years',
            'gender' => 'Male',
            'size' => 'Large',
            'type' => 'dog',
            'image' => 'https://images.pexels.com/photos/1490908/pexels-photo-1490908.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Loyal and intelligent dog, great with children.',
            'vaccinated' => true,
            'spayed_neutered' => true
        ],
        [
            'id' => 4,
            'name' => 'Bella',
            'breed' => 'Labrador Mix',
            'age' => '4 years',
            'gender' => 'Female',
            'size' => 'Medium',
            'type' => 'dog',
            'image' => 'https://images.pexels.com/photos/1851164/pexels-photo-1851164.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Sweet and calm dog, perfect for families with children.',
            'vaccinated' => true,
            'spayed_neutered' => true
        ],
        [
            'id' => 5,
            'name' => 'Whiskers',
            'breed' => 'Maine Coon',
            'age' => '2 years',
            'gender' => 'Male',
            'size' => 'Large',
            'type' => 'cat',
            'image' => 'https://images.pexels.com/photos/1741205/pexels-photo-1741205.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Playful and social cat who loves attention.',
            'vaccinated' => true,
            'spayed_neutered' => false
        ],
        [
            'id' => 6,
            'name' => 'Charlie',
            'breed' => 'Beagle',
            'age' => '1 year',
            'gender' => 'Male',
            'size' => 'Medium',
            'type' => 'dog',
            'image' => 'https://images.pexels.com/photos/1254140/pexels-photo-1254140.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Curious and friendly puppy ready for adventures.',
            'vaccinated' => true,
            'spayed_neutered' => false
        ]
    ];
}

function getAllProducts() {
    return [
        [
            'id' => 1,
            'name' => 'Premium Dog Food',
            'category' => 'food',
            'price' => 45.99,
            'original_price' => 55.99,
            'discount' => 18,
            'rating' => 5,
            'reviews' => 124,
            'image' => 'https://images.pexels.com/photos/7210754/pexels-photo-7210754.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'High-quality nutrition for your beloved dog.'
        ],
        [
            'id' => 2,
            'name' => 'Interactive Cat Toy',
            'category' => 'toys',
            'price' => 19.99,
            'original_price' => 19.99,
            'discount' => 0,
            'rating' => 4,
            'reviews' => 89,
            'image' => 'https://images.pexels.com/photos/1404819/pexels-photo-1404819.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Keep your cat entertained for hours.'
        ],
        [
            'id' => 3,
            'name' => 'Comfortable Pet Bed',
            'category' => 'accessories',
            'price' => 79.99,
            'original_price' => 99.99,
            'discount' => 20,
            'rating' => 5,
            'reviews' => 156,
            'image' => 'https://images.pexels.com/photos/4498185/pexels-photo-4498185.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Luxurious comfort for your pet\'s rest.'
        ],
        [
            'id' => 4,
            'name' => 'Cat Litter Premium',
            'category' => 'health',
            'price' => 24.99,
            'original_price' => 24.99,
            'discount' => 0,
            'rating' => 4,
            'reviews' => 67,
            'image' => 'https://images.pexels.com/photos/6568461/pexels-photo-6568461.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Odor-controlling litter for a fresh home.'
        ],
        [
            'id' => 5,
            'name' => 'Dog Leash & Collar Set',
            'category' => 'accessories',
            'price' => 34.99,
            'original_price' => 39.99,
            'discount' => 13,
            'rating' => 5,
            'reviews' => 203,
            'image' => 'https://images.pexels.com/photos/7210758/pexels-photo-7210758.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Durable and stylish walking accessories.'
        ],
        [
            'id' => 6,
            'name' => 'Bird Cage Large',
            'category' => 'accessories',
            'price' => 149.99,
            'original_price' => 179.99,
            'discount' => 17,
            'rating' => 4,
            'reviews' => 45,
            'image' => 'https://images.pexels.com/photos/5731838/pexels-photo-5731838.jpeg?auto=compress&cs=tinysrgb&w=400',
            'description' => 'Spacious and secure home for your feathered friend.'
        ]
    ];
}

function getArticles() {
    return [
        [
            'id' => 1,
            'title' => 'Essential Tips for New Pet Owners',
            'excerpt' => 'Everything you need to know when bringing a new pet home.',
            'content' => 'Bringing a new pet home is an exciting experience, but it can also be overwhelming. Here are some essential tips to help you and your new companion adjust...',
            'author' => 'Dr. Sarah Johnson',
            'date' => '2024-01-15',
            'category' => 'Pet Care',
            'image' => 'https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=400',
            'read_time' => '5 min read'
        ],
        [
            'id' => 2,
            'title' => 'Healthy Diet Plans for Dogs',
            'excerpt' => 'Learn about proper nutrition to keep your dog healthy and happy.',
            'content' => 'A balanced diet is crucial for your dog\'s health and longevity. Understanding what nutrients your dog needs at different life stages...',
            'author' => 'Dr. Michael Chen',
            'date' => '2024-01-10',
            'category' => 'Nutrition',
            'image' => 'https://images.pexels.com/photos/1254140/pexels-photo-1254140.jpeg?auto=compress&cs=tinysrgb&w=400',
            'read_time' => '7 min read'
        ],
        [
            'id' => 3,
            'title' => 'Cat Behavior: Understanding Your Feline Friend',
            'excerpt' => 'Decode your cat\'s behavior and strengthen your bond.',
            'content' => 'Cats communicate in many ways, and understanding their behavior can help you provide better care and build a stronger relationship...',
            'author' => 'Dr. Emily Rodriguez',
            'date' => '2024-01-05',
            'category' => 'Behavior',
            'image' => 'https://images.pexels.com/photos/1170986/pexels-photo-1170986.jpeg?auto=compress&cs=tinysrgb&w=400',
            'read_time' => '6 min read'
        ]
    ];
}

function getPetById($id) {
    $pets = getAllPets();
    foreach ($pets as $pet) {
        if ($pet['id'] == $id) {
            return $pet;
        }
    }
    return null;
}

function getProductById($id) {
    $products = getAllProducts();
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}

function getArticleById($id) {
    $articles = getArticles();
    foreach ($articles as $article) {
        if ($article['id'] == $id) {
            return $article;
        }
    }
    return null;
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function sendEmail($to, $subject, $message) {
    // Simple email function (replace with proper email service in production)
    $headers = "From: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($to, $subject, $message, $headers);
}
?>