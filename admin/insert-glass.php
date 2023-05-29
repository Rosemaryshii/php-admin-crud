<?php
  // Database connection
  require_once '../config.php';
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


  // Check if the glass name already exists in the database
  $checkQuery = "SELECT COUNT(*) FROM products WHERE name = '$glassName'";
  $checkResult = mysqli_query($conn, $checkQuery);
  $count = mysqli_fetch_array($checkResult)[0];

  if ($count > 0) {
    // Glass name already exists, redirect back to the form with an error message
    $errorMessage = "Glass name already exists. Please choose a different name.";
    header("Location: glass.php?error=" . urlencode($errorMessage));
    exit();
  }

  // Insert glass data into the database
  $insertQuery = "INSERT INTO products (name, price) VALUES ('$glassName', '$price')";

  if (mysqli_query($conn, $insertQuery)) {
    // Glass added successfully, redirect back to the form with a success message
    $SuccesMessage = "Glass added successfully.";
    header("Location: glass.php?success=" . urlencode($SuccesMessage));
    mysqli_close($conn);
    exit();
  } else {
    // Error occurred while adding glass, redirect back to the form with an error message
    $errorMessage = "Error adding glass. Please try again.";
    header("Location: glass.php?error=" . urlencode($errorMessage));
    mysqli_close($conn);
    exit();
  }
} else {
  // Redirect to the form page if accessed directly without form submission
  header("Location: glass.php");
  exit();
}
