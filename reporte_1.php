<?php
    ob_start();
    include("include/config.php");
    include("include/defs.php");
     require_once('mpdf/mpdf.php');
     $mpdf = new mPDF('c', 'A4-L');
     $where = "where (1=1)";
       $name = "";
       if(isset($_POST['cname']) && $_POST['cname'] != "")
       {
         $where.=" and  (vehicle.name LIKE '%".$_POST['cname']."%' OR service_reminder.metertdreshold LIKE '%".$_POST['cname']."%' OR service_reminder.service LIKE '%".$_POST['cname']."%' OR service_reminder.tiemtdreshold LIKE '%".$_POST['cname']."%' ) ";
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
                       $html = '';
                       $html .= '<h1>Reporte de Servicio</h1>
                                 <table border="1">
                                     <tr>
                                       <td>Nombre del Vehiculo</td>
                                       <td>Servicio</td>
                                       <td>Horas Actual</td>
                                       <td>Intervalo</td>
                                       <td>Proximo Mantenimiento</td>
                                       <td>Horas Restantes</td>
                                       <td>Fecha</td>
                                     </tr>';
                  foreach ($arrUser as $key => $value) {
                            $html .= '<tr>
                                       <td>'.$value["VehName"].'</td>
                                       <td>'.$value["service"].'</td>
                                       <td>'.$value['meterinterval'].'</td>
                                       <td>'.$value['tieminterval'].'</td>
                                       <td>'.$value['meterthreshold'].'</td>
                                       <td>'.($value['meterthreshold']-$value['meterinterval']).'</td>
                                       <td>'.$value['fecha_update'].'</td>
                                     </tr>';
                                   }
                           $html .= '
                         </table>';
    $mpdf -> writeHTML($html);
    $mpdf -> Output('Reporte.pdf', 'I');
    ?>
