<?php 

    ob_start();
    $craneclass="class='active'";
    $registerJobclass="class='active'";
    
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
          $liftprovidedby = (isset($liftprovidedby)) ? 1 : 0;
          $arrVal = array(
                        "ticketid" => $ticketid,
                        "project" => $project,
                        "id_contact" => $contact,
                        "startdate" => $startdate,
                        "starttime" => $starttime,
                        "estimatedate" => $estimatedate,
                        "estimatetime" => $estimatetime,
                        "deliverydate" => $deliverydate,
                        "deliverytime" => $deliverytime,
                        "actualenddate" => $actualenddate,
                        "actualendtime" => $actualendtime,
                        "status" => $status,
                        "contact" => $contactoff,
                        "phone" => $phone,
                        "address1" => $address1,
                        "address2" => $address2,
                        // "ids_vehicle" => implode(",",$vehicle),
                        // "ids_employee" => implode(",",$employee),
                        "notes" => $notes,
                        "liftprovidedby" => $liftprovidedby,
                        "providor" => $providor,
                        "unit" => $unit,
                        "loadweight" => $loadweight,
                        "loadlength" => $loadlength,
                        "loadwidth" => $loadwidth,
                        "loadheight" => $loadheight,
                        "loadradius" => $loadradius,
                        "obstructionlength" => $obstructionlength,
                        "obstructionwidth" => $obstructionwidth,
                        "obstructionheight" => $obstructionheight,
                        "liftdepth" => $liftdepth,
                        "setupdistance" => $setupdistance,
                        "travelp" => $travelp,
                        "streetusep" => $streetusep,
                        "cityp" => $cityp,
                        "countryp" => $countryp,
                        "statep" => $statep,
                        "miscellaneousp" => $miscellaneousp,
                        "jobdesc" => $jobdesc,
                        "jobcomments" => $jobcomments,
                        "stat" => 1,"created_on" => date("Y-m-d h:i::s")
                       );

            
          $nId = InsertRec("jobs", $arrVal);    

          if($nId > 0)
          {
              
              foreach ($vehicle as $key => $value) {
                InsertRec("jobs_resource_vehicle", array("id_job" => $nId, "id_vehicle" => $value));   
              }

              foreach ($employee as $key => $value) {
                InsertRec("jobs_resource_employee", array("id_job" => $nId, "id_employee" => $value));   
              }
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Job created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Job created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Job not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Job";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Job</h5>
                    </div>
                    <div class="ibox-content">
                      <form class="form-horizontal" data-validate="parsley" id="frmEmployee" method="post"   enctype="multipart/form-data" role='form' >
                        <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                        <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-1">Info</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-2" onclick="myMap()">Site/Maps</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-3">Resources</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-4">Lift</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-5">Permits</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-6">Notes</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <?php 
                                              $ticketid = "";
                                              $project = "";
                                              $contact = "";
                                              $startdate = "";
                                              $starttime = "";
                                              $estimatedate = "";
                                              $estimatetime = "";
                                              $deliverydate = "";
                                              $deliverytime = "";
                                              $actualenddate = "";
                                              $actualendtime  = "";
                                              $jobstatus = "";
                                              include("job-info.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                            	$contactoff= "";
                                              $phone="";
                                              $address1="";
                                              $address2="";
                                              include("job-sitemap.php"); 
                                            ?>
                                        </div>
                                         <div id="tab-3" class="tab-pane">
                                            <?php 
                                              $smtp = "";
                                              $port = "";
                                              $ssl = "";
                                              $subject = "";

                                              include("job-resources.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <?php 
                                              $notes = "";
                                              $liftprovidedby = "";
                                              $providor = "";
                                              $units = "";
                                              $loadweight="";
                                              $loadlength="";
                                              $loadwidth="";
                                              $loadheight="";
                                              $loadradius="";
                                              $obstructionlength="";
                                              $obstructionwidth="";
                                              $obstructionheight="";
                                              $liftdepth="";
                                              $setupdistance="";
                                              include("job-lift-info.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <?php 
                                              $travelp = "";
                                              $streetusep = "";
                                              $cityp = "";
                                              $countryp = "";
                                              $statep="";
                                              $miscellaneousp="";
                                              
                                              include("job-permits.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-6" class="tab-pane">
                                            <?php 
                                              $jobdesc = "";
                                              $jobcomments = "";
                                              
                                              include("job-notes.php"); 
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
