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
          if(isset($_POST['woreq']) && count($_POST['woreq']) > 0)
          {
            $allreq = implode(",", $_POST['woreq']);
          }  
          else
            $allreq = "";
          $arrVal = array(
                        
                        "id_person_change_hr" => $personinchargehr,
                        "especialist1hr" => $especialist1hr,
                        "especialist2hr" => $especialist2hr,
                        "especialist3hr" => $especialist3hr,
                        "especialist4hr" => $especialist4hr,
                        "especialist5hr" => $especialist5hr,
                        "costinparts" => $costinparts,
                        "costinthirdparty" => $costinthirdparty,
                        "thirdpartylaborhr" => $thirdpartylaborhr,
                        "reference" => $reference,
                        "relatedReq" => $allreq,
                        "isCompleted" => 1
                       );
          
          UpdateRec("workorder", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              if(isset($_POST['woissues']) && count($_POST['woissues']) > 0)
              {
                $allissues = implode(",", $_POST['woissues']);
                UpdateRec("fleet_issue", "id IN (".$allissues.")", array("isClosed" => 1, "stat" => 0));
              }  
              // $message = '<div class="alert alert-success">
              //       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              //         <strong>Work Order Status Completed successfully</strong>
              //       </div>';
              echo "<script>alert('Work Order Status Completed successfully'); window.location='workorder.php';</script>";
          }
          
          
        
     }

     $arrUser = GetRecord("workorder", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "Work Order Status Completed";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Work Order Status Completed</h5>
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
                                <select class="chosen-select" data-placeholder="---select---"  id="vehicle"  name="vehicle" required="required" >
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
                                        <input type="text" required=""  class="form-control" name="createdon" id="createdon" value="<?php echo $arrUser['createdOn']?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle Section</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control"  name="vehsection" id="vehsection" required="required" >
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
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['odometer']?>"   name="odometer" id="odometer">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Engine Hours</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['enginehour']?>"     name="enginehour" id="enginehour">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Person in charge (hrs)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required=""  name="personinchargehr">                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #1 (hrs)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" value="0" required=""   name="especialist1hr" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #2 (hrs)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" value="0" required=""   name="especialist2hr" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #3 (hrs)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" value="0" required=""   name="especialist3hr" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #4 (hrs)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" value="0" required=""   name="especialist4hr" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Especialist #5 (hrs)</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" value="0" required=""   name="especialist5hr" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Work to Performed</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="workperformed" required=""  placeholder=""><?php echo $arrUser['worktoperformed']?></textarea>  
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Cost in parts ($)</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="costinparts" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Cost in third party labor ($)</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="costinthirdparty" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">third party labor (hr)</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="thirdpartylaborhr" >                     
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Related Issues</label>
                              <div class="col-lg-4">
                                <div style="padding-left:5px;border:1px solid #ddd; height: 200px; overflow-y: auto" id="releatedissues">
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
                              <label class="col-lg-4 text-right control-label font-bold">Reference</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="reference" required=""  placeholder=""></textarea>  
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Requisitions</label>
                              <div class="col-lg-4">
                                <div  style="padding-left:5px;border:1px solid #ddd; height: 200px; overflow-y: auto" id="releatedissues">
                              <?php
                                if($arrUser['relatedIssues'] != "")
                                { 
                                  $arrReq = GetRecords("SELECT id from requisition 
                                              where wo_no = ".$arrUser['wo_no']." and is_Approved = 1 order by id");
                                  $html="";
                                  foreach ($arrReq as $key => $value) {

                                    $html.="<p><input type='checkbox' name='woreq[]' value='".$value['id']."' > Req #".$value['id']."</p>";

                                  }
                                  echo $html;
                                }
                              ?>  
                                </div>
                              </div>  
                            </div>
                          <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary" name="submitUser" type="submit">Save as Completed</button>
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