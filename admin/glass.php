<?php
// include 'includes/sessions.php';
include 'includes/header.php';

// Check for error or success messages
if (isset($_GET['error'])) {
  $errorMessage = $_GET['error'];
}

if (isset($_GET['success'])) {
  $SuccesMessage = $_GET['success'];
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Product Form</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Glass</li>
        <li class="breadcrumb-item active">Add-Glass</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Add New Glass</h5>

      <!-- Error message section -->
      <?php if (isset($SuccesMessage)) : ?>
        <div class="alert alert-success" role="alert" id="success-message">
          <?php echo $SuccesMessage; ?></div>
      <?php endif; ?>

      <?php if (isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert" id="'error-message">
          <?php echo $errorMessage; ?></div>
      <?php endif; ?>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          var errorMessage = document.querySelector('.alert-danger');
          var successMessage = document.querySelector('.alert-success');

          if (errorMessage) {
            setTimeout(function() {
              errorMessage.style.display = 'none';
            }, 3000);
          }

          if (successMessage) {
            setTimeout(function() {
              successMessage.style.display = 'none';
            }, 5000);
          }
        });
      </script>



      <!-- End error message section -->

      <!-- Floating Labels Form -->
      <form class="row g-3" method="POST" action="insert-glass.php">
        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" class="form-control" name="GlassName" id="GlassName" placeholder="Glass name">
            <label for="GlassName">Glass Name</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="number" class="form-control" name="Price" id="Price" placeholder="Glass Price">
            <label for="Price">Glass Price</label>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End floating Labels Form -->
    </div>
  </div>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
include 'includes/footer.php';
?>