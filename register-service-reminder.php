<?php

    ob_start();
    $fleetclass="class='active'";
    $registerServRemindclass="class='active'";

    include("include/config.php");
    include("include/defs.php");
    $loggdUType = current_user_type();

    if (isset($_REQUEST['id'])){

      $arrVal = array("stat" => 2);

      UpdateRec("service_reminder", "id=".$_REQUEST['id'], $arrVal);

      $arrUser = GetRecord("service_reminder", "id = ".$_REQUEST['id']);

      $id_vehicle = $arrUser['id_vehicle'];
      $service = $arrUser['service'];
      $intervalmantenimance = $arrUser['materinterval'];
      $tieminterval = $arrUser['meterinterval'];
      $timeintervalopt = $arrUser['timeintervalopt'];
      $emailsubscribed = $arrUser['emailsubscribed'];
      $vehsection = $arrUser['vehicle_vection'];

    }

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
                        "service" => $service,
                        "vehicle_vection" => $vehsection,
                        "meterinterval" => $total_hour,
                        "tieminterval" => $interval,
                        "meterthreshold" => $next_service,
                        "emailsubscribed" => $emailsubscribed,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "stat" => 1
                       );

          $nId = InsertRec("service_reminder", $arrVal);

          if($nId > 0)
          {

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Service Reminder created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Service Reminder created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Service Reminder not created</strong>
                  </div>';
          }

     }
?>
  <?php
      $bcName = "Register Service Reminder";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Service Reminder</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php
                                if($message !="")
                                    echo $message;
                          ?>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehiculo</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---" onChange="checkVal();" id="vehicle"  name="vehicle" required="required" >
                                  <option value="">Seleccionar</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['name'];

                                  ?>
                                  <option value="<?php echo $kinId?>" <?php if(isset($id_vehicle)){ if($id_vehicle == $kinId){ echo 'selected'; }}?> > <?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Servicio</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" name="service" value="<?php if(isset($service)){ echo $service;} ?>">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Seccion del Vehiculo</label>
                              <div class="col-lg-4">
                                <select class="chosen-select form-control" onChange="checkFleetIssueVal();" name="vehsection" id="vehsection" required="required" >
                                  <?PHP
                                  foreach ($arrVehSection as $key => $value) {
                                    $kinId = $key;
                                    $kinDesc = $value;
                                  ?>
                                  <option value="<?php echo $kinId?>" <?php if(isset($vehsection)){ if($vehsection == $kinId){ echo 'selected'; }}?> > <?php echo $kinDesc?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Horas Actual</label>
                              <div class="col-lg-4">
                                <input type="number" value="<?php if(isset($tieminterval)){ echo $tieminterval;} ?>" class="form-control" required="" onkeyup="obtenerSuma();" onblur="checkMeterInterval()" name="total_hour" id="horas_actual">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Intervalo</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" onkeyup="obtenerSuma();" onblur="checkMeterInterval()"   name="interval" id="intervalo">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Proximo Mantenimiento</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" onblur="checkTimeInterval()"  name="next_service" id="resultado">
                              </div>
                              <script>
                                  function obtenerSuma()
                                  {
                                      document.getElementById('resultado').value=+parseFloat(document.getElementById('horas_actual').value)+parseFloat(document.getElementById('intervalo').value);
                                  }
                              </script>
                              <div class="col-lg-4">
                                <?php /* ?><select class="chosen-select form-control"  name="timeintervalopt" required="required" >
                                    <?PHP
                                    foreach ($arrThreshold as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                  */ ?>
                              </div>
                            </div>
                            <?php /* ?>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Meter Threshold</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" onblur="checkMeterInterval()"   name="meterthreshold" id="meterthreshold">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Time Threshold</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" onblur="checkTimeInterval()"   name="tiemthreshold" id="tiemthreshold">
                              </div>
                              <div class="col-lg-4">
                                <?php /* ?><select class="chosen-select form-control"  name="timethresholdopt" required="required" >
                                    <?PHP
                                    foreach ($arrThreshold as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                   ?>
                              </div>
                            </div>
                            <?php */ ?>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Suscribir Usuarios por Email</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="emailsubscribed" id="emailsubscribed" required=""  placeholder="" ><?php if(isset($emailsubscribed)){ echo $emailsubscribed;} ?></textarea>  <?php /* validado onblur="validateEmails(this.value)" */ ?>
                              </div>
                            </div>
                          <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary" name="submitUser" type="submit">Guardar</button>
                                <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancelar</button>
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
