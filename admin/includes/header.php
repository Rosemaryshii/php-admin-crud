<?php
// Check if the sign-out button is clicked
if (isset($_POST['signout'])) {
  // Destroy the session and redirect to the sign-in page
  session_destroy();
  header("Location: login.php");
  exit;
}

// Include the session file
include 'sessions.php';

// Database connection
require_once 'db-conn.php';


// Fetch user information from the database based on the session data
if (isset($_SESSION['userN'])) {
  $userName = $_SESSION['userN'];

  $query = "SELECT job_title, name, about, phone_number, address, email FROM users WHERE userN = :userName";
  $statement = $db->prepare($query);
  $statement->bindParam(':userName', $userName);
  $statement->execute();

  // Check if the user exists
  if ($statement->rowCount() > 0) {
    $user = $statement->fetch();

    $jobTitle = $user['job_title'];
    $fullName = $user['name'];
    $user_about = $user['about'];
    $phone = $user['phone_number'];
    $user_location = $user['address'];
    $user_email = $user['email'];

    // Handle profile update form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['changePassword'])) {
        // Retrieve form data
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Validate current password
        $passwordQuery = "SELECT password FROM users WHERE userN = :userName";
        $passwordStatement = $db->prepare($passwordQuery);
        $passwordStatement->bindParam(':userName', $userName);
        $passwordStatement->execute();

        if ($passwordStatement->rowCount() > 0) {
          $userPassword = $passwordStatement->fetchColumn();

          if (password_verify($currentPassword, $userPassword)) {
            // Check if new password and confirm password match
            if ($newPassword === $confirmPassword) {
              // Update password in the database
              $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
              $updatePasswordQuery = "UPDATE users SET password = :password WHERE userN = :userName";
              $updatePasswordStatement = $db->prepare($updatePasswordQuery);
              $updatePasswordStatement->bindParam(':password', $hashedPassword);
              $updatePasswordStatement->bindParam(':userName', $userName);

              if ($updatePasswordStatement->execute()) {
                $successMsg = "Password updated successfully.";
              } else {
                $errorMsg = "An error occurred while updating the password.";
              }
            } else {
              $errorMsg = "New password and confirm password do not match.";
            }
          } else {
            $errorMsg = "Current password is incorrect.";
          }
        } else {
          $errorMsg = "User not found.";
        }
      } else {
        // Handle other form submissions (profile update, etc.)
        // ...
      }
    }
  }
  
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Admin Panel</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        

    
        <?php if (isset($username)) { ?>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fullName ?></h6>
              <span class="text-uppercase text-info fw-bold"><?php echo $jobTitle ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
            <form method="POST" action="logout.php">
              <button class="dropdown-item d-flex align-items-center" type="submit" name="signout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </form>
          </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        <?php } ?>
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">

      <!-- Glass Start here -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Glasses-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Glasses</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Glasses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="glass.php">
              <i class="bi bi-circle"></i><span>Add  Glass</span>
            </a>
          </li>
          <li>
            <a href="all_glass.php">
              <i class="bi bi-circle"></i><span>Glass List</span>
            </a>
          </li>

        </ul>
      </li>
      <!-- Products ends here -->

      <!--LOGS BEGIN HERE -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Calculation Logs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="calc-logs.php">
              <i class="bi bi-circle"></i><span>Logs</span>
            </a>
          </li>
        </ul>
      </li>

            <!--LOGS ENDSHERE -->
          <!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

 