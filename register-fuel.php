<?php 

    ob_start();
    $fleetclass="class='active'";
    $registerFuelclass="class='active'";
    
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
          $partialfuel = (isset($partialfuel)) ? 1 : 0;
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
                        "stat" => 1,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "hour" => $hour
                       );

          $nId = InsertRec("fuel", $arrVal);    

          if($nId > 0)
          {
              $arrHistory = array(
                        "id_record" => $nId,
                        "id_vehicle" => $vehicle,
                        "fuelDate" => $date,
                        "id_vehsection" => $vehsection,
                        "type" => "Fuel",
                        "odometer" => $odometer,
                        "enginehour" => $enginehour,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "createdBy" => $_SESSION['USER_ID']
                      );

              InsertRec("odometer_history", $arrHistory);    

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Registro Realizado</strong>
                    </div>';

              echo '<script>
                        alert("Fuel created successfully");
                        window.location="'.$_SERVER['PHP_SELF'].'";
                    </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Fuel not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Fuel Entry";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Fuel Entry</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" id="DDD" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <input type="hidden"  name="lastodm" id="lastodm" value="0">
                          <input type="hidden"  name="lastenghr" id="lastenghr" value="0">
                          <input type="hidden"  name="lastSection" id="lastSection" value="">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-3 text-right control-label font-bold">Vehiculo</label>
                              <div class="col-sm-4">
                                  <select class="chosen-select form-control" name="vehicle" onChange="checkVal();" id="vehicle" required="required">
                                    <option value="">--Select---</option>
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
                          <div class="form-group required" id="data_1">
                            <label class="col-lg-3 text-right control-label font-bold">Fecha</label>
                            <div class="col-lg-4">
                              <div class="input-group date">
                                  <input type="text" required="" class="form-control" name="date" id="date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>                       
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Hora</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" name="hour">
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label font-bold">Seccion del Vehiculo</label>
                              <div class="col-lg-4">
                                
                                <select class="chosen-select form-control" onChange="checkVal();" name="vehsection" id="vehsection" required="required" >
                                  <?PHP
                                  
                                  foreach ($arrVehSection as $key => $value) {
                                    
                                  ?>
                                  <option value="<?php echo $key?>"><?php echo $value?></option>
                                  <?php
                                }
                                  ?>
                                </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Odometro (km)</label>
                            <div class="col-lg-4">
                              <input type="number" class="form-control" required="" onchange="checkOdometer(this.value)"  name="odometer" id="odometer">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Engine Hours</label>
                            <div class="col-lg-4">
                              <input type="number" class="form-control" required=""  onchange="checkEngineHr(this.value)"   name="enginehour" id="enginehour">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Litros</label>
                            <div class="col-lg-4">
                              <input type="number" class="form-control" required=""  name="liters">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Precio/Unidad</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required=""  name="price">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Fuel Type/Grade</label>
                            <div class="col-lg-4">
                              <select class="chosen-select form-control" name="fueltype" required="required" >
                                  <?PHP
                                  
                                  foreach ($arrFuelGrades as $key => $value) {
                                    
                                  ?>
                                  <option value="<?php echo $key?>"><?php echo $value?></option>
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
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold">Reference</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"   name="reference">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-3 text-right control-label font-bold"></label>
                            <div class="col-lg-4">
                              <label class="checkbox-inline"> 
                                <input type="checkbox" value="1" name="partialfuel"  > Partial Fuel-Up
                              </label>                        
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
