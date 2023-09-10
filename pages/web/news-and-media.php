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
                  <h4 class="card-title">News & Media</h4>
                  <form method="POST" enctype="multipart/form-data">
                    <div class="template-demo">
                      <label class="badge badge-outline-dark btn-icon-text">
                        <input type="file" name="img" style="display: none;" />
                        <i class="ti-upload btn-icon-prepend"></i>
                        Upload Media
                      </label>
                      <input type="text" name="title" placeholder="Enter image Title">
                      <input type="text" name="alttag" placeholder="Enter alt Tag">

                      <button type="submit" name="submit" class="badge badge-primary btn-icon-text">
                        Submit
                      </button>
                    </div>
                  </form>
                  <?php
                  error_reporting(0);
                    include'../../dbcon.php';

                    //uploding photos

                    if (isset($_POST["submit"])) {
                      $title=$_POST["title"];
                      $alttag=$_POST["alttag"];

                      if($_FILES['img']['name']){
                        $info=getimagesize($_FILES['img']['tmp_name']);
                        $filename= $_FILES['img']['name'];
                        $tempname= $_FILES['img']['tmp_name'];
                        $size=$_FILES['img']['size'];
                        $extention= pathinfo($filename,PATHINFO_EXTENSION);
                        $filenm= pathinfo($filename,PATHINFO_FILENAME);
                        $filenameok= $filenm.date("mjYHis").".".$extention;
                        $folder= 'static/images/news/'.$filenameok;
                        $output= '../../static/images/news/'.$filenameok;

                        $fileexe= explode('.',$filename);
                        $imgextension= strtolower(end($fileexe));
                        $array= array('png','jpeg','jpg','webp');

                        if (in_array($imgextension, $array)) {
                            if($size<1048576){
                              move_uploaded_file($tempname, $output);                  

                                        $insert="INSERT INTO `news`(`image`, `title`, `alttag`) VALUES ('$folder','$title','$alttag')";
                                        $sql=mysqli_query($conn,$insert);
                                        ?>
                          <meta http-equiv="refresh" content="0" />
                          <?php
                                }
                                else{
                                  echo '<h4 style="color: red">please select image less than 1 MB </h4>';
                                }
                              }
                                else{
                                  echo '<h4 style="color: red">Select image in jpg, jpeg, png image format</h4>';
                              }
                            }
                              else{
                                echo '<h4 style="color: red">Please Select Image</h4>';
                            }
                          }
                          ?>


                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Possion of Media</th>
                          <th>Image</th>
                          <th>Up</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          include "../../dbcon.php";
                          $table= "SELECT * FROM  news ORDER BY sr ASC";
                          $result =mysqli_query($conn,$table);
                            while ($row= mysqli_fetch_array($result)) { 
                              ?>
                        <tr>
                          <td><?php echo $i; 
                              $num=$i-2; 
                              $i=$i+1; ?></td>
                          <td><img style="height: 50px; width: auto; border-radius: 0%;"
                              src="../../<?php echo $row['image'] ?>" /></td>
                          <!-- <td><label class="badge badge-warning"><i class="ti-arrow-up"></i> UP</label> </td> -->
                          <td>
                            
                            <form method="POST">
                            <?php if ($i!=2) {?>
                              <input type="text" name="sr" value="<?php echo $row['sr'] ?>" style="display: none;">
                              <button class="btn badge badge-warning" type="submit" name="up"
                                value="<?php echo $num; ?>" ><i
                                  class="ti-arrow-up"></i>&nbsp;UP</button> 
                                  <?php } ?>
                              <input type="text" name="image" value="<?php echo $row['image'] ?>" style="display: none;">
                            <!-- <button class="btn badge badge-outline-danger" type="submit" name="delete"
                                value="<?php echo$row['sr'] ?>" ><i class="ti-trash"></i>&nbsp;Delete</button> -->
                                <td><button type="submit" name="delete" value="<?php echo $row['sr'] ?>" class="badge badge-dark" href="?action=delete" onclick="return confirm('Are you sure you want to delete?')"><i class="ti-trash"></i>&nbsp;Delete</button>
                              </td>
                                
                                </form>
                            
                          </td>
                        </tr>
                        <?php
                                }



                                   //news Deletion
                                   if (isset($_POST['delete'])) {
                                    $sr=$_POST['delete'];

                                        $update = mysqli_query($conn,"DELETE FROM news WHERE sr=$sr");
                                        $filename='../../'.$_POST['image'];
                                        unlink($filename);
                                        if($update){
                                            //echo "successful discarded";
                                            ?><meta http-equiv="refresh" content="0" /><?php
                                        }
                                    
                                    
                                    else{
                                        echo"discardation Failed";
                                    }
                                }

                              




                                  //news Updation
                                  if (isset($_POST["up"])) {
                                    $sr2= $_POST["sr"];
                                    $num= $_POST["up"];

                                    $query="SELECT * FROM news ORDER BY sr ASC LIMIT 1 OFFSET $num";
                                    $show1 = mysqli_query($conn,$query);
                                    $row1= mysqli_fetch_array($show1);
                                    
                                    $sr1= $row1['sr'];

                                    $data1 = "SELECT * FROM news where sr=$sr1";
                                    $show1 = mysqli_query($conn,$data1);
                                    $row1= mysqli_fetch_array($show1);
                                    $image1= $row1['image'];
                                    $title1=$row1['title'];
                                    $tag1=$row1['alttag'];
                                    

                                    $data2 = "SELECT * FROM news where sr=$sr2";
                                    $show2 = mysqli_query($conn,$data2);
                                    $row2= mysqli_fetch_array($show2);
                                    $image2= $row2['image'];
                                    $title2=$row2['title'];
                                    $tag2=$row2['alttag'];

                                    $update1=mysqli_query($conn,"UPDATE news SET `image`='$image2',`title`='$title2',`alttag`='$tag2' WHERE sr=$sr1 ");
                                    $update2=mysqli_query($conn,"UPDATE news SET `image`='$image1',`title`='$title1',`alttag`='$tag1' WHERE sr=$sr2 ");

                                   
                                    ?><meta http-equiv="refresh" content="0" /> <?php
                                  

                                    // if($update1 && $update2){
                                    //     echo "Success \n\n";
                                    // }
                                    // else{
                                    //     echo "fail";
                                    // }
                                    // if($update2){
                                    //     echo "Success";
                                    // }
                                    // else{
                                    //     echo "fail";
                                    // }
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