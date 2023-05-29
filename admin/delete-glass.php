<?php

require_once '../config.php';

// Check if the request is a POST request and the 'glass_id' parameter is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['glass_id'])) {
  // Retrieve the glass ID from the request
  $glassId = $_POST['glass_id'];

  // Perform the necessary actions to delete the glass from the database
  // Replace the following code with your actual database query or ORM logic
  $deleteQuery = "DELETE FROM products WHERE id = '$glassId'";

  if (mysqli_query($conn, $deleteQuery)) {
    // The glass was successfully deleted
    $successMessage = "Glass deleted successfully";
    header("Location: glass.php?success=" . urlencode($successMessage));
    exit();
  } else {
    // There was an error deleting the glass
    $errorMessage = "Error deleting glass";
    header("Location: glass.php?error=" . urlencode($errorMessage));
    exit();
  }
} else {
  // Invalid request method or 'glass_id' parameter not set
  $errorMessage = "Invalid request";
  header("Location: glass.php?error=" . urlencode($errorMessage));
  exit();
}
?>
