<?php

    ob_start();
    $fleetclass="class='active'";
    $editServRemindclass="class='active'";

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
          $arrVal = array("id_vehicle" => $vehicle,
                          "service" => $service,
                          "vehicle_vection" => $vehsection,
                          "meterinterval" => $meterinterval,
                          "tieminterval" => $tieminterval,
                          "meterthreshold" => $meterthreshold,
                          "emailsubscribed" => $emailsubscribed,
                          "stat" => $stval,
                          "fecha_update" => date("Y-m-d h:i:s"));

          UpdateRec("service_reminder", "id=".$_REQUEST['id'], $arrVal);
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Datos Actualizados..!</strong>
                    </div>';
          }



     }

     $arrUser = GetRecord("service_reminder", "id = ".$_REQUEST['id']);
     $stat = ($arrUser['stat'] == 1) ? 'checked' : '';

?>
  <?php
      $bcName = "Edit Service Reminder";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Recordatorio de Mantenimiento</h5>
                    </div>
                    <div class="ibox-content">
                     <form class="form-horizontal" data-validate="parsley" method="post" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                      <input type="hidden"  name="lastodm" id="lastodm" value="0">
                      <input type="hidden"  name="lastenghr" id="lastenghr" value="0">
                          <?php
                                if($message !="")
                                    echo $message;
                          ?>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehiculo</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="vehicle" id="vehicle" required="required"  onChange="checkVal();" >
                                    <option value="">Seleccionar</option>
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
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Servicio</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['service']?>"   name="service">
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
                                    $selRoll = (isset($arrUser['vehicle_vection']) && $arrUser['vehicle_vection'] == $kinId) ? 'selected' : '';

                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll; ?> ><?php echo $kinDesc?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Horas Actual</label>
                              <div class="col-lg-4">
                                <input type="number"  class="form-control" required="" value="<?php echo $arrUser['meterinterval']?>" onkeyup="obtenerSuma();"  name="meterinterval" id="horas_actual" onblur="checkMeterInterval()">
                              </div>
                            </div>

                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Intervalo</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" value="<?php echo $arrUser['tieminterval']?>" onkeyup="obtenerSuma();" onblur="checkTimeInterval()" id="intervalo"  name="tieminterval" >
                              </div>
                              <div class="col-lg-4">
                                <?php /* ?>
                                <select class="chosen-select form-control"  name="timeintervalopt" required="required" >
                                    <?PHP
                                    foreach ($arrThreshold as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    $selRoll = (isset($arrUser['timeintervalopt']) && $arrUser['timeintervalopt'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                  <?php */ ?>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Proximo Mantenimiento</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" onblur="checkTimeInterval()" value="<?php echo $arrUser['meterthreshold']?>" name="meterthreshold" id="resultado">
                              </div>
                            </div>
                            <script>
                                //function obtenerSuma()
                                //{
                                //    document.getElementById('resultado').value=parseFloat(document.getElementById('horas_actual').value)+parseFloat(document.getElementById('intervalo').value);
                                //}
                            </script>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold"></label>
                              <div class="col-lg-4">
                              </div>
                              <div class="col-lg-4">
                                <?php /* ?>
                                <select class="chosen-select form-control"  name="timethresholdopt" required="required" >
                                    <?PHP
                                    foreach ($arrThreshold as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    $selRoll = (isset($arrUser['timethresholdopt']) && $arrUser['timethresholdopt'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                  */ ?>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Email  Subscribed Users</label>
                              <div class="col-lg-4">

                                <textarea rows="7" class="form-control" cols="44" name="emailsubscribed" required=""  placeholder=""><?php echo $arrUser['emailsubscribed']?></textarea>
                              </div>
                            </div>
                          <div class="form-group required">
                            <label class="col-lg-4 font-bold control-label">Activo/Desactivo</label>
                            <div class="col-lg-4">
                                <input type="checkbox" class="js-switch" name="status" <?php echo $stat?> >

                            </div>

                          </div>

                          <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <button class="btn btn-primary" nameclass="tUser" type="submit" name="submitUser">Guardar</button>
                                        <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancelar</button>
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
