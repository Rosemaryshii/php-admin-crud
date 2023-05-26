<?php include 'includes/header.php';?>
<!-- End Sidebar-->

  <main id="main" class="main">

<div class="pagetitle">
  <h1>Recent Calculations</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Glasses</li>
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
                <th scope="col">Order</th>
                <th scope="col">Customer</th>
                <th scope="col">Invoice No</th>
                <th scope="col">Total Cost</th>
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
                  <button class="btn btn-primary edit-btn btn-sm"data-bs-toggle="modal" data-bs-target="#viewlogs">view</button> 
                  <!-- Edit button -->
                  <button class="btn btn-danger delete-btn btn-sm"data-bs-toggle="modal" data-bs-target="#del-Log">Delete</button> <!-- Delete button -->
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
                  <button class="btn btn-danger delete-btn btn-sm hidden">Delete</button>
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
            <!--VIEW  MODAL  -->
      <div class="modal fade" id="viewlogs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <h4 class="modal-title w-80 font-weight-bold">Edit Glass</h4>
                    <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                <form class="row g-3 needs-validation"novalidate>

                    <div class="modal-body mx-3">
                    <div class="col-md-12">
                    <input type="text" class="form-control validate" placeholder="Product Name" id="glass-name" required>
                    <label data-error="wrong" data-success="right" for="glass-name">Glass Name</label>
                    </div>
                
                    <div class="col-md-12">
                    <input type="text" class="form-control validate" placeholder="Customer Name" id="" required>
                    <label data-error="wrong" data-success="right" for="customer-name">Customer Name</label>
                    </div>
 
                   <div class="col-md-6">
                   <input type="text" class="form-control validate" placeholder="Invoice No" id="Invoice-No" required>
                   <label data-error="wrong" data-success="right" for="Invoice-No">Invoice No</label>
                   </div>

                    <div class="col-md-6">
                    <input type="text" class="form-control validate" placeholder="Total Cost" id="Total-Cost" required>
                    <label data-error="wrong" data-success="right" for="Total-Cost">Total Cost</label>
                    </div>

                    <div class="col-md-12">
                    <input type="text" class="form-control validate" placeholder="Dimensions" id="Dimension" required>
                    <label data-error="wrong" data-success="right" for="Dimension">Dimension</label> 
                    </div>


                <div class= "d-flex justify-content-center">
                    <button class="btn btn-info">Submit</button>
                  </div>

                </form>
             </div>

                </div>
              </div>
            </div>
            <!-- VIEW MODAL -->

            <!-- DELETE MODAL START-->
      <div id="del-Log" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto">
                          <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> This change will reflect in your portal after an hour.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button></div><div class="col-auto"><button type="button" class="btn btn-danger px-4" data-dismiss="modal">Delete</button></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- DELETE MODAL END -->

    </div>
  </div>
</section>



</main><!-- End #main -->

  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 
  
  include 'includes/footer.php' ;  
  
  ?>

