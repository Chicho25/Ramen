<?php 

    ob_start();
    $fleetclass="class='active'";
    $registerWorkOrderclass="class='active'";
    
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
          if(isset($_POST['woissues']) && count($_POST['woissues']) > 0)
          {
            $allissues = implode(",", $_POST['woissues']);
          }  
          else
            $allissues = "";
          $arrVal = array(
                        "wo_no" => maxWONumber(),
                        "id_type" => $wotype,
                        "id_vehicle" => $vehicle,
                        "createdOn" => $createdon,
                        "id_status" => $wostatus,
                        "id_vehsection" => $vehsection,
                        "odometer" => $odometer,
                        "enginehour" => $enginehour,
                        "assigneddate" => $assigneddate,
                        "completiondate" => $completiondate,
                        "id_priority" => $priority,
                        "id_person_change" => $personincharge,
                        "id_especialist1" => $especialist1,
                        "id_especialist2" => $especialist2,
                        "id_especialist3" => $especialist3,
                        "id_especialist4" => $especialist4,
                        "id_especialist5" => $especialist5,
                        "worktoperformed" => $workperformed,
                        "relatedIssues" => $allissues,
                        "stat" => 1
                       );

          $nId = InsertRec("workorder", $arrVal);    

          if($nId > 0)
          {
              $arrHistory = array(
                        "id_record" => $nId,
                        "id_vehicle" => $vehicle,
                        "fuelDate" => $createdOn,
                        "id_vehsection" => $vehsection,
                        "type" => "WorkOrder",
                        "odometer" => $odometer,
                        "enginehour" => $enginehour,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "createdBy" => $_SESSION['USER_ID']
                      );

              InsertRec("odometer_history", $arrHistory); 

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Work Order created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Work Order created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Work Order not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Work Order";
      include("breadcrumb.php") ;
      $nWONumber = maxWONumber();
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Work Order</h5>
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
                            <label class="col-lg-4 text-right control-label font-bold">Work Order#</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" readonly="" placeholder="Work Order#" name="wonumber" data-required="true" value="<?php echo $nWONumber?>">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Type of Work Order</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="wotype" required="required" >
                                    <?PHP
                                    foreach ($arrWOTypes as $key => $value) {
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
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---" onChange="checkWOVal(); getIssues()" id="vehicle"  name="vehicle" required="required" >
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
                                <label class="col-lg-4 text-right control-label font-bold">Created On</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="createdon" id="createdon" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Status</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="wostatus" required="required" >
                                    <?PHP
                                    foreach ($arrWOStatus as $key => $value) {
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
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle Section</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" onChange="checkWOVal();" name="vehsection" id="vehsection" required="required" >
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
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Assigned Date</label>
                                <div class="col-lg-4" id="data_2">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="assigneddate" id="assigneddate" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Completion Date</label>
                                <div class="col-lg-4" id="data_3">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="completiondate" id="createdon" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                  
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
                              <label class="col-lg-4 text-right control-label font-bold">Person in charge</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="personincharge" required="required" >
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #1</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="especialist1"  >
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #2</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="especialist2"  >
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #3</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="especialist3"  >
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #4</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="especialist4"  >
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #5</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="especialist5" >
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Work to Performed</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="workperformed" required=""  placeholder=""></textarea>  
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Related Issues</label>
                              <div class="col-lg-4">
                                <div  style="padding-left:5px; border:1px solid #ddd; height: 200px; overflow-y: auto" id="releatedissues">
                                </div>
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