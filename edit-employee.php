<?php 

    ob_start();
    $countryclass="class='active'";
    $editVehclass="class='active'";
    
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

                        "stat" => $stval
                       );

          // echo "<pre>";
          // print_r($_FILES);
          //exit;  
          UpdateRec("employee", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
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
                      <strong>Employee updated successfully</strong>
                    </div>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Employee not updated</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $arrEmployee = GetRecord("employee", "id = ".$_REQUEST['id']);
      $empid = $arrEmployee['id'];
      $status = ($arrEmployee['stat'] == 1) ? 'checked' : '';
      $bcName = "Edit Employee";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Vehicle</h5>
                    </div>
                    <div class="ibox-content">
                      <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrEmployee['id']?>" name="id">
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
                                              $idcard = $arrEmployee['idcard'];
                                              $fname = $arrEmployee['firstname'];
                                              $lname = $arrEmployee['lastname'];
                                              $jobtitle = $arrEmployee['jobtitle'];
                                              $cellphone = $arrEmployee['cellno'];
                                              $email = $arrEmployee['email'];
                                              $thirdparty  = $arrEmployee['thirdparty'];

                                              include("employee-detail.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                              
                                              $craneoperator = ($arrEmployee['craneoperator'] == 1) ? 'checked' : '';
                                              $qlfcertified1 = ($arrEmployee['qlfcertified1'] == 1) ? 'checked' : '';
                                              $certificationdate1 = $arrEmployee['certificationdate1'];
                                              $expirationdate1 = $arrEmployee['expirationdate1'];
                                              $qlfsignalperson = ($arrEmployee['qlfsignalperson'] == 1) ? 'checked' : '';
                                              $qlfcertified2 = ($arrEmployee['qlfcertified2'] == 1) ? 'checked' : '';
                                              $certificationdate2 = $arrEmployee['certificationdate2'];
                                              $expirationdate2 = $arrEmployee['expirationdate2'];
                                              $qlfrigger = ($arrEmployee['qlfrigger'] == 1) ? 'checked' : '';
                                              $qlfcertified3 = ($arrEmployee['qlfcertified3'] == 1) ? 'checked' : '';
                                              $certificationdate3 = $arrEmployee['certificationdate3'];
                                              $expirationdate3 = $arrEmployee['expirationdate3'];
                                              $qlfmechanic = ($arrEmployee['qlfmechanic'] == 1) ? 'checked' : '';
                                              $qlfelectromechanic = ($arrEmployee['qlfelectromechanic'] == 1) ? 'checked' : '';
                                              $qlfinspector = ($arrEmployee['qlfinspector'] == 1) ? 'checked' : '';
                                              include("employee-qualification.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <?php 
                                              
                                              $hourly_bare = $arrEmployee['hourly_bare'];
                                              $daily_bare = $arrEmployee['daily_bare'];
                                              $weekly_bare = $arrEmployee['weekly_bare'];
                                              $monthly_bare = $arrEmployee['monthly_bare'];
                                              $yearly_bare = $arrEmployee['yearly_bare'];
                                              $overtime_bare = $arrEmployee['overtime_bare'];
                                              $doubletime_bare = $arrEmployee['doubletime_bare'];
                                              $traveltime_bare = $arrEmployee['traveltime_bare'];
                                              $dailyminimum_bare = $arrEmployee['dailyminimum_bare'];
                                              $projectminimum_bare = $arrEmployee['projectminimum_bare'];
                                              include("employee-labor-rate.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <?php 
                                              
                                              $salesperson = ($arrEmployee['salesperson'] == 1) ? 'checked' : '';
                                              $commission = $arrEmployee['commission'];
                                              include("employee-slaesperson.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <?php 
                                              $driver = ($arrEmployee['driver'] == 1) ? 'checked' : '';
                                              $licensenumber = $arrEmployee['licensenumber'];
                                              $licenseclass = $arrEmployee['licenseclass'];
                                              $licenseexpire = $arrEmployee['licenseexpire'];
                                              include("employee-driver-info.php"); 
                                            ?>   
                                        </div>
                                        <div id="tab-6" class="tab-pane">
                                            <?php 
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