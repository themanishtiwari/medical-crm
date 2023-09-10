
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
      <!-- partial -->
      <?php 
      include "../../dbcon.php";
      if (isset($_POST['submit'])) {
      $sr=$_POST['submit'];
      $query = "SELECT * FROM patients where sr=$sr";
      $show = mysqli_query($conn,$query);
      $row= mysqli_fetch_array($show);
?>
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
                  <?php } ?>
                  
                </div>
              </div>
            </div>
              <!-- first Remark -->
            <?php 
              if(!$row['remark1']){  
            ?>
            
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                
                  <h4 class="card-title">Form</h4>
                  <form class="form-sample" method="POST" action="update.php">
                                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                          <input class="form-control" name="address" value="<?php echo $row['address'] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Other Problem</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="other" value="<?php echo $row['other'] ?>" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="category" type="text"  required>
                            <option value="<?php echo $row['category'] ?>" selected><?php echo $row['category'] ?></option>
                            <option value="Hot">Hot</option>
                            <option value="Warm">Warm</option>
                            <option value="Cold">Cold</option>
                            <option value="Closed">Closed</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Remark</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="remark1" value="" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2" value="<?php echo $row['sr'] ?>">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-2"></div>


              <!-- Second Remark -->
              <?php }
              elseif($row['remark1'] && !$row['remark2']){  ?>
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Old Remark</h4>
                  <div style="font-size: 15px; line-height: 2;">
                  <?php echo " ".$row['remark1'] ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                
                  <h4 class="card-title">Form</h4>
                  <form class="form-sample" method="POST" action="update.php">
                                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                          <input class="form-control" name="address" value="<?php echo $row['address'] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Other Problem</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="other" value="<?php echo $row['other'] ?>" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="category" type="text"  required>
                            <option value="<?php echo $row['category'] ?>" selected><?php echo $row['category'] ?></option>
                            <option value="Hot">Hot</option>
                            <option value="Warm">Warm</option>
                            <option value="Cold">Cold</option>
                            <option value="Closed">Closed</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Remark</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="remark2" value="" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit2" class="btn btn-primary mr-2" value="<?php echo $row['sr'] ?>">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-2"></div>




              <!-- first Remark -->
              <?php 
            }
              elseif($row['remark1'] && $row['remark2'] && !$row['remark3']) {   ?>
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Old Remark</h4>
                  <div style="font-size: 15px; line-height: 2;">
                  <?php echo " ".$row['remark1'] ?><br>
                  <?php echo " ".$row['remark2'] ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                
                  <h4 class="card-title">Form</h4>
                  <form class="form-sample" method="POST" action="update.php">
                                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                          <input class="form-control" name="address" value="<?php echo $row['address'] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Other Problem</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="other" value="<?php echo $row['other'] ?>" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="category" type="text"  required>
                            <option value="<?php echo $row['category'] ?>" selected><?php echo $row['category'] ?></option>
                            <option value="Hot">Hot</option>
                            <option value="Warm">Warm</option>
                            <option value="Cold">Cold</option>
                            <option value="Closed">Closed</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Remark</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="remark3" value="" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit3" class="btn btn-primary mr-2" value="<?php echo $row['sr'] ?>">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-2"></div>



              <!-- first Remark -->
              <?php }
              else{   ?>
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Old Remark</h4>
                  <div style="font-size: 15px; line-height: 2;">
                  <?php echo " ".$row['remark1'] ?><br>
                  <?php echo " ".$row['remark2'] ?><br>
                  <?php echo " ".$row['remark3'] ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-8 grid-margin">
              <div class="card">
                <div class="card-body">
                
                  <h4 class="card-title">Form</h4>
                  <form class="form-sample" method="POST" action="update.php">
                                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                          <input class="form-control" name="address" value="<?php echo $row['address'] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Other Problem</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="other" value="<?php echo $row['other'] ?>" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="category" type="text"  required>
                            <option value="<?php echo $row['category'] ?>" selected><?php echo $row['category'] ?></option>
                            <option value="Hot">Hot</option>
                            <option value="Warm">Warm</option>
                            <option value="Cold">Cold</option>
                            <option value="Closed">Closed</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Remark</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="remark4" value="" rows="3" required /><?php echo " ".$row['remark4'] ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit4" class="btn btn-primary mr-2" value="<?php echo $row['sr'] ?>">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-2"></div>
            <?php }  ?>



                
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
