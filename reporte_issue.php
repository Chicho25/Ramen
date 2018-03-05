<?php
    ob_start();
    include("include/config.php");
    include("include/defs.php");
     require_once('mpdf/mpdf.php');
     $mpdf = new mPDF('c', 'A4-L');
     $mpdf->shrink_tables_to_fit = 1;
     $mpdf->setFooter('{PAGENO}');

      $vehiculos = GetRecords("SELECT
                                fleet_issue.id_vehicle,
                                vehicle.name as VehName
                                from fleet_issue
                                inner join vehicle on vehicle.id = fleet_issue.id_vehicle
                                where
                                fleet_issue.stat =  1
                                group by
                                fleet_issue.id_vehicle,
                                vehicle.name
                                order by vehicle.name");

                          $html = '';
                          $html = '<h1>Lista de Issue</h1>';
                     foreach ($vehiculos as $key => $valueV) {
                       $html .= '<h2>'.$valueV["VehName"].'</h2>';

                            $arrUser = GetRecords("SELECT
                                                   fleet_issue.id,
                                                   vehicle.name as VehName,
                                                   fleet_issue.reportedOn,
                                                   fleet_issue.id_priority,
                                                   fleet_issue.summary,
                                                   fleet_issue.description
                                                   from fleet_issue
                                                   inner join vehicle on vehicle.id = fleet_issue.id_vehicle
                                                   where
                                                   fleet_issue.stat = 1
                                                   and
                                                   vehicle.id = '".$valueV['id_vehicle']."'
                                                   order by vehicle.name");

                                            $html .= '<table border="1" autosize="1">
                                                          <tr>
                                                            <td>Fecha Reportado</td>
                                                            <td>Prioridad</td>
                                                            <td>Resumen</td>
                                                            <td>Descripcion</td>
                                                          </tr>';
                                       foreach ($arrUser as $key => $value) {
                                                 $html .= '<tr>
                                                            <td>'.$value["reportedOn"].'</td>
                                                            <td>'.$value['id_priority'].'</td>
                                                            <td>'.$value['summary'].'</td>
                                                            <td>'.$value['description'].'</td>
                                                          </tr>';
                                                        }
                                                $html .= '
                                              </table>';
                                      }


    $mpdf -> writeHTML($html);
    $mpdf -> Output('Reporte.pdf', 'I');
    ?>
