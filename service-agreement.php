<?php 

    ob_start();
    $craneclass="class='active'";
    $serviceAggclass="class='active'";
    
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
                        "customtext" => $customtext,
                        "label" => $label,
                        "pricenote1" => $pricenote1,
                        "pricenote2" => $pricenote2,
                        "signHeader" => $signatureheader,
                        "signFooter" => $signaturefooter
                       );

          if(RecCount("service_agreement", "1=1") == 0)
          {
            $nId = InsertRec("service_agreement", $arrVal);    
            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Service Agreement created successfully</strong>
                    </div>';
          }
          else
          {
            UpdateRec("service_agreement", "1=1", $arrVal);
            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Service Agreement updated successfully</strong>
                    </div>';
          }
          
        
          
        
     }
?>
  <?php 
      $bcName = "Service Agreement";
      include("breadcrumb.php") ;
      $arrData = GetRecord("service_agreement", "1=1");
      $ctext = (isset($arrData['customtext'])) ? $arrData['customtext'] : '';
      $label = (isset($arrData['label'])) ? $arrData['label'] : '';
      $pricenote1 = (isset($arrData['pricenote1'])) ? $arrData['pricenote1'] : '';
      $pricenote2 = (isset($arrData['pricenote2'])) ? $arrData['pricenote2'] : '';
      $signHeader = (isset($arrData['signHeader'])) ? $arrData['signHeader'] : '';
      $signFooter = (isset($arrData['signFooter'])) ? $arrData['signFooter'] : '';
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Service Agreement</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-sm-12 text-left">Set the text to be displayed on Your Service Agreement.You can customize as many different Service Agreement as you need.</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="customtext" required="required"  ><?php echo $ctext?></textarea>     
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-12 text-left font-bold">Label</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" required="" value="<?php echo  $label?>" name="label" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-12 text-left">Price Note 1.</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="pricenote1" required="required"  ><?php echo $pricenote1?></textarea>     
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-12 text-left">Price Note 2.</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="pricenote2" placeholder="Prices are subject to equipment availability at the time the order is received." required="required"  ><?php echo $pricenote2?></textarea>     
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-12 text-left">Signature Header</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="signatureheader" placeholder="Please sign and return to Service Providor" required="required"  ><?php echo $signHeader?></textarea>     
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-12 text-left">Signature Footer</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="signaturefooter" required="required"  ><?php echo $signFooter?></textarea>     
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