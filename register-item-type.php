<?php 

    ob_start();
    $inventoryclass="class='active'";
    $registerItemTypeclass="class='active'";
    
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
                        "stat" => 1
                       );

          $nId = InsertRec("item_types", $arrVal);    

          if($nId > 0)
          {
              
              echo '<script>
                              alert("Item type saved successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';

              
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Type created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Item Type";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Item Type</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Description</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="description">                        
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