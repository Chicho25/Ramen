<?php 

    ob_start();
    $countryclass="class='active'";
    $registerEmpclass="class='active'";
    
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
          $craneoperator = (isset($craneoperator)) ? 1 : 0;
          $qlfcertified1 = (isset($qlfcertified1)) ? 1 : 0;
          $qlfsignalperson = (isset($qlfsignalperson)) ? 1 : 0;
          $qlfcertified2 = (isset($qlfcertified2)) ? 1 : 0;
          $qlfrigger = (isset($qlfrigger)) ? 1 : 0;
          $qlfcertified3 = (isset($qlfcertified3)) ? 1 : 0;
          $qlfmechanic = (isset($qlfmechanic)) ? 1 : 0;
          $qlfelectromechanic = (isset($qlfelectromechanic)) ? 1 : 0;
          $qlfinspector = (isset($qlfinspector)) ? 1 : 0;
          $salesperson = (isset($salesperson)) ? 1 : 0;
          $driver = (isset($driver)) ? 1 : 0;

          $arrVal = array(
                        "idcard" => $idcard,"firstname" => $fname,"lastname" => $lname,"jobtitle" => $jobtitle,
                        "cellno" => $cellphone,"email" => $email, "thirdparty" => $thirdparty,
                          
                         "craneoperator" => $craneoperator, "qlfcertified1" => $qlfcertified1, "certificationdate1" => $certificationdate1, "expirationdate1" => $expirationdate1, "qlfsignalperson" => $qlfsignalperson, "qlfcertified2" => $qlfcertified2, "certificationdate2" => $certificationdate2, "expirationdate2" => $expirationdate2, "qlfrigger" => $qlfrigger, "qlfcertified3" => $qlfcertified3, "certificationdate3" => $certificationdate3, "expirationdate3" => $expirationdate3, "qlfmechanic" => $qlfmechanic, "qlfelectromechanic" => $qlfelectromechanic, "qlfinspector" => $qlfinspector, 

                        "hourly_bare" => $hourly,"daily_bare" => $daily,
                        "weekly_bare" => $weekly,"monthly_bare" => $monthly,"yearly_bare" => $yearly,
                        "overtime_bare" => $overtime,"doubletime_bare" => $doubletime,"traveltime_bare" => $traveltime,
                        "dailyminimum_bare" => $dailyminimu,"projectminimum_bare" => $projectminimu,
                        
                         "salesperson" => $salesperson, "commission" => $commission,

                         "driver" => $driver, "licensenumber" => $licensenumber,"licenseclass" => $licenseclass, "licenseexpire" => $licenseexpire,

                        "stat" => 1,"created_on" => date("Y-m-d h:i::s")
                       );

          // echo "<pre>";
          // print_r($arrVal);
          // exit;  
          $nId = InsertRec("employee", $arrVal);    

          if($nId > 0)
          {
              
              if(isset($_FILES['document']) && $_FILES['document']['tmp_name'] != "")
              {
                  $target_dir = "employeedocuments/";
                  $target_file = $target_dir . basename($_FILES["document"]["name"]);
                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                  $filename = $target_dir . $nId.".".$imageFileType;
                  $filenameThumb = $target_dir . $nId."_thumb.".$imageFileType;
                  if (move_uploaded_file($_FILES["document"]["tmp_name"], $filename)) 
                  {
                      makeThumbnailsWithGivenWidthHeight($target_dir, $imageFileType, $nId, 100, 100);
                      $arrDocument = array("id_employee" => $nId, "name" => $target_file, "path" => $filenameThumb, "createdOn" => date("Y-m-d h:i:s"));
                      InsertRec("employee_document", $arrDocument);    
                  }
              }

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Employee created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Employee created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Employee not created</strong>
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
                                        <li class="active"><a data-toggle="tab" href="#tab-1" onclick="checkQlf()">Details</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-2" onclick="checkQlf()">Qualifications</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-3" onclick="checkQlf()">Labor Rates</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-4" onclick="checkQlf()">Sales Person</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-5" onclick="checkQlf()">Driver Information</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-6" onclick="checkQlf()">Documents</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <?php 
                                              $idcard = "";
                                              $fname = "";
                                              $lname = "";
                                              $jobtitle = "";
                                              $cellphone = "";
                                              $email = "";
                                              $thirdparty  = "";
                                              
                                              include("employee-detail.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                              $craneoperator = "";
                                              $qlfcertified1 = "";
                                              $certificationdate1 = "";
                                              $expirationdate1 = "";
                                              $qlfsignalperson = "";
                                              $qlfcertified2 = "";
                                              $certificationdate2 = "";
                                              $expirationdate2 = "";
                                              $qlfrigger = "";
                                              $qlfcertified3 = "";
                                              $certificationdate3 = "";
                                              $expirationdate3 = "";
                                              $qlfmechanic = "";
                                              $qlfelectromechanic = "";
                                              $qlfinspector = "";
                                              include("employee-qualification.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <?php 
                                              $hourly_bare = "";
                                              $daily_bare = "";
                                              $weekly_bare = "";
                                              $monthly_bare = "";
                                              $yearly_bare = "";
                                              $overtime_bare = "";
                                              $doubletime_bare = "";
                                              $traveltime_bare = "";
                                              $dailyminimum_bare = "";
                                              $projectminimum_bare = "";
                                              include("employee-labor-rate.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <?php 
                                              
                                              $salesperson = "";
                                              $commission = "";
                                              include("employee-slaesperson.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <?php 
                                              $driver = "";
                                              $licensenumber = "";
                                              $licenseclass = "";
                                              $licenseexpire = "";
                                              include("employee-driver-info.php"); 
                                            ?>   
                                        </div>
                                        <div id="tab-6" class="tab-pane">
                                            <?php 
                                              $empid = 0;
                                              include("employee-documents.php"); 
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