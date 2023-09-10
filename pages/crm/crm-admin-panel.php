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
                  <h4 class="card-title">Basic Table</h4>
                  
                  <div class="row mb-4">
                  <div class="col-2">

                  <form method="POST" enctype="multipart/form-data">
                    
                      <label class="badge badge-outline-dark btn-icon-text">
                        <input type="file" name="excel" style="display: none;" required value=""/>
                        <i class="ti-upload btn-icon-prepend"></i>
                        Upload file
                      </label>

                      <button type="submit" name="import" class="badge badge-primary btn-icon-text">
                        Submit
                      </button>
                    
                  </form>
                  </div>
                  <div class="col-5">
                  <a class="badge badge-light" href="semple-excel.php"><i
                      class="ti-download btn-icon-prepend"></i>&nbsp;&nbsp;Download Format</a>
                  <a class="badge badge-warning" href="download.php"><i
                      class="ti-download btn-icon-prepend"></i>&nbsp;&nbsp;Download</a>
                  
                  <a href="javascript:void(0)" class="badge badge-danger link_delete" onclick="delete_all()"><i class="ti-trash"></i>&nbsp;&nbsp;Delete</a>
              </div>
                  <div class="col-5 text-right">
                  
                  
                    <form method="POST">
                      <input type="date" name="from"> to
                      <input type="date" name="to">
                      <select name="category" type="text">
                          <option value="" selected disabled>Category</option>
                          <option value="Hot">Hot</option>
                          <option value="Warm">Warm</option>
                          <option value="Cold">Cold</option>
                          <option value="Closed">Closed</option>
                          <option value="Converted">Converted</option>
                      </select>

                      <button type="submit" name="filter" class="badge badge-primary">
                        Filter
                      </button>
                      <button type="submit" name="reset" class="badge badge-danger">
                        Reset
                      </button>
                  </form>
                </div>
                <div class="col-12">



                    <!-- Upload Excel Code Start here -->
  <?php

include "../../dbcon.php";

		if(isset($_POST["import"])){
			if($_FILES['excel']['name']){
			$fileName = $_FILES["excel"]["name"];
			$size=$_FILES['excel']['size'];
			$fileExtension = explode('.', $fileName);
      		$fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;
			$array= array('csv','xlsx');


			if (in_array($fileExtension, $array)) {
				if($size<2097152){

			$targetDirectory = "uploads/".$newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);
      

			error_reporting(0);
			ini_set('display_errors', 0);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $rows){
        
				if($key!=0){
          
				$date = $rows[0];
				$time = $rows[1];
				$name = $rows[2];
        $phone = $rows[3];
        $disease = $rows[4];
        $message = $rows[5];
        $address = $rows[6];
        $category = $rows[7];
        $sources = $rows[8];
        $other = $rows[9];
        
				$test=mysqli_query($conn,"SELECT * from patients WHERE phone='$phone'");
        
                  $rw=mysqli_num_rows($test);
                  if(!$rw){ 
				$import= mysqli_query($conn, "INSERT INTO patients(`sr`, `date`, `time`, `name`, `phone`, `disease`, `message`, `address`, `category`, `sources`, `other`) VALUES('','$date','$time', '$name', '$phone', '$disease','$message','$address','$category','$sources','$other')");
			
				
			}else{
				echo '<p style="color: red">'.$phone .' This User already Exist</p>';
			  }
			} }

				unlink($targetDirectory);
				 ?>
         <meta http-equiv="refresh" content="5" /> <?php
         
		}
			else{
				echo '<h4 style="color: red">please select file less than 2 MB </h4>';
			  }
			}
		else{
			echo '<h4 style="color: red">Select Excel file in csv, xlsx format</h4>';
		}
	}
	else{
	  echo '<h4 style="color: red">Please Select file</h4>';
  		}
	}

		?>

    <!-- Upload Excel Code End here -->

    
</div>

                
                
