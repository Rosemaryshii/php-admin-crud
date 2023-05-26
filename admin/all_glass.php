<?php
include 'includes/header.php';
require_once 'includes/db-conn.php';

// Fetch all glasses from the database
$selectQuery = "SELECT * FROM glass";
$statement = $db->prepare($selectQuery);
$statement->execute();
$glasses = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<main id="main" class="main">

  <div class="pagetitle">
    <h1>All Glasses Available</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <!-- Table with stripped rows -->
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Glass Name</th>
                  <th scope="col">Glass Price</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($glasses as $index => $glass): ?>
                  <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo $glass['GlassName']; ?></td>
                    <td><?php echo $glass['price']; ?></td>
                    <td>
                      <button class="btn btn-primary edit-btn btn-sm" data-bs-toggle="modal" data-bs-target="#editglass" data-glass-id="<?php echo $glass['id']; ?>">Edit</button>
                      <button class="btn btn-danger delete-btn btn-sm hidden" data-bs-toggle="modal" data-bs-target="#deleteModal" data-glass-id="<?php echo $glass['id']; ?>">Delete</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->


            <!-- EDIT MODAL -->
            <div class="modal fade" id="editglass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <h4 class="modal-title w-80 font-weight-bold">Edit Glass</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form id="edit-form" method="POST" action="update-glass.php">
                    <div class="modal-body">
                      <input type="hidden" name="edit-glass-id" id="edit-glass-id" value="">
                      <label for="edit-glass-name">Glass Name</label>
                      <input type="text" name="edit-glass-name" id="edit-glass-name" class="form-control" required>

                      <label for="edit-glass-price">Glass Price</label>
                      <input type="text" name="edit-glass-price" id="edit-glass-price" class="form-control" required>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                      <button type="submit" class="btn btn-info" name="update-glass">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- EDIT MODAL -->

            <!-- Delete Modal Start-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this item?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="delete-glass.php" method="POST">
                      <input type="hidden" name="glass_id" id="delete-glass-id" value="">
                      <button type="submit" class="btn btn-danger delete-btn btn-sm">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Delete Modal End -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->


<!-- ======= Footer ======= -->
<?php include 'includes/footer.php'; ?>
<script>
  $(document).ready(function() {
    // Edit button click event
    $('.edit-btn').click(function() {
      var glassId = $(this).data('glass-id');
      var glassName = $(this).closest('tr').find('td:nth-child(2)').text();
      var glassPrice = $(this).closest('tr').find('td:nth-child(3)').text();

      $('#edit-glass-id').val(glassId);
      $('#edit-glass-name').val(glassName);
      $('#edit-glass-price').val(glassPrice);
    });
  });
</script>