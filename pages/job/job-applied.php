<?php 
 session_start();
 if (!isset($_SESSION['sr'])) {
     header('location: ../../index.php');
   }
   else{
      include "../../dbcon.php";
      $sr5=$_SESSION['sr'];
      $sql5=mysqli_query($conn,"SELECT * from user WHERE sr=$sr5 ");
      $row5 = mysqli_fetch_assoc($sql5);
   ?>
<!DOCTYPE html>
<html lang="en">

<?php include '../section/header.php';  ?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include '../section/topbar.php';  ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <?php include '../section/setting.php';  ?>

      <!-- navbar -->
      <?php include '../section/navbar.php';  ?>
      <!-- navbar -->

      <div class="main-panel" style="border-radius: 0.7rem; box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
        <?php
        if($row5['crmadmin']=='yes'){
        ?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Job applied Candidates</h4>


                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Sr. No</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Qualification</th>
                          <th>Post</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          include "../../dbcon.php";
                          $table= "SELECT * FROM  job ORDER BY sr DESC";
                          $result =mysqli_query($conn,$table);
                            while ($row= mysqli_fetch_array($result)) { 
                              ?>
                        <tr>
                          <td><?php echo $i; 
                              $i=$i+1; ?></td>
                              <td><?php 
                              $datedef=$row['date'];
                              $dat=explode("-",$datedef);
                              $dater=$dat['2'].'-'.$dat['1'].'-'.$dat['0'];
                              echo $dater   ?></td>
                              <td><?php echo $row['time'];   ?></td>
                              <td><p class="h5"><?php echo $row['name'];   ?></p></td>
                              <td><?php echo $row['phone'];   ?></td>
                              <td><?php echo $row['address'];   ?></td>
                              <td><?php echo $row['qualification'];   ?></td>
                              <td><?php echo $row['post'];   ?></td>
                              <form method="post">
                                <td><button type="submit" name="delete" value="<?php echo $row['sr'] ?>" class="badge badge-dark" href="?action=delete" onclick="return confirm('Are you sure you want to delete?')"><i class="ti-trash"></i>&nbsp;Delete</button>
                              </td>
                                
                                </form>
                            
                         
                        </tr>
                        <?php
                                }



                                   //slider Deletion
                                   if (isset($_POST['delete'])) {
                                    $sr=$_POST['delete'];
                                    echo $sr;

                                        $update = mysqli_query($conn,"DELETE FROM job WHERE sr=$sr");
                                        if($update){
                                            //echo "successful discarded";
                                            ?><meta http-equiv="refresh" content="0" /><?php
                                        }
                                    
                                    
                                    else{
                                        echo"discardation Failed";
                                    }
                                }
                                   
                                ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php
        }
        else{ ?>
          <div class="content-wrapper d-flex align-items-center text-center error-page">
          <div class="row flex-grow">
            <div class="col-lg-7 mx-auto text-blue">
              <div class="row align-items-center d-flex flex-row">
                <div class="col-lg-6 text-lg-right pr-lg-4">
                <img style="height: auto; width: auto; border-radius: 0%;"
                                src='../section/img/access.gif' />
                  <!-- <h1 class="display-1 mb-0">404</h1> -->
                </div>
                <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                
                  
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-12 text-center mt-xl-2">
                <h2>SORRY!</h2>
                  <h3 class="font-weight-light">You have not permission to access this page.</h3>
                  <a class="text-primary font-weight-medium" href="../../pages/dashbaord/index">Back to home</a>
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- content-wrapper ends -->

        <!-- partial:../../partials/_footer.html -->
        <?php  }
         include '../section/footer.php';  ?>
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
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
<?php
   }
?>