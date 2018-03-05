<?php 

    ob_start();
    $fleetclass="class='active'";
    $registerFleetIssueclass="class='active'";
    
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
                        "id_vehicle" => $vehicle,
                        "reportedOn" => $reportedon,
                        "id_vehsection" => $vehsection,
                        "odometer" => $odometer,
                        "enginehour" => $enginehour,
                        "summary" => $summary,
                        "description" => $description,
                        "id_priority" => $priority,
                        "id_reportedby" => $reportedby,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "stat" => 1
                       );

          $nId = InsertRec("fleet_issue", $arrVal);    

          if($nId > 0)
          {
              $arrHistory = array(
                        "id_record" => $nId,
                        "id_vehicle" => $vehicle,
                        "fuelDate" => $reportedon,
                        "id_vehsection" => $vehsection,
                        "type" => "Fleet",
                        "odometer" => $odometer,
                        "enginehour" => $enginehour,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "createdBy" => $_SESSION['USER_ID']
                      );

              InsertRec("odometer_history", $arrHistory); 

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Fleet Issue created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Fleet Issue created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Fleet Issue not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Fleet Issue";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Fleet Issue</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden"  name="lastodm" id="lastodm" value="0">
                          <input type="hidden"  name="lastenghr" id="lastenghr" value="0">
                          <input type="hidden"  name="lastSection" id="lastSection" value="">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---" onChange="checkFleetIssueVal();" id="vehicle"  name="vehicle" required="required" >
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['name'];
                                    
                                  ?>
                                  <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>                   
                              </div>  
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Reported On</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="reportedon" id="reportedon" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle Section</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" onChange="checkFleetIssueVal();" name="vehsection" id="vehsection" required="required" >
                                    <?PHP
                                    foreach ($arrVehSection as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Odometer (km)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" onchange="checkOdometer(this.value)"  name="odometer" id="odometer">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Engine Hours</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required=""  onchange="checkEngineHr(this.value)"   name="enginehour" id="enginehour">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Summary</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""     name="summary">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Description</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="description" required=""  placeholder=""></textarea>  
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Priority</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="priority" required="required" >
                                    <?PHP
                                    foreach ($arrPriority as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Reported By</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="reportedby" required="required" >
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from employee where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['firstname']." ".$value['lastname'];
                                    
                                  ?>
                                  <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>                   
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