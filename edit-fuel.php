<?php 

    ob_start();
    $fleetclass="class='active'";
    $editFuelclass="class='active'";
    
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
                        "fuelDate" => $date,
                        "id_vehsection" => $vehsection,
                        "odometer" => $odometer,
                        "enginehour" => $enginehour,
                        "liters" => $liters,
                        "price" => $price,
                        "fueltype" => $fueltype,
                        "id_supplier" => $supplier,
                        "reference" => $reference,
                        "partialfuel" => $partialfuel,
                        "hour" => $hour
                       );
          
          UpdateRec("fuel", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Fuel updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("fuel", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
     $partialfuel = ($arrUser['partialfuel'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "Edit Fuel";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Fuel</h5>
                    </div>
                    <div class="ibox-content">
                     <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                      <input type="hidden"  name="lastodm" id="lastodm" value="0">
                      <input type="hidden"  name="lastenghr" id="lastenghr" value="0">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-3 text-right control-label font-bold">Vehicle</label>
                              <div class="col-sm-4">
                                  <select class="chosen-select form-control" name="vehicle" id="vehicle" required="required"  onChange="checkVal();" >
                                    <option value="">--Select---</option>
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
                          <div class="form-group required" id="data_1">
                            <label class="col-lg-3 text-right control-label font-bold">Date</label>
                            <div class="col-lg-4">
                              <div class="input-group date">
                                  <input type="text" required="" class="form-control" name="date" value="<?php echo $arrUser['fuelDate']?>" id="date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>                       
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Hora</label>
                            <div class="col-lg-4">
                              <div class="input-group">
                                  <input type="text" required="" class="form-control" name="hour" value="<?php echo $arrUser['hour']?>">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label font-bold">Vehicle Section</label>
                              <div class="col-lg-4">
                                
                                <select class="chosen-select form-control"  onChange="checkVal();"  name="vehsection" required="required" >
                                  <?PHP
                                  
                                  foreach ($arrVehSection as $key => $value) {
                                    $selRoll = (isset($arrUser['id_vehsection']) && $arrUser['id_vehsection'] == $key) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                                  <?php
                                }
                                  ?>
                                </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Odometer (km)</label>
                            <div class="col-lg-4">
                              <input type="number" class="form-control" required="" value="<?php echo $arrUser['odometer']?>" onblur="checkOdometer(this.value)"  name="odometer" id="odometer">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Engine Hours</label>
                            <div class="col-lg-4">
                              <input type="number" class="form-control" required=""  value="<?php echo $arrUser['enginehour']?>" onblur="checkEngineHr(this.value)"   name="enginehour" id="enginehour">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Liters</label>
                            <div class="col-lg-4">
                              <input type="number" class="form-control" required="" value="<?php echo number_format((float)$arrUser['liters'], 3, '.', '')?>" name="liters">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Price/Unit</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" value="<?php echo number_format((float)$arrUser['price'], 3, '.', '')?>"  name="price">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Fuel Type/Grade</label>
                            <div class="col-lg-4">
                              <select class="chosen-select form-control" name="fueltype" required="required" >
                                  <?PHP
                                  
                                  foreach ($arrFuelGrades as $key => $value) {
                                    $selRoll = (isset($arrUser['fueltype']) && $arrUser['fueltype'] == $key) ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                                  <?php
                                }
                                  ?>
                                </select>                       
                            </div>  
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-3 text-right control-label font-bold">Supplier</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="supplier" required="required" >
                                    <option value="">--Select---</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from supplier where stat=1");
                                    foreach ($arrKindMeetings as $key => $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['name'];
                                      $selRoll = (isset($arrUser['id_supplier']) && $arrUser['id_supplier'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Reference</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['reference']?>"  name="reference">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold"></label>
                            <div class="col-lg-4">
                              <label class="checkbox-inline"> 
                                <input type="checkbox" value="1" name="partialfuel"  <?php echo $partialfuel?>> Partial Fuel-Up
                              </label>                        
                            </div>  
                          </div>
                          <!-- <div class="form-group required">
                            <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                            <div class="col-lg-4">
                                <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
                                
                            </div>

                          </div>  --> 

                          <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">  
                                        <button class="btn btn-primary" name="submitUser" type="submit">Update</button>
                                        <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                                    </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show().attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
<?php    
  include("footer.php"); 
?>