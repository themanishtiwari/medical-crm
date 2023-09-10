<?php 
 session_start();
 if (!isset($_SESSION['sr'])) {
     header('location: ../../index.php');
   }
   else{
    include "../../dbcon.php";


    $sr=$_SESSION['sr'];

      $sql=mysqli_query($conn,"SELECT * from user WHERE sr=$sr ");
      $row = mysqli_fetch_assoc($sql);


    


      date_default_timezone_set('Asia/Kolkata');
      //setting login time
      if (!isset($_SESSION['time'])) {
      $time= date('g:i a');
      $_SESSION['time']=$time;
      }


      //date range for filter
      $date= date('d.M.Y');
      $month1= date('Y-m-d');
      $dt = strtotime($month1);
      $month2= date("Y-m-d", strtotime("-1 month", $dt));
      
      $datee1= "WHERE date >= '$month2' && date <= '$month1'";
      $datee2= "WHERE date >= '$month2' && date <= '$month1' && category='Converted' ";
      $datee3= "WHERE date >= '$month2' && date <= '$month1'  ";
      $sub_sql= "WHERE category='Converted'";
      
$numpatient =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  patients $datee1"));
$numconvert =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM  patients $datee2"));


//total business in selected date

    $sql1 = "SELECT amount FROM  patients $datee1";
    $result = $conn->query($sql1);
    $total_business=0;
    while($col = mysqli_fetch_array($result)){
        if($col['amount']){
          $total_business += $col['amount'];
        }
    }

    // end of total business code


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
                  <h3 class="font-weight-bold">Welcome <?php echo $row['name'];  ?></h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly... You logged in at  <?php echo $_SESSION['time'];?></span></h6>
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
                      <p>in last 30 days</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Conversion</p>
                      <p class="fs-30 mb-2 font-weight-bold"><?php echo $numconvert;?></p>
                      <p>in last 30 days</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Conversion Amount</p>
                      <p class="fs-30 mb-2 font-weight-bold">&#8377; <?php echo $total_business;?></p>
                      <p>in last 30 days</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body ">
                      <p class="mb-4">Persentage Of Conversion</p>
                      <p class="fs-30 mb-2 font-weight-bold"><?php
                      if($numpatient==0){
                        echo "0";
                      }
                      else{
                       echo number_format((($numconvert/$numpatient)*100),2); } ?> %</p>
                      <p>in last 30 days</p>
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
                      $table= "SELECT * FROM  patients ORDER BY sr DESC Limit 0,7";
                      $result1 =mysqli_query($conn,$table);
                      while ($row1= mysqli_fetch_array($result1)) { ?>
                        <tr>
                          <td><?php echo $row1['name'] ?></td>
                          <td class="font-weight-bold"><?php echo $row1['disease'] ?></td>
                          <td><?php echo $row1['date']; ?></td>
                          <?php $cat=$row1['category'];
                                if($cat=="Hot"){
                                 $style="badge badge-danger";
                               }
                                elseif($cat=="Warm"){
                                  $style="badge badge-success";
                                }
                                elseif($cat=="Cold"){
                                  $style="badge badge-warning";
                                }
                                elseif($cat=="Converted"){
                                  $style="badge badge-dark";
                                }
                                else{
                                  $style="badge badge-light";
                                }      
                            ?>
                          <td class="font-weight-medium"><div class="<?php echo $style ?>"><?php echo $row1['category'] ?></div></td>
                        </tr>
                        <?php  }   ?>
                        
                      </tbody>
                    </table>
                  </div>
                  </div>


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
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/chart.js/Chart.min.js"></script>
  <script src="../../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="../../js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/dashboard.js"></script>
  <script src="../../js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

<?php }  ?>

