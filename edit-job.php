<?php 

    ob_start();
    $craneclass="class='active'";
    $editJobclass="class='active'";
    
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
          $liftprovidedby = (isset($liftprovidedby)) ? 1 : 0;
          $stval = (isset($_POST['status'])) ? 1 : 0;
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
                        "stat" => $stval
                       );

          // echo "<pre>";
          // print_r($_FILES);
          //exit;  
          UpdateRec("jobs", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              DeleteRec("jobs_resource_vehicle", "id_job = ".$nId);
              DeleteRec("jobs_resource_employee", "id_job = ".$nId);
              foreach ($vehicle as $key => $value) {
                InsertRec("jobs_resource_vehicle", array("id_job" => $nId, "id_vehicle" => $value));   
              }

              foreach ($employee as $key => $value) {
                InsertRec("jobs_resource_employee", array("id_job" => $nId, "id_employee" => $value));   
              }
              

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Job updated successfully</strong>
                    </div>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Job not updated</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $arrJob = GetRecord("jobs", "id = ".$_REQUEST['id']);
      $jobid = $arrJob['id'];
      $status = ($arrJob['stat'] == 1) ? 'checked' : '';
      $bcName = "Edit Job";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Job</h5>
                    </div>
                    <div class="ibox-content">
                      <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrJob['id']?>" name="id">
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
                                              $ticketid = $arrJob['ticketid'];
                                              $project = $arrJob['project'];
                                              $contact = $arrJob['id_contact'];
                                              $startdate = $arrJob['startdate'];
                                              $starttime = $arrJob['starttime'];
                                              $estimatedate = $arrJob['estimatedate'];
                                              $estimatetime = $arrJob['estimatetime'];
                                              $deliverydate = $arrJob['deliverydate'];
                                              $deliverytime = $arrJob['deliverytime'];
                                              $actualenddate = $arrJob['actualenddate'];
                                              $actualendtime  = $arrJob['actualendtime'];
                                              $jobstatus = $arrJob['status'];
                                              include("job-info.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                              $contactoff= $arrJob['contact'];
                                              $phone=$arrJob['phone'];
                                              $address1=$arrJob['address1'];
                                              $address2=$arrJob['address2'];
                                              include("job-sitemap.php"); 
                                            ?>
                                        </div>
                                         <div id="tab-3" class="tab-pane">
                                            <?php 
                                              $getVehRec = GetRecords("SELECT GROUP_CONCAT(id_vehicle) AS vehids FROM jobs_resource_vehicle where id_job = ".$_REQUEST['id']." group by id_job");

                                            $getEmpRec = GetRecords("SELECT GROUP_CONCAT(id_employee) AS empds FROM jobs_resource_employee where id_job = ".$_REQUEST['id']." group by id_job");        
                                                                                    
                                              
                                              if(isset($getVehRec[0]['vehids']) != "")
                                                $resvehicle = $getVehRec[0]['vehids'];

                                              if(isset($getEmpRec[0]['empds']) != "")
                                                $resemployee = $getEmpRec[0]['empds'];
                                              
                                              include("job-resources.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <?php 
                                              $notes = $arrJob['notes'];
                                              $liftprovidedby = ($arrJob['liftprovidedby']==1) ? 'checked' : '';
                                              $providor = $arrJob['providor'];
                                              $units = $arrJob['unit'];
                                              $loadweight=$arrJob['loadweight'];
                                              $loadlength=$arrJob['loadlength'];
                                              $loadwidth=$arrJob['loadwidth'];
                                              $loadheight=$arrJob['loadheight'];
                                              $loadradius=$arrJob['loadradius'];
                                              $obstructionlength=$arrJob['obstructionlength'];
                                              $obstructionwidth=$arrJob['obstructionwidth'];
                                              $obstructionheight=$arrJob['obstructionheight'];
                                              $liftdepth=$arrJob['liftdepth'];
                                              $setupdistance=$arrJob['setupdistance'];
                                              include("job-lift-info.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <?php 
                                              $travelp = $arrJob['travelp'];
                                              $streetusep = $arrJob['streetusep'];
                                              $cityp = $arrJob['cityp'];
                                              $countryp = $arrJob['countryp'];
                                              $statep=$arrJob['statep'];
                                              $miscellaneousp=$arrJob['miscellaneousp'];
                                              
                                              include("job-permits.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-6" class="tab-pane">
                                            <?php 
                                              $jobdesc = $arrJob['jobdesc'];
                                              $jobcomments = $arrJob['jobcomments'];
                                              
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