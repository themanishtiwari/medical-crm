<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'section/header.php';  ?>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'section/topbar.php';  ?>
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <?php include 'section/setting.php';  ?>
      
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'section/navbar.php';  ?>
            


<?php 
      include "../../dbcon.php";


    if (isset($_POST["submit"])) {
	       $sr=$_POST["submit"];
         $address=$_POST["address"];
        $category=$_POST["category"];
        $other=$_POST["other"];
          date_default_timezone_set('Asia/Kolkata');
          $time= date('d-m-y g:i a');
          $remark1=$_POST["remark1"]." on ".$time;

          $query = "SELECT * FROM patients where sr=$sr";
          $show = mysqli_query($conn,$query);
          $row= mysqli_fetch_array($show);
          ?>
          <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Details</h4>
                  <!-- <p class="card-description">
                    Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row
                  </p> -->
                  <div class="row">
                    <div class="col-3"><h4><i class="icon-head"></i>&nbsp;&nbsp;<?php echo $row['name'] ?></h5></div>
                    <div class="col-3"><h5><i class="ti-headphone-alt"></i>&nbsp;&nbsp;<?php echo $row['phone'] ?></h5></div>
                    <div class="col-3"><h5><i class="ti-wheelchair"></i>&nbsp;&nbsp;<?php echo $row['disease'] ?></h5></div>
                    <div class="col-3"><h5><i class="ti-comment"></i>&nbsp;&nbsp;<?php echo $row['message'] ?></h5></div>
                  </div>

                  
                </div>
              </div>
            </div>
            <div class="col-4 grid-margin stretch-card"></div>
            <div class="col-4 grid-margin stretch-card">

            <?php 
           
            $update=mysqli_query($conn,"UPDATE patients SET address='$address',  category='$category', other='$other', remark1='$remark1' WHERE sr=$sr ");

        
         if ($update) {
           echo '
           <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
               <i class="ti-check-box"></i>
               <strong class="mx-2">Success!</strong> Your message has been submitted successfully.
           </div>';
          header("refresh:1;url=details.php");
          }
          else{
                echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                <i class="ti-alert"></i>
                <strong class="mx-2">Error!</strong> A problem has been occurred while submitting your data.
            
                </div>';
                header("refresh:1;url=edit.php");
          }
        }
  elseif(isset($_POST["submit2"])) {
    $sr=$_POST["submit2"];
    $address=$_POST["address"];
   $category=$_POST["category"];
   $other=$_POST["other"];
     date_default_timezone_set('Asia/Kolkata');
     $time= date('d-m-y g:i a');
     $remark2=$_POST["remark2"]." on ".$time;


     $query = "SELECT * FROM patients where sr=$sr";
     $show = mysqli_query($conn,$query);
     $row= mysqli_fetch_array($show);
     ?>
     <!-- partial -->
 <div class="main-panel">        
   <div class="content-wrapper">
     <div class="row">
       <div class="col-12 grid-margin stretch-card">
         <div class="card">
           <div class="card-body">
             <h4 class="card-title">Details</h4>
             <!-- <p class="card-description">
               Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row
             </p> -->
             <div class="row">
               <div class="col-3"><h4><i class="icon-head"></i>&nbsp;&nbsp;<?php echo $row['name'] ?></h5></div>
               <div class="col-3"><h5><i class="ti-headphone-alt"></i>&nbsp;&nbsp;<?php echo $row['phone'] ?></h5></div>
               <div class="col-3"><h5><i class="ti-wheelchair"></i>&nbsp;&nbsp;<?php echo $row['disease'] ?></h5></div>
               <div class="col-3"><h5><i class="ti-comment"></i>&nbsp;&nbsp;<?php echo $row['message'] ?></h5></div>
             </div>
             
           </div>
         </div>
       </div>
       <div class="col-4 grid-margin stretch-card"></div>
       <div class="col-4 grid-margin stretch-card">

       <?php 
      
$update=mysqli_query($conn,"UPDATE patients SET address='$address', category='$category', other='$other', remark2='$remark2' WHERE sr=$sr ");

   
if ($update) {
  echo '
  <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
      <i class="ti-check-box"></i>
      <strong class="mx-2">Success!</strong> Your message has been submitted successfully.
  </div>';
 header("refresh:1;url=details.php");
 }
 else{
       echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
       <i class="ti-alert"></i>
       <strong class="mx-2">Error!</strong> A problem has been occurred while submitting your data.
   
       </div>';
       header("refresh:1;url=edit.php");
 }
}

   elseif(isset($_POST["submit3"])) {
      $sr=$_POST["submit3"];
      $address=$_POST["address"];
     $category=$_POST["category"];
     $other=$_POST["other"];
       date_default_timezone_set('Asia/Kolkata');
       $time= date('d-m-y g:i a');
       $remark3=$_POST["remark3"]." on ".$time;
       

       $query = "SELECT * FROM patients where sr=$sr";
       $show = mysqli_query($conn,$query);
       $row= mysqli_fetch_array($show);
       ?>
       <!-- partial -->
   <div class="main-panel">        
     <div class="content-wrapper">
       <div class="row">
         <div class="col-12 grid-margin stretch-card">
           <div class="card">
             <div class="card-body">
               <h4 class="card-title">Details</h4>
               <!-- <p class="card-description">
                 Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row
               </p> -->
               <div class="row">
                 <div class="col-3"><h4><i class="icon-head"></i>&nbsp;&nbsp;<?php echo $row['name'] ?></h5></div>
                 <div class="col-3"><h5><i class="ti-headphone-alt"></i>&nbsp;&nbsp;<?php echo $row['phone'] ?></h5></div>
                 <div class="col-3"><h5><i class="ti-wheelchair"></i>&nbsp;&nbsp;<?php echo $row['disease'] ?></h5></div>
                 <div class="col-3"><h5><i class="ti-comment"></i>&nbsp;&nbsp;<?php echo $row['message'] ?></h5></div>
               </div>
               
             </div>
           </div>
         </div>
         <div class="col-4 grid-margin stretch-card"></div>
         <div class="col-4 grid-margin stretch-card">

         <?php        

  $update=mysqli_query($conn,"UPDATE patients SET address='$address', category='$category', other='$other', remark3='$remark3' WHERE sr=$sr ");
  
     
  if ($update) {
    echo '
    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="ti-check-box"></i>
        <strong class="mx-2">Success!</strong> Your message has been submitted successfully.
    </div>';
   header("refresh:1;url=details.php");
   }
   else{
         echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
         <i class="ti-alert"></i>
         <strong class="mx-2">Error!</strong> A problem has been occurred while submitting your data.
     
         </div>';
         header("refresh:1;url=edit.php");
   }
  }

   else{
      $sr=$_POST["submit4"];
      $address=$_POST["address"];
     $category=$_POST["category"];
     $other=$_POST["other"];
       date_default_timezone_set('Asia/Kolkata');
       $time= date('d-m-y g:i a');
       $remark4=$_POST["remark4"]." on ".$time;

       $query = "SELECT * FROM patients where sr=$sr";
       $show = mysqli_query($conn,$query);
       $row= mysqli_fetch_array($show);
       ?>
       <!-- partial -->
   <div class="main-panel">        
     <div class="content-wrapper">
       <div class="row">
         <div class="col-12 grid-margin stretch-card">
           <div class="card">
             <div class="card-body">
               <h4 class="card-title">Details</h4>
               <!-- <p class="card-description">
                 Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row
               </p> -->
               <div class="row">
                 <div class="col-3"><h4><i class="icon-head"></i>&nbsp;&nbsp;<?php echo $row['name'] ?></h5></div>
                 <div class="col-3"><h5><i class="ti-headphone-alt"></i>&nbsp;&nbsp;<?php echo $row['phone'] ?></h5></div>
                 <div class="col-3"><h5><i class="ti-wheelchair"></i>&nbsp;&nbsp;<?php echo $row['disease'] ?></h5></div>
                 <div class="col-3"><h5><i class="ti-comment"></i>&nbsp;&nbsp;<?php echo $row['message'] ?></h5></div>
               </div>
               
               
             </div>
           </div>
         </div>
         <div class="col-4 grid-margin stretch-card"></div>
         <div class="col-4 grid-margin stretch-card">

         <?php 
        
  $update=mysqli_query($conn,"UPDATE patients SET address='$address', category='$category', other='$other', remark4='$remark4' WHERE sr=$sr ");
  
     
  if ($update) {
    echo '
    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="ti-check-box"></i>
        <strong class="mx-2">Success!</strong> Your message has been submitted successfully.
    </div>';
   header("refresh:1;url=details.php");
   }
   else{
         echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
         <i class="ti-alert"></i>
         <strong class="mx-2">Error!</strong> A problem has been occurred while submitting your data.
     
         </div>';
         header("refresh:1;url=edit.php");
   }
  }
 
?>
              
              
            </div>
            <div class="col-4 grid-margin stretch-card"></div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include 'section/footer.php';  ?>
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
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>