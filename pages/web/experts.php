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
                  <h4 class="card-title">Doctors</h4>
                  
                  <a class="badge badge-primary mb-2" data-toggle="modal" data-target="#addData" href="#"><i
                    class="ti-plus"></i>&nbsp;&nbsp;Add Member</a>

                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Sr</th>
                          <th>Image</th>
                          <th>Doctor Id</th>
                          <th>Name</th>
                          <th>Qualification</th>
                          <th>Expertise</th>
                          <th>Exprience</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        error_reporting(0);
                          $i=1;
                          include "../../dbcon.php";
                          $table= "SELECT * FROM  doctor  ORDER BY sr DESC";
                          $result =mysqli_query($conn,$table);
                          
                            while ($row= mysqli_fetch_array($result)) { 
                         ?>
                        <tr>
                          <td><?php echo $i; 
                              $num=$i-2; 
                              $i=$i+1; ?></td>
                          <td><img style="height: 50px; width: auto; border-radius: 20%;"
                              src="../../<?php echo $row['image'] ?>" /></td>
                          <!-- <td><label class="badge badge-warning"><i class="ti-arrow-up"></i> UP</label> </td> -->
                          <td>
                          BK<?php echo $row['doctorid'] ?>
                          </td>
                          <td>
                          <?php echo $row['name'] ?>
                          </td>
                          <td>
                          <?php echo $row['qualification'] ?>
                          </td>
                          <td>
                          <?php echo $row['expertise'] ?>
                          </td>
                          <td>
                          <?php echo $row['experience'] ?>
                          </td>
                          <td>
                          <form method="POST">
                            <?php if ($row['approval']=='yes') {   ?>
                              <button type="submit" name="no" value="<?php echo $row['sr'] ?>" class="badge badge-success btn-icon-text">
                        Approved
                      </button>
                        <!-- <button type="submit" name="no" value="<?php echo $row['sr'] ?>" class="btn btn-warnning text-uppercase">Disapprove</button> -->
                        <?php }
                        else{ ?>
                        <button type="submit" name="yes" value="<?php echo $row['sr'] ?>" class="badge badge-warning btn-icon-text">
                        Disapproved
                      </button>
                        <?php  }  ?></form>
                          </td>
                          <td>
                          <a class="badge badge-primary" data-toggle="modal"
                              data-target="#myModal<?php echo $row['sr'] ?>" href="#"><i
                                class="ti-pencil"></i>&nbsp;&nbsp;Edit</a>
                          <!-- <form method="post" action="doctor-edit.php"><button class="btn btn-default text-uppercase" type="submit" name="edit" value="<?php echo $row['sr'] ?>" >Edit</button></form> -->
                          </td>
                          <td>
                          <form method="POST">
                        <button type="submit" name="delete" value="<?php echo $row['sr'] ?>" class="badge badge-dark btn-icon-text" href="?action=delete" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                        </form>
                        </td>
                        </tr>

                        <?php
                        if (isset($_POST["yes"])) {
                                $sr1=$_POST["yes"];
                                $update1=mysqli_query($conn,"UPDATE `doctor` SET approval='yes' WHERE sr=$sr1");
                                if($update1){
                                    //echo "Approved successfully";
                                    ?><meta http-equiv="refresh" content="0" /> <?php
                                }
                                else{
                                    echo"approval failed";
                                }
                                
                        }
                        if (isset($_POST['no'])) {
                                $sr2=$_POST["no"];   
                                $update2=mysqli_query($conn,"UPDATE `doctor` SET approval='no' WHERE sr=$sr2");
                                if($update2){
                                    //echo "successful discarded";
                                    ?><meta http-equiv="refresh" content="0" /> <?php
                                }
                                else{
                                    echo"approval failed";
                                }
                        }
                        if (isset($_POST['delete'])) {
                            $sr3=$_POST['delete'];

                              //deleting image
                                $forreport = mysqli_query($conn,"SELECT * FROM  doctor WHERE sr=$sr3");
                                $row1= mysqli_fetch_array($forreport);
                                $img1='../../'.$row1['image'];
                                unlink($img1);

                                $delete1 = mysqli_query($conn,"DELETE FROM doctor WHERE sr=$sr3");
                                if($delete1){
                                    //echo "successful discarded";
                                    ?><meta http-equiv="refresh" content="0" /><?php
                                }
                            else{
                                echo"deletion Failed";
                            }
                        }

?>


                        <!-- Modal Start -->
                        <div class="modal fade" id="myModal<?php echo $row['sr'] ?>" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-md" role="document">
                            <div class=" border-redi modal-content">
                              <div class="modal-header py-2 my-1">

                                <h4 class="modal-title" id="myModalLabel">Profile Updation</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body mt-3 pt-0">
                                    <!-- Contact Form -->

                                <form id="contact_form" name="contact_form" method="POST" enctype="multipart/form-data">
                                  <div class="row">
                                  <div class="col-sm-12 d-flex justify-content-center">
                                  <img style="height: 150px; width: auto; border-radius: 20%;" src="../../<?php echo $row['image'] ?>" />


                                  </div>

                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label for="form_name">Name <small>*</small></label>
                                        <input id="form_name" name="name" class="form-control" type="text"
                                          value="<?php echo $row['name'] ?>" required>
                                      </div>
                                    </div>
                                  

                                  
                                    
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                        <label for="form_expertise">Expertise<small>*</small></label>
                                        <input id="form_expertise" name="expertise" value="<?php echo $row['expertise'] ?>" class="form-control" type="text" required>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_qualification">Qualification<small>*</small></label>
                                        <input id="form_qualification" name="qualification" value="<?php echo $row['qualification'] ?>" class="form-control" type="text" required>
                                      </div>
                                    </div>

                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_experience">Years of Experience<small>*</small></label>
                                        <input id="form_experience" name="experience" value="<?php echo $row['experience'] ?>" class="form-control" type="text" required>

                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group" id="img">
                                        <label for="form_name">Profile Image<small>*</small></label>
                                        <input id="img" type="file" name="img">
                                      </div>
                                    </div>

                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <input id="form_botcheck" name="form_botcheck" class="form-control"
                                          type="hidden" value="" />
                                        <button name="update" type="submit" value="<?php echo $row['sr'] ?>"
                                          style="float: right;"
                                          class="btn btn-success btn-theme-colored btn-flat">Submit</button>
                                      </div>
                                    </div>
                                    </div>
                                    <br>

                                </form>
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- Modal End -->

<?php

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




  <!-- Modal Start Add Data -->

  <div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class=" border-redi modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel">Add Member</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">


          <form id="contact_form" name="contact_form" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="form_name">Name<small>*</small></label>
                  <input id="form_name" name="name" class="form-control" type="text" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="form_expertise">Expertise<small>*</small></label>
                  <input id="form_expertise" name="expertise" class="form-control" type="text" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form_qualification">Qualification<small>*</small></label>
                  <input id="form_qualification" name="qualification" class="form-control" type="text" required>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form_experience">Years of Experience<small>*</small></label>
                  <input id="form_experience" name="experience" class="form-control" type="text" required>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group" id="img">
                  <label for="form_name">Profile Image<small>*</small></label>
                  <input id="img" type="file" name="img" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                  <button name="addmember" type="submit" style="float: right;"
                    class="btn btn-success btn-theme-colored btn-flat">Submit</button>
                </div>
              </div>

            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- End Model Add Data -->



  <?php

include "../../dbcon.php";
         
//New Data Insertion 

if (isset($_POST["addmember"])) {

  $name=$_POST["name"];
  $expertise=$_POST["expertise"];
  $qualification=$_POST["qualification"];
  $experience=$_POST["experience"];
  date_default_timezone_set('Asia/Kolkata');
  $date= date('d-m-Y g:i a');

  if (!preg_match("/[`!@#$%^*()_\=\[\]{};':\\|<>\/?~]/",$qualification)&& preg_match("/^[0-9 ]+$/",$experience)&& preg_match("/^[A-Za-z ]+$/",$name)&& preg_match("/^[A-Za-z ]+$/",$expertise)&& preg_match("/^[A-Za-z ]+$/",$name)) {
   
   //doctor-id-increment
   $query1="select * from doctor ORDER BY sr DESC LIMIT 1";
   $result1 =mysqli_query($conn,$query1);
   $row= mysqli_fetch_array($result1);
   $doctorid=$row['doctorid']+1;


   //image Submission
   $file=$_FILES['img']['tmp_name'];
	$filename= $_FILES['img']['name'];
	$extention= pathinfo($filename,PATHINFO_EXTENSION);

	$array= array('png','jpeg','jpg','JPG');                    
	if (in_array($extention, $array)) {

	list($width,$height)=getimagesize($file);

	if($width<10000 && $height<10000){

		$filenm= pathinfo($filename,PATHINFO_FILENAME);
		$filenameok= $filenm.date("mjYHis").'.webp';
		$output= '../../static/images/doctor/'.$filenameok;
    $store='static/images/doctor/'.$filenameok;



		$nwidth=500;
		$nheight=500;
		$newimage=imagecreatetruecolor($nwidth,$nheight);
		if($_FILES['img']['type']=='image/jpeg'){
			$source=imagecreatefromjpeg($file);
			imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
			$file_name=time().'.webp';
			ob_start();
			imagejpeg($newimage,NULL,100);
			$cont = ob_get_contents();
				ob_end_clean();
				imagedestroy($newimage);
				$content = imagecreatefromstring($cont);
				$upload= imagewebp($content,$output);
				imagedestroy($content);
		}elseif($_FILES['img']['type']=='image/png'){
			$source=imagecreatefrompng($file);
			imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
			$file_name=time().'.webp';
			ob_start();
			imagejpeg($newimage,NULL,100);
			$cont = ob_get_contents();
				ob_end_clean();
				imagedestroy($newimage);
				$content = imagecreatefromstring($cont);
				$upload= imagewebp($content,$output);
				imagedestroy($content);
		}elseif($_FILES['img']['type']=='image/jpg'){
			$source=imagecreatefromjpg($file);
			imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
			$file_name=time().'.webp';
			ob_start();
			imagejpeg($newimage,NULL,100);
			$cont = ob_get_contents();
				ob_end_clean();
				imagedestroy($newimage);
				$content = imagecreatefromstring($cont);
				$upload= imagewebp($content,$output);
				imagedestroy($content);
		}

	}
  else{
    echo "<script>   alert('Image size is too large');  </script>";
  }


  $insert="INSERT INTO `doctor`(`date`, `doctorid`, `name`, `expertise`, `qualification`, `experience`, `image`) VALUES ('$date','$doctorid','$name','$expertise','$qualification','$experience','$store')";

  $sql=mysqli_query($conn,$insert);
  
  if ($sql) {?>
    <meta http-equiv="refresh" content="0" />
    <?php
  }
  else{
    echo "<script>   alert('Registration Failed');  </script>";   
  }


  }
  else{
    echo "<script>   alert('Please select only jpg, png and jpeg image');  </script>";
  }
}
else{
      echo "<script>   alert('Invailed Input');  </script>";
       } 

}
                 
//New Data Insertion END   






//Updation Code START

if (isset($_POST["update"])) {

          $sr4=$_POST["update"];
          $name=$_POST["name"];
          $expertise=$_POST["expertise"];
          $qualification=$_POST["qualification"];
          $experience=$_POST["experience"];

          if($_FILES['img']['name']){

            //image Submission
            $file=$_FILES['img']['tmp_name'];
            $filename= $_FILES['img']['name'];
            $extention= pathinfo($filename,PATHINFO_EXTENSION);

            $array= array('png','jpeg','jpg','JPG');                    
            if (in_array($extention, $array)) {

            list($width,$height)=getimagesize($file);

            if($width<10000 && $height<10000){

              $filenm= pathinfo($filename,PATHINFO_FILENAME);
              $filenameok= $filenm.date("mjYHis").'.webp';
              $output= '../../static/images/doctor/'.$filenameok;
              $store='static/images/doctor/'.$filenameok;



              $nwidth=500;
              $nheight=500;
              $newimage=imagecreatetruecolor($nwidth,$nheight);
              if($_FILES['img']['type']=='image/jpeg'){
                $source=imagecreatefromjpeg($file);
                imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                $file_name=time().'.webp';
                ob_start();
                imagejpeg($newimage,NULL,100);
                $cont = ob_get_contents();
                  ob_end_clean();
                  imagedestroy($newimage);
                  $content = imagecreatefromstring($cont);
                  $upload= imagewebp($content,$output);
                  imagedestroy($content);
              }elseif($_FILES['img']['type']=='image/png'){
                $source=imagecreatefrompng($file);
                imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                $file_name=time().'.webp';
                ob_start();
                imagejpeg($newimage,NULL,100);
                $cont = ob_get_contents();
                  ob_end_clean();
                  imagedestroy($newimage);
                  $content = imagecreatefromstring($cont);
                  $upload= imagewebp($content,$output);
                  imagedestroy($content);
              }elseif($_FILES['img']['type']=='image/jpg'){
                $source=imagecreatefromjpg($file);
                imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                $file_name=time().'.webp';
                ob_start();
                imagejpeg($newimage,NULL,100);
                $cont = ob_get_contents();
                  ob_end_clean();
                  imagedestroy($newimage);
                  $content = imagecreatefromstring($cont);
                  $upload= imagewebp($content,$output);
                  imagedestroy($content);
              }

            }
            else{
              echo "<script>   alert('Image size is too large');  </script>";
            }

            //removing old image
            $remove = mysqli_query($conn,"SELECT * FROM  doctor WHERE sr=$sr4");
            $row4= mysqli_fetch_array($remove);
            $image='../../'.$row4['image'];
            unlink($image);


         //data insertion
         $update=mysqli_query($conn,"UPDATE doctor SET name='$name', expertise='$expertise', qualification='$qualification', experience='$experience', image='$store' WHERE sr=$sr4");

      
 }
 else{
  echo "<script>   alert('Please select only jpg, png and jpeg image');  </script>";
}

}
else{


 //data insertion
 $update=mysqli_query($conn,"UPDATE doctor SET name='$name', expertise='$expertise', qualification='$qualification', experience='$experience' WHERE sr=$sr4");

}
if ($update) {?>
  <meta http-equiv="refresh" content="0" />
  <?php
  }
else{
  echo "<script>   alert('Updation Failed');  </script>";
}

  }

                            


// updation End Here


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