</div>

                  <!-- <p class="card-description">Add class <code>.table</code></p> -->
                  <div class="table-responsive">
                  <form method="post" id="frm">
                    <table class="table">
                      <thead>
                        <tr>
                        <th><input type="checkbox" onclick="select_all()"  id="delete"/></th>
                          <th>Sr</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Remark</th>
                          <th>Category</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          include "../../dbcon.php";

                          //Filter section Start
                          if(!isset($_SESSION['datee'])){
                            $_SESSION['datee']="WHERE campion=1";
                          }

                            if(isset($_POST['from']) && $_POST['to']==""){

                              $from=$_POST['from']; 
                              $sub_sql= "WHERE campion=1 && date ='$from' ";
                              $_SESSION['datee']=$sub_sql;
                              echo "from 1";
                            }
                            elseif(isset($_POST['from']) && isset($_POST['to']) && !isset($_POST['category'])){
                              $to=$_POST['to'];
                              $from=$_POST['from']; 
                              $sub_sql= "WHERE campion=1 && date >= '$from' && date <= '$to' ";
                              $_SESSION['datee']=$sub_sql;
                              echo "from 2";
                              
                            }
                            elseif(isset($_POST['to']) && isset($_POST['from']) && isset($_POST['category'])){
                              $to=$_POST['to'];
                              $from=$_POST['from'];
                              $category=$_POST['category'];

                              $sub_sql= "WHERE campion=1 && date >= '$from' && date <= '$to' && category='$category'";
                              $_SESSION['datee']=$sub_sql;
                              echo "from 3";
                            }
                            if(isset($_POST['reset'])){
                              $_SESSION['datee']="WHERE campion=1";
                              echo "Reset";
                            }

                            $daterange=$_SESSION['datee'];


                            //Filter section  End
                          
                          $query=mysqli_query($conn,"SELECT * FROM  patients $daterange");
                                //pagination start
                                
                                $perpage=7;
                                if(isset($_POST['okey'])){
                                  $perpage=$_POST['perpage'];
                                }
                                
                                $start=0;
                                $current_page="1";
                                if(isset($_GET['start'])){
                                  $start=$_GET['start'];
                                  if($start==0){
                                    die();
                                  }
                                  $current_page=$start;
                                  $start--;
                                  $start=$start*$perpage;
                                }
                                //for sr print
                                $i = $start+1;
                          
                                $record=mysqli_num_rows($query);
                                $pagi=ceil($record/$perpage);
                                //pagination end
                          $table= "SELECT * FROM  patients $daterange ORDER BY sr DESC Limit $start,$perpage";
                          $result =mysqli_query($conn,$table);
                            while ($row= mysqli_fetch_array($result)) { 
                              
                              ?>
                        <tr>
                        <td><input type="checkbox" id="<?php echo $row['sr']?>" name="checkbox[]" value="<?php echo $row['sr']?>"/></td>
                          <td>
                            <?php echo $i; $i=$i+1; ?>
                          </td>
                          <td>
                            <?php 
                              $datedef=$row['date'];
                              $dat=explode("-",$datedef);
                              $dater=$dat['2'].'-'.$dat['1'].'-'.$dat['0'];
                              echo $dater   ?>
                            </td>
                          <td>
                            <?php echo $row['time'];   ?>
                          </td>

                          <td>
                            <p class="h5">
                            <a style="text-decoration:none; color: black;" data-toggle="modal"
                              data-target="#details<?php echo $row['sr'] ?>" href="#"><?php echo $row['name'];?></a>
                              <?php  if ($row['report1']){    ?>
                              <span class="badge badge-success p-1" 
                                 style="font-size: 10px;"
                                >report</span>
                            </p>
                            <?php }   ?>

                          </td>
                          <td><?php echo $row['phone'] ?></td>
                          
                          

                          <td>
                            <?php echo $row['address'] ?>
                          </td>
                          <?php
                              if($row['remark4']){
                                $remark=$row['remark4'];
                              }
                              elseif($row['remark3']){
                                $remark=$row['remark3'];
                              }
                              elseif($row['remark2']){
                                $remark=$row['remark2'];
                              }
                              elseif($row['remark1']){
                                $remark=$row['remark1'];
                              }
                              else{
                                $remark="";
                              }      
                          ?>
                          <td>
                          <?php  if ($remark){    ?>
                            <a style="text-decoration: none;" href="#" data-toggle="tooltip"
                              title="<?php echo $remark; ?>"><label class="badge badge-light">remark</label></a>
                              <?php } ?>
                            </td> 
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
                              elseif($cat=="Converted"){
                                $style="badge badge-dark";
                              }
                              else{
                                $style="badge badge-light";
                              }      
                          ?>
                          <td><label class="<?php echo $style ?>">
                              <?php echo $row['category'] ?>
                            </label></td>
                          
                        </tr>

                        <!--details Modal Modal Start -->
                        <div class="modal fade" id="details<?php echo $row['sr'] ?>" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-md" role="document">
                            <div class=" border-redi modal-content">
                              <div class="modal-header py-1 my-1">

                                <h4 class="modal-title" id="myModalLabel">Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body" <?php if ($row['amount']){ ?> style="background-image: url('../../images/gif/celebrate.gif'); height: auto;" <?php  } ?> >

                                <!-- details -->
                                <div class="row">
                                  <?php if ($row['amount']){    ?>
                                        <div class="col-12 mt-0 mb-3">
                                        <h3 class="text-center" style="color:green;">Conversion Amount:  &#8377; <?php echo $row['amount'] ?></h3>
                                          
                                        </div>
                                        <?php  } ?>
                                  <div class="col-6">
                                    <h5><i class="icon-head"></i>&nbsp;&nbsp;
                                      <?php echo $row['name'] ?>
                                    </h5>
                                  </div>
                                  <div class="col-6">
                                    <h5><i class="ti-headphone-alt"></i>&nbsp;&nbsp;
                                      <?php echo $row['phone'] ?>
                                    </h5>
                                  </div>
                                  <div class="col-6 mt-3">
                                    <h5><i class="ti-wheelchair"></i>&nbsp;&nbsp;
                                      <?php echo $row['disease'] ?>
                                    </h5>
                                  </div>
                                  <?php  
                                  if ($row['address']){    ?>
                                  <div class="col-6 mt-3">
                                    <h5><i class="ti-location-pin"></i>&nbsp;&nbsp;
                                      <?php echo $row['address'] ?>
                                    </h5>
                                  </div>
                                  <?php }
                                   if ($row['message']){    ?>
                                  <div class="col-6 mt-3">
                                    <h5><i class="ti-comment"></i>&nbsp;&nbsp;
                                      <?php echo $row['message'] ?>
                                    </h5>
                                  </div>
                                  <?php  }
                                  
                                  if ($row['other']){    ?>
                                  <div class="col-6 mt-3">
                                  <h5><i class="ti-support"></i>&nbsp;&nbsp;<?php echo $row['other'] ?> </h5>
                                    
                                  </div>
                                  <?php  }

                                  if ($row['sources']){    ?>
                                    <div class="col-6 mt-3">
                                    <h5><i class="ti-direction"></i>&nbsp;&nbsp;<?php echo $row['sources'] ?> </h5>
                                      
                                    </div>
                                    <?php  }
                                      
                                        ?>
                                      

                                </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        <!--details Modal End -->

                        <?php    }      ?>


                      </tbody>
                    </table>
                                  </form>
                  </div>
                  <br>

                  <div class="card">
                    <div class="row">
                      <div class="col-6">
                  
                    <ul class="pagination mt-5 ml-5">
                    <?php 
                    if(isset($_GET['start'])){
                      $start=$_GET['start'];
                      if($start==0){
                        die();
                      }
                    }
                    else{
                      $start=1;
                    }

                  
                        ?>
                    <li class="page-item <?php if($start==1){ echo"d-none"; }?>">
                      <a class="page-link ti-angle-double-left" href="?start=<?php echo $start-1;?>" aria-label="Previous" >
                      </a>
                    </li>
                    <?php ?>

                      <li class="page-item active"><p class="page-link">
                          <?php echo $start;    ?>
                  </p></li>
                      
                    <li class="page-item <?php if($start== $pagi){ echo"d-none"; }?>">
                      <a class="page-link ti-angle-double-right" href="?start=<?php echo $start+1;?>" aria-label="Next">
                      </a>
                    </li>
                    <?php
                     
                      ?>
                    </ul>

                    </div>
                     <div class="col-6  mt-5 text-right">
                    <form method="POST">
                      <select name="perpage" id="">
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                      </select>

                      <button type="submit" name="okey" class="badge badge-primary btn-icon-text">
                        Okey
                      </button>
                  </form>
                </div>

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
        <!-- partial footer end -->
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
  <script>
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

    window.setTimeout(function () {
      $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
      });
    }, 4000);
  </script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->



