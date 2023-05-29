<?php
require_once '../config.php';

if (isset($_POST['update-glass'])) {
  $glassId = $_POST['edit-glass-id'];
  $glassName = $_POST['edit-glass-name'];
  $glassPrice = $_POST['edit-glass-price'];

  // Update the glass in the database
  $updateQuery = "UPDATE products SET name = '$glassName', price = '$glassPrice' WHERE id = '$glassId'";

  if (mysqli_query($conn, $updateQuery)) {
    echo "Record updated successfully";
    // Redirect back to the page where the form is displayed
    header("Location: all_glass.php");
    exit();
  } else {
    // Error occurred while updating glass, handle the error
    $errorMessage = "Error updating glass. Please try again.";
    header("Location: all_glass.php?error=" . urlencode($errorMessage));
    exit();
  }
}
?>
