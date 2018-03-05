<?php
    ob_start();
    include("include/config.php");
    include("include/defs.php");
     require_once('mpdf/mpdf.php');
     $mpdf = new mPDF('c', 'A4-L');
     $mpdf->shrink_tables_to_fit = 1;
     $mpdf->setFooter('{PAGENO}');

     $arrUser = GetRecord("requisition", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
     $arrUserSoli = GetRecord("employee", "id = ".$arrUser['request_by']);

     $html = '<h3>Requisicion Aprobada</h3>
              <label><b>Fecha de Solicitud :</b> '.$arrUser['request_date'].'</label><br>
              <label><b>Orden de trabajo:</b> '.$arrUser['wo_no'].'</label><br>
              <label><b>Departamento:</b> '.$arrUser['department'].'</label><br>
              <label><b>Solicitado Por:</b> '.$arrUserSoli['firstname'].' '.$arrUserSoli['lastname'].'</label><br>
              <label><b>Notas:</b> '.$arrUser['notes'].'</label><br>
              <br>
              <table border="1">
                <thead>
                  <tr>
                    <th>Item Id</th>
                    <th>Item Descripcion</th>
                    <th>Stock</th>
                    <th>Cantidad</th>
                    <th>Comprados</th>
                    <th>Unidad de Medida</th>
                  </tr>
                </thead>
                <tbody>';

                  $arrOppDetail = GetRecords("select requisition_detail.* from requisition_detail
                                               where id_req = ".$arrUser['id']);
                  foreach ($arrOppDetail as $key => $value) {

                    $hdata = $value['id_item']."!".$value['stock']."!".$value['qty']."!".$value['buy']."!".$value['itmdesc']."!".$value['unitmeasure'];
                    if($value['id_item'] == -1)
                      $itm = "Not in Inventory";
                    else
                      $itm = $value['id_item'];

              $html .= '<tr>
                        <td>'.$itm.'</td>
                        <td>'.$value['itmdesc'].'</td>
                        <td>'.$value['stock'].'</td>
                        <td>'.$value['qty'].'</td>
                        <td>'.$value['buy'].'</td>
                        <td>'.$value['unitmeasure'].'</td>
                      </tr>';
                  }

              $html .= '</tbody>
             </table>
             <br>
             <br>
             <br>
             <div style="text-align:center;">
             ___________________________________________<br>
             Firmar del solicitante
             </div>';



    $mpdf -> writeHTML($html);
    $mpdf -> Output('Reporte.pdf', 'I');?>
