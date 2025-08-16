<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to home page with success message
header('Location: index.php?message=' . urlencode('You have been successfully logged out.'));
exit;
?>