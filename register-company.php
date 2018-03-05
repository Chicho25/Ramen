<?php 

    ob_start();
    $countryclass="class='active'";
    $registerCompclass="class='active'";
    
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
                        "name" => $cname,
                        "phone" => $phone,
                        "address1" => $address1,
                        "address2" => $address2,
                        "country" => $country,
                        "province" => $province,
                        "city" => $city,
                        "thirdparty" => $thirdparty,
                        "smtp" => $smtp,
                        "port" => $port,
                        "sslOption" => $ssl,
                        "subject" => $subject,

                        "stat" => 1,"created_on" => date("Y-m-d h:i::s")
                       );

          
          $nId = InsertRec("company", $arrVal);    

          if($nId > 0)
          {
              
              if(isset($_FILES['document']) && $_FILES['document']['tmp_name'] != "")
              {
                  $target_dir = "companylogo/";
                  $target_file = $target_dir . basename($_FILES["document"]["name"]);
                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                  $filename = $target_dir . $nId.".".$imageFileType;
                  $filenameThumb = $target_dir . $nId."_thumb.".$imageFileType;
                  if (move_uploaded_file($_FILES["document"]["tmp_name"], $filename)) 
                  {
                      makeThumbnailsWithGivenWidthHeight($target_dir, $imageFileType, $nId, 100, 100);
                      $arrDocument = array("id_company" => $nId, "name" => $target_file, "path" => $filenameThumb, "createdOn" => date("Y-m-d h:i:s"));
                      InsertRec("company_logo", $arrDocument);    
                  }
              }

             

               echo '<script>
                              alert("Company created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Company not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Employee";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Employee</h5>
                    </div>
                    <div class="ibox-content">
                      <form class="form-horizontal" data-validate="parsley" id="frmEmployee" method="post"   enctype="multipart/form-data">
                        <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                        <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-1">Details</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-2">Logo</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-3">Outbound Mail</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <?php 
                                              $name = "";
                                              $phone = "";
                                              $address1 = "";
                                              $address2 = "";
                                              $country = "";
                                              $province = "";
                                              $city = "";
                                              $thirdparty  = "";
                                              
                                              include("company-detail.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                            	$compid= 0;
                                              include("company-logo.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <?php 
                                              $smtp = "";
                                              $port = "";
                                              $ssl = "";
                                              $subject = "";

                                              include("company-outbound-mail.php"); 
                                            ?>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-4 m-t-sm col-sm-offset-4">
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