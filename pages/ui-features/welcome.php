<?php 
include "../../dbcon.php";

      date_default_timezone_set('Asia/Kolkata');
      $date= date('d.M.Y');
      $time= date('g:i a');
      $month1= date('Y-m-d');
      $dt = strtotime($month1);
      $month2= date("Y-m-d", strtotime("-3 month", $dt));
      
      $datee1= "WHERE date >= '$month2' && date <= '$month1'";
      $sub_sql= "WHERE category='Hot'";
      
$numpatient =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  patients $datee1"));
$numcamp =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  camp $datee1"));
$numsocial =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  social $datee1"));
$numdoctor =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  doctor $datee1"));

$numconverted =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  patients $sub_sql"));
$totalpatient =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  patients"));


?>
<!DOCTYPE html>
<html lang="en">

<?php include '../section/header.php';  ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include '../section/topbar.php';  ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <?php include '../section/setting.php';  ?>
      <!-- side- navbar -->
      <?php include '../section/navbar.php';  ?>
      <!-- end side- navbar -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome Aamir</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! Now time is <?php echo $time?></span></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <!-- <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div> -->
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Registration</p>
                      <p class="fs-30 mb-2 font-weight-bold"><?php echo $numpatient;?></p>
                      <p>in last 90 days</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Camp Bookings</p>
                      <p class="fs-30 mb-2 font-weight-bold"><?php echo $numcamp;?></p>
                      <p>in last 90 days</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Social Media Lead</p>
                      <p class="fs-30 mb-2 font-weight-bold"><?php echo $numsocial;?></p>
                      <p>in last 90 days</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body ">
                      <p class="mb-4">Total Doctor Registration</p>
                      <p class="fs-30 mb-2 font-weight-bold"><?php echo $numdoctor;?></p>
                      <p>in last 90 days</p>
                    </div>
                  </div>
                </div>
              </div>
            
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Organic Lead Details</p>
                  <p class="font-weight-500">The total number of registered patient with the number of conversion. this data is the only form website, persentage of conversion also given below. </p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Total Leads</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $totalpatient; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">total conversion</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $numconverted; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Conversion Persentage</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo number_format((($numconverted/$totalpatient)*100),2); ?>%</h3>
                    </div>
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">New Registration</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Problem</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <?php
                      $table= "SELECT * FROM  patients ORDER BY sr DESC Limit 1,8";
                      $result =mysqli_query($conn,$table);
                      while ($row= mysqli_fetch_array($result)) { ?>
                        <tr>
                          <td><?php echo $row['name'] ?></td>
                          <td class="font-weight-bold"><?php echo $row['disease'] ?></td>
                          <td><?php echo $row['date']; ?></td>
                          <?php $cat=$row['category'];
                                if($cat=="Hot"){
                                 $style="badge badge-danger";
                               }
                                elseif($cat=="Warm"){
                                  $style="badge badge-success";
                                }
                                elseif($cat=="Cold"){
                                  $style="badge badge-warning";
                                }
                                else{
                                  $style="badge badge-light";
                                }      
                            ?>
                          <td class="font-weight-medium"><div class="<?php echo $style ?>"><?php echo $row['category'] ?></div></td>
                        </tr>
                        <?php  }   ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include '../section/footer.php';  ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

