<?php 

    ob_start();
    $craneclass="class='active'";
    $Termsclass="class='active'";
    
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
                        "description" => $terms
                       );

          if(RecCount("terms", "1=1") == 0)
          {
            $nId = InsertRec("terms", $arrVal);    
            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Terms and Condition created successfully</strong>
                    </div>';
          }
          else
          {
            UpdateRec("terms", "1=1", $arrVal);
            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Terms and Condition updated successfully</strong>
                    </div>';
          }
          
        
          
        
     }
?>
  <?php 
      $bcName = "Terms and Condition";
      include("breadcrumb.php") ;
      $arrData = GetRecord("terms", "1=1");
      $terms = (isset($arrData['description'])) ? $arrData['description'] : '';
     
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Terms and Condition</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-sm-12 text-center">Set the text to be displayed on Your Terms and Condition Documents.</label>
                            <div class="col-sm-5 m-l-sm alert alert-warning">Enclose text in [brackets] to make it appear bold on Printouts</div>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="terms" required="required"  ><?php echo $terms?></textarea>     
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