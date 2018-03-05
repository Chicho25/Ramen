<?php 

    ob_start();
    $fleetclass="class='active'";
    $editFleetIssueclass="class='active'";
    
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
          $partialfuel = (isset($partialfuel)) ? 1 : 0;
          $stval = (isset($_POST['status'])) ? 1 : 0;
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
                        "stat" => $stval
                       );
          
          UpdateRec("fleet_issue", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Fuel updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("fleet_issue", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "Edit Fleet Issue";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Fleet Issue</h5>
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
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---" onChange="checkFleetIssueVal();" id="vehicle"  name="vehicle" required="required" >
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
                                <label class="col-lg-4 text-right control-label font-bold">Reported On</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="reportedon" id="reportedon" value="<?php echo $arrUser['reportedOn']?>">
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
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Summary</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""  value="<?php echo $arrUser['summary']?>"   name="summary">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Description</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="description" required=""  placeholder=""><?php echo $arrUser['description']?></textarea>  
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
                              <label class="col-lg-4 text-right control-label font-bold">Reported By</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="reportedby" required="required" >
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from employee where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['firstname']." ".$value['lastname'];
                                    $selRoll = (isset($arrUser['id_reportedby']) && $arrUser['id_reportedby'] == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>                   
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