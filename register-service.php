<?php 

    ob_start();
    $countryclass="class='active'";
    $registerServclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID'])) 
     {
          header("Location: index.php");
          exit;
     }
     $message="";

    if(isset($_POST['submitUser']))
     {       
        
          $arrVal = array(
                        "description" => $description,
                        "price" => $price,
                        "tax" => $tax,
                        "thirdparty" => $thirdparty,
                        "stat" => 1
                       );

          $nId = InsertRec("service", $arrVal);    

          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Service created successfully</strong>
                    </div>';
              echo '<script>
                              alert("Service created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Service not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Service";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Service</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Descripton</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Descripton" name="description" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Price</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Price" name="price" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Tax</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" required="" name="tax">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option> 
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-4 text-right control-label font-bold">Third Party Id</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  placeholder="Third Party Id" name="thirdparty" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary" name="submitUser" type="submit">Save</button>
                                <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    
<?php    
	include("footer.php"); 
?> 