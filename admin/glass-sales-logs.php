<?php include 'includes/header.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
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
                    <th scope="col">Glass-Name</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Invoice-Num</th>
                    <th scope="col">Dimensions</th>
                    <th scope="col">Action</th> <!-- New header for actions -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                    <td>
                      <button class="btn btn-primary edit-btn btn-sm">view</button> <!-- Edit button -->
                      <button class="btn btn-danger delete-btn btn-sm">Delete</button> <!-- Delete button -->
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                    <td>
                      <button class="btn btn-primary edit-btn btn-sm">view</button>
                      <button class="btn btn-danger delete-btn btn-sm">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                    <td>
                      <button class="btn btn-primary edit-btn btn-sm">view</button>
                      <button class="btn btn-danger delete-btn btn-sm">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                    <td>
                      <button class="btn btn-primary edit-btn btn-sm">view</button>
                      <button class="btn btn-danger delete-btn btn-sm">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division </td>
                    <td>47</td>
                    <td>2011-04-19</td>
                    <td>
                      <button class="btn btn-primary edit-btn btn-sm">view</button>
                      <button class="btn btn-danger delete-btn btn-sm">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
    
    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'includes/footer.php';?>