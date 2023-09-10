<?php 
 session_start();
 if (!isset($_SESSION['sr'])) {
     header('location: ../../index.php');
   }
   else{
      include "../../dbcon.php";
      $sr6=$_SESSION['sr'];
      $sql6=mysqli_query($conn,"SELECT * from user WHERE sr=$sr6 ");
      $row6 = mysqli_fetch_assoc($sql6);
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
        if($row6['crm']=='yes'){
        ?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Follow Up</h4>
                  
                  <div class="row mb-4">
                
                
                  <div class="col-12 text-right">
                  
                  
                    <form method="POST">
                      <input type="date" name="followdate">
                      <button type="submit" name="filter" class="badge badge-primary">
                        Check Followup
                      </button>
                      <button type="submit" name="reset" class="badge badge-danger">
                        Reset
                      </button>
                  </form>
                </div>
                
                
</div>

                  <!-- <p class="card-description">Add class <code>.table</code></p> -->
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sr</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Remark</th>
                          <th>Category</th>
                          <th>Whatsapp</th>
                          <th>Edit</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          include "../../dbcon.php";

                          date_default_timezone_set('Asia/Kolkata');
                          $today= date('Y-m-d');


                          //Filter section Start
                            if(isset($_POST['filter'])){
                              $followdate=$_POST['followdate']; 
                              $sub_sql= "WHERE campion=1 && followdate ='$followdate' ";
                              $_SESSION['followdate']=$sub_sql;

                            }
                            
                            if(!isset($_SESSION['followdate']) || isset($_POST['reset'])){
                              $_SESSION['followdate']="WHERE campion=1 && followdate ='$today'";
                              }
                      
                            $daterange=$_SESSION['followdate'];

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
                              <a class="badge badge-success p-1" data-toggle="modal"
                                data-target="#report<?php echo $row['sr'] ?>" style="font-size: 10px;"
                                href="">report</a>
                            </p>
                            <?php }   ?>

                          </td>
                          <td><?php echo $row['phone'] ?></td>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="report<?php echo $row['sr'] ?>" tabindex="1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header mr-3 p-2">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                      aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body col-12">
                                  <img style="width: 450px;  height: auto;" src="<?php echo " ../../".$row['report1']
                                    ?>">
                                  <?php  if ($row['report2']){    ?>
                                  <img style="width: 450px;  height: auto;" src="<?php echo " ../../".$row['report2']
                                    ?>">
                                  <?php }   ?>
                                  <?php  if ($row['report3']){    ?>
                                  <img style="width: 450px;  height: auto;" src="<?php echo " ../../".$row['report3']
                                    ?>">
                                  <?php }   ?>
                                  <?php  if ($row['report4']){    ?>
                                  <img style="width: 450px;  height: auto;" src="<?php echo " ../../".$row['report4']
                                    ?>">
                                  <?php }   ?>
                                </div>
                              </div>

                            </div>
                          </div>

                          <!-- <div id="report<?php echo $row['sr'] ?>" class="modal fade" >
                        <div class=" modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img style="height: 500px; border-radius: 0px; width: auto; " id="1"src="../../<?php echo $row['report'] ?>" >
                                </div>
                            </div>
                        </div>
                    </div>    -->
                          <!--End Modal -->

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
                          <td class="">
                            <a style="text-decoration: none;" href="https://wa.me/91<?php echo $row['phone']; ?>?text=Hi%2C%20thanks%20for%20contacting%20us.%0AWelcome%20to%20BK%20Arogyam.%20Please%20send%20your%20latest%20report%20of%20your%20problem%20(if%20you%20have)%2C%20than%20we%20will%20contact%20you%20shortly.%0AFor%20more%20information%20visit%3A%20bkarogyam.com" target="_blank" >
                              <img style="height: 30px; width: auto;" src="../../images/icon/whatsapp.png" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                              <p class="mx-3">
                                <?php echo $row['remark1'] ?><br>
                                <?php echo $row['remark2'] ?><br>
                                <?php echo $row['remark3']  ?><br>
                                <?php echo($row['remark4']) ?>
                              </p>
                            </div>
                          </td>


                          <td>
                            <a class="badge badge-primary" data-toggle="modal"
                              data-target="#myModal<?php echo $row['sr'] ?>" href="#"><i
                                class="ti-pencil"></i>&nbsp;&nbsp;Edit</a>
                          </td>
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
                                  <?php  if ($row['address']){    ?>
                                  <div class="col-6 mt-3">
                                    <h5><i class="ti-location-pin"></i>&nbsp;&nbsp;
                                      <?php echo $row['address'] ?>
                                    </h5>
                                  </div>
                                  <?php  }
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
                                  


                                  <!-- Flaxible Remrk Start -->
                                  <?php if(!$row['remark1']){ }  
 elseif($row['remark1'] && !$row['remark2']){ ?>
                                  <div class="col-12 mt-3" >
                                    <h5 style="color: #d35100;"><i class="ti-pin"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php }  
   elseif($row['remark1'] && $row['remark2']  && !$row['remark3'] ){ ?>
                                  <div class="col-12 mt-3" >
                                    <h5 style="color: #d35100;"><i class="ti-pin"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark2'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php }  
   elseif($row['remark1'] && $row['remark2'] && $row['remark3'] && !$row['remark4'] ){ ?>
                                  <div class="col-12 mt-3">
                                    <h5 style="color: #d35100;"><i class="ti-pin"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark3'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark2'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php } 
  else{ ?>
                                  <div class="col-12 mt-3">
                                    <h5 style="color: #d35100;"><i class="ti-receipt"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark4'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark3'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark2'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php }  
                                  //  Flaxible Remark End 

                                  if ($row['followdate']){    ?>
                                  <div class="col-12 mt-3">
                                    <h5><i class="ti-time"></i>&nbsp;&nbsp;Follow up:&nbsp;
                                    <?php
                                    $date1=$row['followdate'];
                                    $dat1=explode("-",$date1);
                                    $followupdate=$dat1['2'].'-'.$dat1['1'].'-'.$dat1['0'];
                                    echo $followupdate; ?>  
                                  </h5>
                                  </div>
                                  <?php  } ?>

                                </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        <!--details Modal End -->



                        <!-- Updation form Start Here -->
                        <?php   
                      $statelist = array("Andhra Pradesh",
                      "Andaman and Nicobar Islands",
                      "Arunachal Pradesh",
                      "Assam",
                      "Bihar",
                      "Chandigarh",
                      "Chhattisgarh",
                      "Dadra and Nagar Haveli",
                      "Daman and Diu",
                      "Delhi",
                      "Lakshadweep",
                      "Puducherry",
                      "Goa",
                      "Gujarat",
                      "Haryana",
                      "Himachal Pradesh",
                      "Jammu and Kashmir",
                      "Jharkhand",
                      "Karnataka",
                      "Kerala",
                      "Madhya Pradesh",
                      "Maharashtra",
                      "Manipur",
                      "Meghalaya",
                      "Mizoram",
                      "Nagaland",
                      "Odisha",
                      "Punjab",
                      "Rajasthan",
                      "Sikkim",
                      "Tamil Nadu",
                      "Telangana",
                      "Tripura",
                      "Uttarakhand",
                      "Uttar Pradesh",
                      "West Bengal",
                      );
                     
                      $medialist=array('Facebook','Youtube','Google','Whatsapp','Phone call','instagram','Quora','Campion','Website','Other');

                      $categorylist=array('Hot','Warm','Cold','Close','Converted');

                      $diseaselist= array('Kidney','Heart','Diabetes','Protein loss','Kidney Stone','Other');

                      ?>
                        <!-- Modal Start -->
                        <div class="modal fade" id="myModal<?php echo $row['sr'] ?>" tabindex="-1" role="dialog"
                          aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-md" role="document">
                            <div class=" border-redi modal-content">
                              <div class="modal-header py-2 my-1">

                                <h4 class="modal-title" id="myModalLabel">Remark</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body mt-3 pt-0">

                              <!-- Flaxible Form according to remrk -->
                                <!-- <div class="row">
            
                                  <?php if(!$row['remark1']){ }  
 elseif($row['remark1'] && !$row['remark2']){ ?>
                                  <div class="col-12 mt-3" >
                                    <h5 style="color: #d35100;"><i class="ti-pin"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php }  
   elseif($row['remark1'] && $row['remark2']  && !$row['remark3'] ){ ?>
                                  <div class="col-12 mt-3" >
                                    <h5 style="color: #d35100;"><i class="ti-pin"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark2'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php }  
   elseif($row['remark1'] && $row['remark2'] && $row['remark3'] && !$row['remark4'] ){ ?>
                                  <div class="col-12 mt-3">
                                    <h5 style="color: #d35100;"><i class="ti-pin"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark3'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark2'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>
                                    </ul>
                                  </div>
                                  <?php } 
  else{ ?>
                                  <div class="col-12 mt-3">
                                    <h5 style="color: #d35100;"><i class="ti-receipt"></i>&nbsp;&nbsp;Old Remark</h5>
                                  </div>
                                  <div class="col-12" style="color: #853300;">
                                    <ul>
                                      <li>
                                        <?php echo $row['remark4'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark3'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark2'] ?>
                                      </li>
                                      <li>
                                        <?php echo $row['remark1'] ?>
                                      </li>

                                    </ul>
                                  </div>
                                  <?php }  ?>

                                </div> -->

                                    <!-- Contact Form -->

                                <form id="contact_form" name="contact_form" method="POST" enctype="multipart/form-data">
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label for="form_name">Name <small>*</small></label>
                                        <input id="form_name" name="name" class="form-control" type="text"
                                          value="<?php echo $row['name'] ?>" required>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_name">Disease <small>*</small></label>
                                        <select id="form_subject" name="disease" class="form-control required"
                                          type="text" required>
                                          <option value="" selected disabled>Select State</option>

                                          <?php      foreach($diseaselist as $disease){
              $type="";
              if($row['disease']==$disease){$type="selected";}
              echo "<option value='".$disease."'".$type.">".$disease."</option>";
            }     ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_address">Address</label>
                                        <select class="form-control" name="address" type="text" required>
                                          <option value="" selected disabled>Select State</option>

                                          <?php      foreach($statelist as $state){
                      $type="";
                      if($row['address']==$state){$type="selected";}
                      echo "<option value='".$state."'".$type.">".$state."</option>";
                    }     ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_phone">Other Problem</label>
                                        <input id="form_phone" name="other" class="form-control" type="text"
                                          value="<?php echo $row['other'] ?>">
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_phone">Category</label>
                                        <select class="form-control" name="category" type="text" required>
                                          <option value="" selected disabled>Select Category</option>

                                          <?php      foreach($categorylist as $category){
                                          $type="";
                                          if($row['category']==$category){$type="selected";}
                                          
                                          echo "<option value='".$category."'".$type.">".$category."</option>";

                    }     ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_phone">Follow Up</label>
                                        <input id="form_phone" name="followup" class="form-control" type="date" value="">
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="form_phone">Amount</label>
                                        <input id="form_phone" name="amount" class="form-control" type="number" value="<?php echo $row['amount'] ?>">
                                      </div>
                                    </div>
                                  </div>

                                  <?php  
                      if(!$row['remark1']){  ?>

                                  <div class="form-group">
                                    <label for="form_name">Remark</label>
                                    <input id="form_message" name="remark1" class="form-control" type="text" required>
                                  </div>
                                  <?php }
                      elseif($row['remark1'] && !$row['remark2']){ ?>

                                  <div class="form-group">
                                    <label for="form_name">Remark</label>
                                    <input id="form_message" name="remark2" class="form-control" type="text" required>
                                  </div>

                                  <?php         }
                      elseif($row['remark1'] && $row['remark2'] && !$row['remark3']) {?>

                                  <div class="form-group">
                                    <label for="form_name">Remark</label>
                                    <input id="form_message" name="remark3" class="form-control" type="text" required>
                                  </div>

                                  <?php   }
                      else{ ?>

                                  <div class="form-group">
                                    <label for="form_name">Remark</label>
                                    <textarea id="form_message" name="remark4" class="form-control required" rows="4"
                                      required><?php echo $row['remark4'] ?></textarea>
                                  </div>

                                  <?php }   ?>

                                  <div class="col-sm-12" <?php if($row["report4"]){?> style="display:none;" <?php } ?> >
                                    <div class="form-group" id="img">
                                      <label for="form_name">Upload Report :

                                        <?php if(!$row["report1"]){?>
                                          <i>(only 4 image)</i>
                                          <?php } 
                                        elseif($row["report1"]  && !$row["report2"]){    ?>
                                        <i>(only 3 image)</i>
                                          <?php } 
                                        elseif($row["report1"] && $row["report2"]  && !$row["report3"]){    ?>
                                        <i>(only 2 image)</i>
                                          <?php } 
                                        elseif($row["report1"] && $row["report2"]  && $row["report3"] && !$row["report4"]){    ?>
                                        <i>(only 1 image)</i>
                                          <?php } ?>            

                                        </label>
                                      <input id="img" type="file" name="img[]" multiple><span id="img" class="formerror" style="color: red">
                                      </span>
                                    </div>
                                  </div>


                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <input id="form_botcheck" name="form_botcheck" class="form-control"
                                          type="hidden" value="" />
                                        <button name="submit" type="submit" value="<?php echo $row['sr'] ?>"
                                          style="float: right;"
                                          class="btn btn-success btn-theme-colored btn-flat">Submit</button>
                                      </div>
                                    </div>
                                    <br>

                                </form>
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- Modal End -->

                        <?php    }      ?>

                        <!-- Updation form End Here-->


                      </tbody>
                    </table>
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





  <?php

include "../../dbcon.php";
                  
//Updation Code START

if (isset($_POST["submit"])) {

      $sr=$_POST["submit"];
      $name=$_POST["name"];
      $disease=$_POST["disease"];
      $address=$_POST["address"];
      $category=$_POST["category"];
      $other=$_POST["other"];
      $followup=$_POST["followup"];
      // $datetime= explode('T',$followup);
      // $followdate= $datetime[0];
      // $followtime= $datetime[1];
      $amount=$_POST["amount"];
      
      date_default_timezone_set('Asia/Kolkata');
      $time= date('dMY g:i');

    
      if (isset($_FILES['img']['name'])) {
 //image subm
 $file[0]="";
 $file[1]="";
 $file[2]="";
 $file[3]="";

$table= "SELECT * FROM  patients where sr=$sr";
$result =mysqli_query($conn,$table);
while ($row= mysqli_fetch_array($result)) {
  if(!$row["report1"]){ $number=5; }
  elseif($row["report1"]  && !$row["report2"]){ $number=4; }
  elseif($row["report1"] && $row["report2"]  && !$row["report3"]){ $number=3; }
  elseif($row["report1"] && $row["report2"]  && $row["report3"] && !$row["report4"]){ $number=2; }
  else{ $number=1; }
}

if(count($_FILES['img']['name'])< $number){
 
foreach($_FILES['img']['name'] as $key=>$val){

    $filename= $_FILES['img']['name'][$key];
    $tempname= $_FILES['img']['tmp_name'][$key];
    $size=$_FILES['img']['size'][$key];
                          
    $extention= pathinfo($filename,PATHINFO_EXTENSION);
    $filenm= pathinfo($filename,PATHINFO_FILENAME);
    $filenameok= $filenm.date("mjYHis").'.webp';
    $output= '../../static/images/report/'.$filenameok;
    $store='static/images/report/'.$filenameok;
    $file[$key]=$store;
    $array= array('png','jpeg','jpg');
    
           
    if (in_array($extention, $array)) {
                          
        //file size declear in bites
        if($size<5242880){
                                              
            $image = imagecreatefromstring(file_get_contents($tempname));
            ob_start();
            imagejpeg($image,NULL,100);
            $cont = ob_get_contents();
            ob_end_clean();
            imagedestroy($image);
            $content = imagecreatefromstring($cont);
            $upload= imagewebp($content,$output);
            imagedestroy($content);
           //  echo '<h4>WEBP Image Converted Successfully</h4>';

           
            if($number==5){ 
              $updateimg=mysqli_query($conn,"UPDATE patients SET `report1`='$file[0]',`report2`='$file[1]',`report3`='$file[2]',`report4`='$file[3]' WHERE sr=$sr ");
             }
            elseif($number==4){ 
              $updateimg=mysqli_query($conn,"UPDATE patients SET report2='$file[0]', report3='$file[1]', report4='$file[2]' WHERE sr=$sr ");
             }
            elseif($number==3){ 
              $updateimg=mysqli_query($conn,"UPDATE patients SET report3='$file[0]', report4='$file[1]' WHERE sr=$sr ");
             }
            elseif($number==2){ 
              $updateimg=mysqli_query($conn,"UPDATE patients SET report4='$file[0]' WHERE sr=$sr ");
             }
            else{  } 

}
else{
    echo "Please select image less then 5MB";
    }
  }
// else{
//   echo "<script>   alert('you can upload only".--$number." images Only');  </script>";
//    } 
  }
}
  else{
     echo "Please select image in jpg, jpeg, png format";
      }
    }


        if (isset($_POST["remark1"])) {
        $remark1=$_POST["remark1"]." ".$time;
        $update=mysqli_query($conn,"UPDATE patients SET name='$name', disease='$disease', address='$address',  category='$category', other='$other', remark1='$remark1', followdate='$followup', amount='$amount' WHERE sr=$sr ");
      }
      elseif (isset($_POST["remark2"])) {
        $remark2=$_POST["remark2"]." ".$time;
        $update=mysqli_query($conn,"UPDATE patients SET name='$name', disease='$disease', address='$address',  category='$category', other='$other', remark2='$remark2', followdate='$followup', amount='$amount' WHERE sr=$sr ");
      }
      elseif (isset($_POST["remark3"])) {
        $remark3=$_POST["remark3"]." ".$time;
        $update=mysqli_query($conn,"UPDATE patients SET name='$name', disease='$disease', address='$address',  category='$category', other='$other', remark3='$remark3', followdate='$followup', amount='$amount' WHERE sr=$sr ");
      }
      else{
        $remark4=$_POST["remark4"]." ".$time;
        $update=mysqli_query($conn,"UPDATE patients SET name='$name', disease='$disease', address='$address',  category='$category', other='$other', remark4='$remark4', followdate='$followup', amount='$amount' WHERE sr=$sr ");
      }
  
    if ($update) {
      echo '<meta http-equiv="refresh" content="0" />';
       }
      else{
            echo '<script>
              alert("Updation Failed");
            </script>';
      
  
}
}

?>


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

</html>

<?php
   }
?>