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
    $where = "where (1=1)";

      $name = "";
      if(isset($_POST['cname']) && $_POST['cname'] != "")
      {
        $where.=" and  (vehicle.name LIKE '%".$_POST['cname']."%' OR service_reminder.meterthreshold LIKE '%".$_POST['cname']."%' OR service_reminder.service LIKE '%".$_POST['cname']."%' OR service_reminder.tiemthreshold LIKE '%".$_POST['cname']."%' ) ";
        $name = $_POST['cname'];
      }
      if(isset($_POST['status']) && $_POST['status'] != "")
      {
        $where.=" and  service_reminder.stat =  ".$_POST['status'];
        $status = $_POST['status'];
      }
      else
      {
        $where.=" and  service_reminder.stat =  1";
        $status = 1;
      }
      if(isset($_POST['type']) && $_POST['type']!=''){
        $where.=" and vehicle.type =".$_POST['type'];
        $type = $_POST['type'];
      }
      $arrUser = GetRecords("SELECT service_reminder.*, vehicle.name as VehName
                            from service_reminder
                            inner join vehicle on vehicle.id = service_reminder.id_vehicle
                              $where
                             order by vehicle.name");

?>
     <?php
      $bcName = "Service Reminder  List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Service Reminder List</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-service-reminder.php'"?>Agregar Servicio</button>
                            </span>
                          </div>
                          <div class="col-sm-3 m-b-xs pull-right">
                            <div class="input-group">
                              <span class="input-group-btn padder "><button class="btn btn-success btn-rounded">Buscar</button></span>
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="text" class="input-s input-sm form-control" value="<?php echo $name?>" name="cname" placeholder="Nombre del Vehiculo">
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="radio" name="status" value="1" <?php echo $c=(isset($status) && $status == 1) ? 'checked' : ''?> > Activo
                              <input type="radio" name="status" value="0" <?php echo $c=(isset($status) && $status == 0) ? 'checked' : ''?> > No Activo
                              <input type="radio" name="status" value="2" <?php echo $c=(isset($status) && $status == 0) ? 'checked' : ''?> > Completados
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                                  <select class="chosen-select form-control" name="type">
                                    <option value="">Seleccionar</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from type_vehicle order by name");
                                    foreach ($arrKindMeetings as $key => $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['name'];
                                      $selRoll = (isset($type) && $type == $kinId) ? 'selected' : ''; ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php } ?>
                                  </select>
                              </div>
                            </div>
                        </div>
                      </form>
                      <form method="post" action="reporte_1.php">
                        <input type="hidden" name="status" value="<?php if(isset($status)){ echo $status;} ?>">
                        <input type="hidden" name="type" value="<?php if(isset($type)){ echo $type;} ?>">
                        <input type="hidden" name="cname" value="<?php if(isset($cname)){ echo $cname;} ?>">
                        <button class="btn btn-success btn-rounded">PDF</button>
                      </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                              <thead>
                                <tr>
                                  <th>Nombre del Vehiculo</th>
                                  <th>Servicio</th>
                                  <th>Horas Actual</th>
                                  <th>Intervalo</th>
                                  <th>Proximo Mantenimiento</th>
                                  <th>Horas Restantes</th>
                                  <th>Fecha</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP
                                $i=1;
                                foreach ($arrUser as $key => $value) {

                                  $status = ($value['stat'] == 1) ? 'Active' : 'In Active';
                                  /*$tot = $value['liters'] *  $value['price'];*/
                                ?>
                              <tr>
                                  <td class="tbdata"> <?php echo $value['VehName']?> </td>
                                  <td class="tbdata"> <?php echo $value['service']?> </td>
                                  <td class="tbdata"> <?php echo $value['meterinterval']?> </td>
                                  <td class="tbdata"> <?php echo $value['tieminterval']?> </td>
                                  <td class="tbdata"> <?php echo $value['meterthreshold']?> </td>
                                  <td class="tbdata"> <?php echo $value['meterthreshold']-$value['meterinterval'];?> </td>
                                  <td class="tbdata"> <?php echo $value['fecha_update']?> </td>
                                  <td>
                                    <button type="button" onclick="window.location='edit-service-reminder.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Edit</button>
                                    <button type="button" onclick="window.location='register-service-reminder.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Completar</button>
                                  </td>
                              </tr>
                              <?php
                                $i++;
                              }
                              ?>
                              </tbody>
                            </table>
                        </div>
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