</body>

  <!-- Deletion Code -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
function select_all(){
	if(jQuery('#delete').prop("checked")){
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',true);
		});
	}else{
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',false);
		});
	}
}


function delete_all(){
	var check=confirm("Are you sure?");
	if(check==true){
		jQuery.ajax({
      type:'post',
			data:jQuery('#frm').serialize(),
      success:function(result){
				jQuery('input[type=checkbox]').each(function(){
					if(jQuery('#'+this.id).prop("checked")){
						jQuery('#box'+this.id).remove();
					}
				});
			}

		});
    <?php
        include('../../dbcon.php');
        if(isset($_POST['checkbox'][0])){
	      foreach($_POST['checkbox'] as $list){
		    $id=mysqli_real_escape_string($conn,$list);

        //deleting report
        $forreport = mysqli_query($conn,"SELECT * FROM  patients WHERE sr=$id");
        $row1= mysqli_fetch_array($forreport);
        if($row1['report1']){  
        $reports1='../../'.$row1['report1'];
        unlink($reports1);
        }
        if($row1['report2']){
        $reports2='../../'.$row1['report2'];
        unlink($reports2);
        }
        if($row1['report3']){
        $reports3='../../'.$row1['report3'];
        unlink($reports3);
        }
        if($row1['report4']){
        $reports4='../../'.$row1['report4'];
        unlink($reports4);
        }
        
        //deleting selected row
		    $sql=mysqli_query($conn,"delete from patients where sr='$id'");   

	}
  
}
?>
	}
  location.reload(true);
}

  </script>
  <!-- Deletion Code end -->


</html>

<?php
   }
?>