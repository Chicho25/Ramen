<?php 
    ob_start();
    $reportclass="class='active'";
    $reporviewclass="class='active'";
    
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
        $where.=" and  (vehicle.name LIKE '%".$_POST['cname']."%' OR workorder.assigneddate LIKE '%".$_POST['cname']."%' OR workorder.id like '%".$_POST['cname']."%' )";
        $name = $_POST['cname'];
      }
      if(isset($_POST['status']) && $_POST['status'] != "")
      {
        $where.=" and  workorder.stat =  ".$_POST['status'];
        $status = $_POST['status'];
      }
      else
      {
        $where.=" and  workorder.stat =  1";
        $status = 1;
      }
      
      $arrUser = GetRecords("SELECT workorder.*, vehicle.name as VehName
                            from workorder
                            inner join vehicle on vehicle.id = workorder.id_vehicle

                              $where
                             and workorder.isCompleted =  0
                             order by vehicle.name");
     
?>
     <?php 
      /*$bcName = "Work Order List";
      include("breadcrumb.php") ;*/
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Listado de Pre-Ordenes de Trabajo</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-examplewithSearch">
                              <thead>
                                <tr>
                                  <th>Id de Orden</th>
                                  <th>Nombre del Vehiculo</th>
                                  <th>Fecha de Asignacion</th>
                                  <th>Estado</th>
                                  <th>Prioridad</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP  
                                $i=1;
                                foreach ($arrUser as $key => $value) {
                                  $status = ($value['stat'] == 1) ? 'Active' : 'In Active';
                                ?> 
                              <tr> 
                                  <td class="tbdata"> <?php echo $value['id']?> </td>
                                  <td class="tbdata"> <?php echo $value['VehName']?> </td>
                                  <td class="tbdata"> <?php echo $value['assigneddate']?> </td>
                                  <td class="tbdata"><?php echo $arrWOStatus[$value['id_status']]?> </td>
                                  <td class="tbdata"> <?php echo $arrPriority[$value['id_priority']]?> </td>
                                  <td> 
                                    <button type="button" onclick="window.location='result_report1.php?id=<?php echo $value['id']?>';" class="btn green btn-info"><i class="fa fa-file-pdf-o"></i></button> 
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
