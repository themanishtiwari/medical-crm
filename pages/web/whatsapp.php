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
        if($row5['web']=='yes'){
        ?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Whatsapp Message</h4>
                  <div class="row mb-4">
                    <div class="col-12">
                    <form method="POST">
                    <label for="form_message">Ganerate whatsapp meessage from the <a href="https://www.wati.io/free-whatsapp-link-generator/" target="_blank">link</a>, than Update here </label>
                    </div>
                    <div class="col-6 form-group">
                        
                        <textarea id="form_message" name="message" class="form-control required" rows="5"
                          required></textarea>
                      </div>
                      <div class="col-6 form-group">

                        <button type="submit" name="submit" class="btn btn-primary btn-icon-text">
                          Submit
                        </button>
                      </div>
                  
                  </form>

                        
              </div>

              <h4 class="">Current Whatsapp Message: </h4>

              <p><?php 
                      include "../../dbcon.php";
                      $query = mysqli_query($conn,"SELECT * FROM  whatsapp WHERE sr=1");
                      $row= mysqli_fetch_array($query);
                      $message1= $row['message'];
                      ?><?php 
                      include "../../dbcon.php";
                      $query = mysqli_query($conn,"SELECT * FROM  whatsapp WHERE sr=1");
                      $row= mysqli_fetch_array($query);
                      echo $row['message'];
                      ?></p>

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


<?php 


if (isset($_POST["submit"])) {
                              
  $message=$_POST["message"];

  $update=mysqli_query($conn,"UPDATE whatsapp SET `message`='$message' WHERE sr=1 ");
  if($update){
    echo '<meta http-equiv="refresh" content="0" />';
  }
}


?>



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