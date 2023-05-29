<?php 
    //  session_start();

    include 'includes/header.php'; // Include the header.php file
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Transactios<span> |...</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>124</h6>
                      <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- End Customers Card -->

           <!-- Glass Card -->
  <div class="col-xxl-4 col-xl-6">

<div class="card info-card customers-card">

  <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <li class="dropdown-header text-start">
        <h6>Filter</h6>
      </li>

      <li><a class="dropdown-item" href="#">Today</a></li>
      <li><a class="dropdown-item" href="#">This Month</a></li>
      <li><a class="dropdown-item" href="#">This Year</a></li>
    </ul>
  </div>

  <div class="card-body">
  <h5 class="card-title">Glass Types<span>.</span></h5>

  <?php
  // Get the previous count of glasses
  $previousCountQuery = "SELECT COUNT(*) as previous_count FROM glass";
  $previousCountResult = $db->query($previousCountQuery);
  $previousCount = $previousCountResult->fetchColumn();

  // Get the current count of glasses
  $currentCountQuery = "SELECT COUNT(*) as current_count FROM glass";
  $currentCountResult = $db->query($currentCountQuery);
  $currentCount = $currentCountResult->fetchColumn();

  // Calculate the percentage increase
  $percentageIncrease = ($currentCount - $previousCount) / $previousCount * 100;

  ?>

  <div class="d-flex align-items-center">
    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-primary">
      <i class="bi bi-aspect-ratio"></i>
    </div>
    <div class="ps-3">
      <h6><?php echo $currentCount; ?></h6>
      <span class="text-primary small pt-1 fw-bold"><?php echo round($percentageIncrease, 2); ?>%</span>
      <span class="text-muted small pt-2 ps-1"><?php echo ($percentageIncrease >= 0) ? 'more' : 'less'; ?></span>
    </div>
  </div>
</div>

</div>

</div>
<!-- End Glass Card -->



              </div>
          </div> 
          <!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->




  <?php   require_once './includes/footer.php';
 ?>
