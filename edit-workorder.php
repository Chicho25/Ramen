<?php 

    ob_start();
    $fleetclass="class='active'";
    $editWorkOrderclass="class='active'";
    
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
          if(isset($_POST['woissues']) && count($_POST['woissues']) > 0)
          {
            $allissues = implode(",", $_POST['woissues']);
          }  
          else
            $allissues = "";
          $arrVal = array(
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
                        "stat" => $stval
                       );
          
          UpdateRec("workorder", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Work Order updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("workorder", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "Edit Work Order";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Work Order</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
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
                              <input type="text" class="form-control" required="" readonly="" placeholder="Work Order#" name="wonumber" data-required="true" value="<?php echo $arrUser['wo_no']?>">                        
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
                                      $selRoll = (isset($arrUser['id_type']) && $arrUser['id_type'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_vehicle']) && $arrUser['id_vehicle'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                        <input type="text" required="" class="form-control" name="createdon" id="createdon" value="<?php echo $arrUser['createdOn']?>">
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
                                      $selRoll = (isset($arrUser['id_status']) && $arrUser['id_status'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                      $selRoll = (isset($arrUser['id_vehsection']) && $arrUser['id_vehsection'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Odometer (km)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" value="<?php echo $arrUser['odometer']?>" onchange="checkOdometer(this.value)"  name="odometer" id="odometer">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Engine Hours</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" value="<?php echo $arrUser['enginehour']?>"  onchange="checkEngineHr(this.value)"   name="enginehour" id="enginehour">                        
                              </div>  
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Assigned Date</label>
                                <div class="col-lg-4" id="data_2">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="assigneddate" id="assigneddate" value="<?php echo $arrUser['assigneddate']?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Completion Date</label>
                                <div class="col-lg-4" id="data_3">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="completiondate" id="createdon" value="<?php echo $arrUser['completiondate']?>">
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
                                      $selRoll = (isset($arrUser['id_priority']) && $arrUser['id_priority'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_person_change']) && $arrUser['id_person_change'] == $kinId) ? 'selected' : '';
                                    
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_especialist1']) && $arrUser['id_especialist1'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_especialist2']) && $arrUser['id_especialist2'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_especialist3']) && $arrUser['id_especialist3'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_especialist4']) && $arrUser['id_especialist4'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
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
                                    $selRoll = (isset($arrUser['id_especialist5']) && $arrUser['id_especialist5'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>                   
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Work to Performed</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="workperformed" required=""  placeholder=""><?php echo $arrUser['worktoperformed']?></textarea>  
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Related Issues</label>
                              <div class="col-lg-4">
                                <div class="m-l-sm" style="padding-left:5px;border:1px solid #ddd; height: 200px; overflow-y: auto" id="releatedissues">
                              <?php
                                if($arrUser['relatedIssues'] != "")
                                { 
                                  $expRelIssues = explode(",", $arrUser['relatedIssues']);
                                  $arrIssues = GetRecords("SELECT id, summary from fleet_issue 
                                              where id_vehicle = ".$arrUser['id_vehicle']." and stat = 1 order by id");
                                  $html="";
                                  foreach ($arrIssues as $key => $value) {

                                    $selRoll = (in_array($value['id'], $expRelIssues)) ? 'checked' : '';
                                    $html.="<p><input type='checkbox' name='woissues[]' value='".$value['id']."' ".$selRoll."> Issue #".$value['id']." - ".$value['summary']."</p>";

                                  }
                                  echo $html;
                                }
                              ?>  
                                </div>
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                              <div class="col-lg-4">
                                  <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
                                  
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