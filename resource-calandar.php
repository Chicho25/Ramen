<?php 
    ob_start();
    $craneclass="class='active'";
    $resourceCalandarclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User") 
     {
          header("Location: index.php");
          exit;
     }
    
     
?>
     <?php 
      $bcName = "Resource Calandar";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Resource Calandar</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post" class="form-horizontal">
                        <div class="row wrapper m-b-lg">
                          <div class="col-sm-6">
                            <div class="form-group ">  
                              <div class="col-sm-12 font-bold">
                                <label class="col-sm-3 control-label">Display</label>
                                <div class="col-sm-9">
                                  <input type="radio" onclick="showOptions('c')" class="m-r" name="display"> Cranes
                                  <input type="radio" onclick="showOptions('e')" name="display"> Employee
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12 font-bold" id="vehicle" style="display: none">
                                <label class="col-sm-3 control-label">Vehicle Type</label>
                                <div class="col-sm-9 m-b-sm">
                                  <select class="chosen-select form-control" name="dtype" id="dtype" onchange="showDATA('vehicle')">
                                  <option value="">All</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from type_vehicle order by name");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['name'];
                                    $selRoll = (isset($type) && $type == $kinId) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                </div>

                                <label class="col-sm-3 control-label">Vehicle</label>
                                <div class="col-sm-9">
                                  <select class="chosen-select form-control" name="val" id="val" onchange="showDATA('vehicle')">
                                  <option value="">All</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['name'];
                                    if($resvehicle != "") : 
                                    $expResVehicle = explode(",", $resvehicle);
                                    if (in_array($kinId, $expResVehicle))
                                      $selRoll = 'selected' ;
                                    else
                                      $selRoll = ''; 
                                    endif;
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                </div>
                              </div>

                              <div class="col-sm-12 font-bold" id="employee" style="display: none">
                                <label class="col-sm-3 control-label">Employee Type</label>
                                <div class="col-sm-9">
                                  <select class="chosen-select form-control" name="edtype" id="edtype" onchange="showDATA('employee')">
                                    <option value="">All</option>
                                    <option value="craneoperator">Crane Operator</option>
                                    <option value="qlfsignalperson">SignalPerson</option>
                                    <option value="qlfrigger">Rigger</option>
                                    <option value="qlfmechanic">Mechanic</option>
                                    <option value="qlfelectromecha">Electro Mechanic</option>
                                    <option value="qlfinspector">Inspector</option>
                                  </select>
                                </div>

                                <div class="col-sm-12 clearfix">
                                    <label class="col-sm-3 control-label">Employee</label>
                                    <div class="col-sm-9">
                                      <select class="chosen-select form-control" name="eval" id="eval" onchange="showDATA('employee')">
                                      <option value="">All</option>
                                      <?PHP
                                      $arrKindMeetings = GetRecords("Select * from employee where stat=1");
                                      foreach ($arrKindMeetings as $key => $value) {
                                        $kinId = $value['id'];
                                        $kinDesc = $value['firstname'] ." ".$value['lastname'];
                                        if($resvehicle != "") : 
                                        $expResVehicle = explode(",", $resvehicle);
                                        if (in_array($kinId, $expResVehicle))
                                          $selRoll = 'selected' ;
                                        else
                                          $selRoll = ''; 
                                        endif;
                                      ?>
                                      <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                    </div>
                                </div>
                              </div>
                            </div>  
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                            <div class="col-sm-12 font-bold pull-left">Job Types</div>
                            <div class="col-sm-12 pl0">
                              
                                <?PHP
                                
                                foreach ($arrJobStatus as $key => $value) {
                                  $selRoll = (isset($jobstatus) && $jobstatus == $key) ? 'selected' : '';
                                ?>
                                <div class="col-sm-12">
                                  <input type="checkbox" onclick="showDATA('jobtype')" name="jobType[]"  value="<?php echo $key?>" > <?php echo $value?>
                                </div>
                                <?php
                              }
                                ?>
                              
                            </div>
                        </div>
                          </div>
                        </div>
                      </form>
                      <div id="calendar"></div>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script type="text/javascript">
    
  </script>
<?php    
  include("footer.php"); 
?> 