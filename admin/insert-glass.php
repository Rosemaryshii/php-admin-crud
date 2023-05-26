<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate form inputs
  $glassName = $_POST['GlassName'];
  $price = $_POST['Price'];

  if (empty($glassName) || empty($price)) {
    // Required fields not filled, redirect back to the form with an error message
    $errorMessage = "Please fill in all the fields.";
    header("Location: glass.php?error=" . urlencode($errorMessage));
    exit();
  }

  // Database connection
  require_once 'includes/db-conn.php';

  // Check if the glass name already exists in the database
  $checkQuery = "SELECT COUNT(*) FROM glass WHERE GlassName = :GlassName";
  $checkStatement = $db->prepare($checkQuery);
  $checkStatement->bindParam(':GlassName', $glassName);
  $checkStatement->execute();
  $count = $checkStatement->fetchColumn();

  if ($count > 0) {
    // Glass name already exists, redirect back to the form with an error message
    $errorMessage = "Glass name already exists. Please choose a different name.";
    header("Location: glass.php?error=" . urlencode($errorMessage));
    exit();
  }

  // Insert glass data into the database
  $insertQuery = "INSERT INTO glass (GlassName, price) VALUES (:GlassName, :price)";
  $insertStatement = $db->prepare($insertQuery);
  $insertStatement->bindParam(':GlassName', $glassName);
  $insertStatement->bindParam(':price', $price);

  if ($insertStatement->execute()) {
    // Glass added successfully, redirect back to the form with a success message
    $SuccesMessage = "Glass added successfully.";
    header("Location: glass.php?success=" . urlencode($SuccesMessage));
    exit();
  } else {
    // Error occurred while adding glass, redirect back to the form with an error message
    $errorMessage = "Error adding glass. Please try again.";
    header("Location: glass.php?error=" . urlencode($errorMessage));
    exit();
  }
} else {
  // Redirect to the form page if accessed directly without form submission
  header("Location: glass.php");
  exit();
}

?>