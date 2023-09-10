<?php
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'section/header.php';  ?>
<title>Login Page</title>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <!-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div> -->
              </form>
              <?php
                    session_start();
                  include'dbcon.php';

                  if (isset($_POST["submit"])) {

                    $email=$_POST["email"];
                    $pass=$_POST["password"];
                    $password="@f$5/k".$pass."4?7p3#f2";

                    if (!preg_match("/=/",$pass)) {

                      $sql=mysqli_query($conn,"SELECT * from user WHERE email='$email'");

                  $rw=mysqli_num_rows($sql);


                  if($rw)
                  {    
                        $row = mysqli_fetch_assoc($sql);
                        $dbpass= $row["password"];

                        if (password_verify($password, $dbpass)) {
                          if($row["login"]=="yes"){
                          
                          $_SESSION['sr']=$row["sr"];
                          header('location: pages/dashbaord/index');
                          echo'<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                                <i class="ti-check-box"></i>
                                <strong class="mx-2">Success!</strong>Loged In Successfully
                            </div>';
                          }
                          else{
                            echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                                <i class="ti-alert"></i>
                                <strong class="mx-2">You do not have access to login</strong>
                                </div>';                
                      }

                        }
                        else{
                        echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                            <i class="ti-alert"></i>
                            <strong class="mx-2">Error!</strong> Incorrect Password
                        
                            </div>';
                                            
                  }
                }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                    <i class="ti-alert"></i>
                    <strong class="mx-2">Error!</strong> Incorrect Username
                
                    </div>';
                  }
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                  <i class="ti-alert"></i>
                  <strong class="mx-2">Error!</strong> "=" Not Allowed in Password
              
                  </div>';
                }
              }

              ob_end_flush();
                  
                  ?>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
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
</body>

</html>
