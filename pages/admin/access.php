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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">User Details</h4>
                  <p class="card-description">
                    Update Access of the <code>user</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Sr
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Profile
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Login Access
                          </th>
                          <th>
                            Accesses
                          </th>
                          <th>Remove User</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          $i=1;
                          include "../../dbcon.php";
                          
                          $table= "SELECT * FROM  user ORDER BY sr DESC";
                          $result =mysqli_query($conn,$table);
                            while ($row= mysqli_fetch_array($result)) { 
                              
                              ?>
                        <tr>
                          <td class="py-1">
                          <?php echo $i; $i=$i+1; ?>
                          </td>
                          <td>
                          <?php echo $row['name'];?>
                          </td>
                          <td>
                          <?php echo $row['profile'];?>
                          </td>
                          <td>
                          <?php echo $row['email'];?>
                          </td>
                          <td> 

                          <?php $login=$row['login'];
                              if($login=="yes"){ ?>
                                <label class="badge badge-success">Active</label>
                              <?php }
                                else{ ?>
                                  <label class="badge badge-warning">Inactive</label>
                                <?php } ?>
                                        
                          </td>
                          <!-- <td><form method="post" action="edit.php"><button class="badge badge-primary" type="submit" name="submit" value="<?php echo $row['sr'] ?>" class="btn"><i class="ti-pencil"></i>&nbsp;&nbsp;Edit</button></form></td> -->
                          <!-- <td>
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">hsdfh </button>
                          </td> -->
                          <td>
                            <a class="badge badge-primary" data-toggle="modal"
                              data-target="#myModal<?php echo $row['sr'] ?>" href="#"><i
                                class="ti-pencil"></i>&nbsp;&nbsp;Edit</a>
                          </td>

                          
                        <!-- Modal Start -->
                        <div class="modal fade" id="myModal<?php echo $row['sr'] ?>" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-md" role="document">
                            <div class=" border-redi modal-content">
                                <div class="modal-header py-1 my-1">

                                <h4 class="modal-title" id="myModalLabel">Access</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                                </div>
                              <div class="modal-body mt-0 pt-0">

                              <!-- Flaxible Form according to remrk -->
                                
                                <form method="POST" name="contact_form">
                                <div class="row">
                                  <div class="col-6 mt-2 text-right">
                                    
                                    <p ><b>Login Access</b></p>

                                  </div>
                                  <div class="col-6  mt-2">

                                  <div class="custom-control custom-switch">
                                          <input name="switch" type="checkbox" class="custom-control-input" id="login<?php echo $row['sr'] ?>" <?php if($row['login']=='yes'){ echo"checked"; }?> >
                                          <label class="custom-control-label" for="login<?php echo $row['sr'] ?>"></label>
                                        </div>
                                        <input type="hidden" name="login" id="logins<?php echo $row['sr'] ?>" value="<?php echo $row['login'] ?>" />
                                </div>

                                <div class="col-6 mt-2 text-right">
                                    <p>CRM User</p>
                                  </div>
                                  <div class="col-6 mt-2">

                                  <div class="custom-control custom-switch">
                                          <input name="switch" type="checkbox" class="custom-control-input" id="crm<?php echo $row['sr'] ?>" <?php if($row['crm']=='yes'){ echo"checked"; }?> >
                                          <label class="custom-control-label" for="crm<?php echo $row['sr'] ?>"></label>
                                        </div>
                                        <input type="hidden" name="crm" id="crms<?php echo $row['sr'] ?>" value="<?php echo $row['crm'] ?>" />

                                </div>

                                <div class="col-6 mt-2 text-right">                                    
                                    <p >CRM Admin</p>                                  
                                  </div>
                                  <div class="col-6 mt-2">

                                  <div class="custom-control custom-switch">
                                  <input name="switch" type="checkbox" class="custom-control-input" id="crmadmin<?php echo $row['sr'] ?>" <?php if($row['crmadmin']=='yes'){ echo"checked"; }?> >
                                  <label class="custom-control-label" for="crmadmin<?php echo $row['sr'] ?>"></label>
                                </div>
                                <input type="hidden"  name="crmadmin" id="crmadmins<?php echo $row['sr'] ?>" value="<?php echo $row['crmadmin'] ?>" />
                                </div>

                                <div class="col-6 mt-2 text-right">
                                    
                                    <p >Web Admin</p>

                                  </div>
                                  <div class="col-6 mt-2">

                                  <div class="custom-control custom-switch">
                                          <input name="switch" type="checkbox" class="custom-control-input" id="web<?php echo $row['sr'] ?>" <?php if($row['web']=='yes'){ echo"checked"; }?> >
                                          <label class="custom-control-label" for="web<?php echo $row['sr'] ?>"></label>
                                        </div>
                                        <input type="hidden"  name="web" id="webs<?php echo $row['sr'] ?>" value="<?php echo $row['web'] ?>"/>
                                </div>


                                <div class="col-6 mt-2 text-right">                                    
                                    <p >Admin Manager</p>                                  
                                  </div>
                                  <div class="col-6 mt-2">

                                  <div class="custom-control custom-switch">
                                  <input name="switch" type="checkbox" class="custom-control-input" id="superadmin<?php echo $row['sr'] ?>" <?php if($row['superadmin']=='yes'){ echo"checked"; }?> >
                                  <label class="custom-control-label" for="superadmin<?php echo $row['sr'] ?>"></label>
                                </div>
                                <input type="hidden"  name="superadmin" id="superadmins<?php echo $row['sr'] ?>" value="<?php echo $row['superadmin'] ?>" />
                                </div>

                                
                                <div class="col-12 text-center mt-3">                                
                                      <button type="submit" name="submit" class="btn badge badge-success btn-flat" value="<?php echo $row['sr'] ?>" > Update</button>
                                </div>


                            </div>
                          </div>
                        </div>
                        <!-- Modal End -->

                        <!-- Updation form End Here-->
                          
                        <td><form method="POST">
                        <button type="submit" name="delete" value="<?php echo $row['sr'] ?>" class="badge badge-dark" href="?action=delete" onclick="return confirm('Are you sure you want to delete?')"><i class="ti-trash"></i>&nbsp;Delete</button>
                        </form></td>
                        </tr>
                        

<script src="../../vendors/js/vendor.bundle.base.js"></script>
<script><?php include 'section/bootstrap-toggle.min.js';  ?></script>
<script>
$(document).ready(function(){


  $("#login<?php echo $row['sr'] ?>").change(function(){
  if($(this).prop('checked'))
  {
   $("#logins<?php echo $row['sr'] ?>").val('yes');
  }
  else
  {
   $("#logins<?php echo $row['sr'] ?>").val('no');
  }
 });


 $("#crm<?php echo $row['sr'] ?>").change(function(){
  if($(this).prop('checked'))
  {
   $("#crms<?php echo $row['sr'] ?>").val('yes');
  }
  else
  {
   $("#crms<?php echo $row['sr'] ?>").val('no');
  }
 });



$('#web<?php echo $row['sr'] ?>').change(function(){
  if($(this).prop('checked'))
  {
   $('#webs<?php echo $row['sr'] ?>').val('yes');
  }
  else
  {
   $('#webs<?php echo $row['sr'] ?>').val('no');
  }
 });



$('#crmadmin<?php echo $row['sr'] ?>').change(function(){
  if($(this).prop('checked'))
  {
   $('#crmadmins<?php echo $row['sr'] ?>').val('yes');
  }
  else
  {
   $('#crmadmins<?php echo $row['sr'] ?>').val('no');
  }
 });


 $('#superadmin<?php echo $row['sr'] ?>').change(function(){
  if($(this).prop('checked'))
  {
   $('#superadmins<?php echo $row['sr'] ?>').val('yes');
  }
  else
  {
   $('#superadmins<?php echo $row['sr'] ?>').val('no');
  }
 });

});
</script>


                                    <?php }   ?>
                                    
                                    
                                
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        


                        <?php

                          if (isset($_POST["submit"])) {
                          $sr=$_POST["submit"];
                          $login=$_POST["login"];
                          $crm=$_POST["crm"];
                          $web=$_POST["web"];
                          $crmadmin=$_POST["crmadmin"];
                          $superadmin=$_POST["superadmin"];


                          $update=mysqli_query($conn,"UPDATE `user` SET crm='$crm', login='$login', web='$web', crmadmin='$crmadmin', superadmin='$superadmin' WHERE sr=$sr");
                          if($update){
                              echo "Approved successfully";
                              ?><meta http-equiv="refresh" content="0" /> <?php
                          }
                          else{
                              echo"Not approve";
                          }
                          
                  }
                  if (isset($_POST['delete'])) {
                    $sr=$_POST['delete'];
                        $update = mysqli_query($conn,"DELETE FROM user WHERE sr=$sr");
                        
                        if($update){
                            //echo "successful discarded";
                            ?><meta http-equiv="refresh" content="0" /><?php
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
  <!-- <script>
$(document).ready(function(){

 $('#patient').change(function(){
  if($(this).prop('checked'))
  {
   $('#patient1').val('yes');
  }
  else
  {
   $('#patient1').val('no');
  }
 });



$('#web').change(function(){
  if($(this).prop('checked'))
  {
   $('#web1').val('yes');
  }
  else
  {
   $('#web1').val('no');
  }
 });



$('#admin').change(function(){
  if($(this).prop('checked'))
  {
   $('#admin1').val('yes');
  }
  else
  {
   $('#admin1').val('no');
  }
 });

});
</script> -->



</body>

</html>
<?php
   }
?>




