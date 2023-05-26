<?php
// sessions.php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userN'])) {
  // Redirect the user to the login page
  header("Location: ../login.php");
  exit();
}

$username = $_SESSION['userN'];
?>
