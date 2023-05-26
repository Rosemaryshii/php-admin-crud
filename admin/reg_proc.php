<?php
// reg_proc.php


  // Database connection
  require_once 'includes/db-conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission

  // Get the form input values
  $name = $_POST['name'];
  $email = $_POST['email'];
  $userN = $_POST['userN'];
  $password = $_POST['password'];



  // Check if the email or username already exists
  $checkQuery = "SELECT * FROM users WHERE email = :email OR userN = :userN";
  $checkStatement = $db->prepare($checkQuery);
  $checkStatement->bindParam(':email', $email);
  $checkStatement->bindParam(':userN', $userN);
  $checkStatement->execute();

  if ($checkStatement->rowCount() > 0) {
    // Duplicate email or username found
    $errorMessage = "Email or username already exists. Please choose a different email or username.";
    header("Location: register.php?error=" . urlencode($errorMessage));
    exit();
  } else {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insertQuery = "INSERT INTO users (name, email, userN, password) VALUES (:name, :email, :userN, :password)";
    $insertStatement = $db->prepare($insertQuery);
    $insertStatement->bindParam(':name', $name);
    $insertStatement->bindParam(':email', $email);
    $insertStatement->bindParam(':userN', $userN);
    $insertStatement->bindParam(':password', $hashedPassword);

    if ($insertStatement->execute()) {
      // Registration successful
      echo "<p>Registration successful!</p>";
      header("Location: login.php");
      exit(); // Make sure to exit after the redirect
    } else {
      // Registration failed
      $errorMessage = "Registration failed. Please try again.";
      header("Location: register.php?error=" . urlencode($errorMessage));
      exit();
    }
  }
}
?>
