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
        if($row5['superadmin']=='yes'){
        ?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card pb-3">
                <div class="card-body">
                <h4>Add New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>

                
              <form class="pt-3"  method="POST" >
                <div class="form-group">
                  <input type="text" name="name" class="form-control form-control-lg" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <select name="profile" class="form-control form-control-lg" id="exampleFormControlSelect2" required>
                    <option selected disabled>Profile</option>
                    <option value="caller">Caller</option>
                    <option value="it excutive">IT Excutive</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" >
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit">Register</button>
                </div>
                <!-- <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
                </div> -->
              </form>
              <?php
            include'../../dbcon.php';
            if (isset($_POST["submit"])) {

           $name=$_POST["name"];
           $email=$_POST["email"];
           $pass=$_POST["password"];
           $profile=$_POST["profile"];
           $newpassword="@f$5/k".$pass."4?7p3#f2";
           $password= password_hash($newpassword, PASSWORD_DEFAULT);
           date_default_timezone_set('Asia/Kolkata');
           $date= date('Y-m-d');
           $time= date('g:i a');

           if (!preg_match("/[`!#$%^*()_\=\[\]{};':\\|<>\/?~]/",$email)&& !preg_match("/=/",$pass)&& preg_match("/^[A-Za-z ]+$/",$name)) {


            $test=mysqli_query($conn,"SELECT * from user WHERE email='$email'");

                  $rw=mysqli_num_rows($test);
                  if($rw){ 
                    echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                    <i class="ti-alert"></i>
                    <strong class="mx-2">Error!</strong> Email Already Exist...
                
                    </div>';
                  }
                  else{

               

                            $insert="INSERT INTO `user`(`sr`,`date`, `time`, `name`, `profile`, `email`, `password`) VALUES ('','$date','$time','$name' ,'$profile','$email','$password')";

                          $sql=mysqli_query($conn,$insert);
                              if($sql){
                                echo'<br><br><div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                                <i class="ti-check-box"></i>
                                <strong class="mx-2">Success!</strong>Submitted Successfully.
                            </div>';

                          //header("refresh:2; url=form.php");
                    }
                    else{
                          echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                          <i class="ti-alert"></i>
                          <strong class="mx-2">Error!</strong> Registration Failed
                      
                          </div>';
                          //header("refresh:1;url=form.php");
                    }

                    }
}

   else{
    echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
    <i class="ti-alert"></i>
    <strong class="mx-2">Error!</strong> Invailed Input Form Not Submitted

    </div>';
    //header("refresh:3;url=form.php");
   


            }
          }

?>


                      
                  </div>
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

  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
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




