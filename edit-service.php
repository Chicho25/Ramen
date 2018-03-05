<?php 

    ob_start();
    $countryclass="class='active'";
    $editServclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User") 
     {
          header("Location: index.php");
          exit;
     }
     $message="";
    if(isset($_POST['submitUser']) && $_REQUEST['id'] > 0)
     {
        
          $stval = (isset($_POST['status'])) ? 1 : 0;
          $arrVal = array(
                        "description" => $description,
                        "price" => $price,
                        "tax" => $tax,
                        "thirdparty" => $thirdparty,
                        "stat" => $stval
                       );
          
          UpdateRec("service", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Service updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("service", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';

?>
  <?php 
      $bcName = "Edit Country";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Country</h5>
                    </div>
                    <div class="ibox-content">
                     <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Description</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['description']?>" placeholder="Description" name="description" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Price</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" value="<?php echo $arrUser['price']?>" placeholder="Price" name="price" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Tax</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" required="" name="tax">
                                    <option value="1" <?php echo $a=($arrUser['tax'] == 1) ? 'selected' : ''?>>Yes</option>
                                    <option value="0" <?php echo $a=($arrUser['tax'] == 0) ? 'selected' : ''?>>No</option> 
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-4 text-right control-label font-bold">Third Party Id</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['thirdparty']?>"  placeholder="Third Party Id" name="thirdparty" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                            <div class="col-lg-4">
                                <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
                                
                            </div>

                          </div>  

                          <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">  
                                        <button class="btn btn-primary" name="submitUser" type="submit">Update</button>
                                        <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                                    </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show().attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
<?php    
  include("footer.php"); 
?> 