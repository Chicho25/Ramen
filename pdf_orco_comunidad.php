<?php
ob_start();
include("include/config.php");
include("include/defs.php");

$where = "where (1=1)";
$where2 = "where (1=1)";

  if(isset($_POST['desde']) && $_POST['desde'] != "")
  {
    $where.=" and inventory_adjustment.date >= '".$_POST['desde']."'";
    $where2.=" and requisition.request_date >= '".$_POST['desde']."'";
    $desde = $_POST['desde'];
  }
  if(isset($_POST['hasta']) && $_POST['hasta'] != "")
  {
    $where.=" and inventory_adjustment.date <= '".$_POST['hasta']."'";
    $where2.=" and requisition.request_date <= '".$_POST['hasta']."'";
    $hasta = $_POST['hasta'];
  }

  if(isset($_POST['id_type']) && $_POST['id_type'] == 1)
  {
    $where.="";
    $id_type = $_POST['id_type'];
  }elseif(isset($_POST['id_type']) && $_POST['id_type'] == 2){
    $where2.=" and requisition.stat = 1";
    $id_type = $_POST['id_type'];
  }

  if(isset($_POST['id_type_item']) && $_POST['id_type_item'] != '')
  {
    $where.=" and items.id_type =".$_POST['id_type_item'];
    $where2.=" and items.id_type =".$_POST['id_type_item'];
    $id_type_items = $_POST['id_type_item'];
  }

  if(isset($id_type) && $id_type == 1){

    $arrUser = GetRecords("select
                              inventory_adjustment.date as fecha,
                              inventory_adjustment.reason as motivo,
                              location.description as localidad,
                              inventory_adjustment.reference as referencia,
                              items.description as nombre_item,
                              inventory_adjustment.qty as cantidad_ingresada_solicitada,
                              inventory_adjustment.qty_in_hand as cantidad_actual,
                              inventory_adjustment.qty_new as nueva_cantidad_restante,
                              inventory_adjustment.value,
                              'Ingreso' as stat,
                              1 as tipo,
                              '-' as nombre,
                              '-' as apellido
                              from
                              inventory_adjustment inner join items on items.id = inventory_adjustment.id_item
                                                   inner join location on location.id = inventory_adjustment.id_warehouse
                              $where
                              order by 1 desc");

  }elseif(isset($id_type) && $id_type == 2){

    $arrUser = GetRecords("select
                              requisition.request_date as fecha,
                              requisition.notes as motivo,
                              location.description as localidad,
                              requisition.department as referencia,
                              items.description as nombre_item,
                              requisition_detail.qty as cantidad_ingresada_solicitada,
                              requisition_detail.stock as cantidad_actual,
                              (requisition_detail.stock - requisition_detail.qty) as nueva_cantidad_restante,
                              '-' as value,
                              'Salida' as stat,
                              0 as tipo,
                              employee.firstname as nombre,
                              employee.lastname as apellido
                              from requisition inner join location on location.id = requisition.id_warehouse
                                               inner join employee on employee.id = requisition.request_by
                                               inner join requisition_detail on requisition.id = requisition_detail.id_req
                                               inner join items on requisition_detail.id_item = items.id
                              $where2
                              order by 1 desc");

  }else{

  $arrUser = GetRecords("(select
                            inventory_adjustment.date as fecha,
                            inventory_adjustment.reason as motivo,
                            location.description as localidad,
                            inventory_adjustment.reference as referencia,
                            items.description as nombre_item,
                            inventory_adjustment.qty as cantidad_ingresada_solicitada,
                            inventory_adjustment.qty_in_hand as cantidad_actual,
                            inventory_adjustment.qty_new as nueva_cantidad_restante,
                            inventory_adjustment.value,
                            'Ingreso' as stat,
                            1 as tipo,
                            '-' as nombre,
                            '-' as apellido
                            from
                            inventory_adjustment inner join items on items.id = inventory_adjustment.id_item
                                                 inner join location on location.id = inventory_adjustment.id_warehouse
                            $where
                            )union(
                            select
                            requisition.request_date as fecha,
                            requisition.notes as motivo,
                            location.description as localidad,
                            requisition.department as referencia,
                            items.description as nombre_item,
                            requisition_detail.qty as cantidad_ingresada_solicitada,
                            requisition_detail.stock as cantidad_actual,
                            (requisition_detail.stock - requisition_detail.qty) as nueva_cantidad_restante,
                            '-' as value,
                            'Salida' as stat,
                            0 as tipo,
                            employee.firstname as nombre,
                            employee.lastname as apellido
                            from requisition inner join location on location.id = requisition.id_warehouse
                                             inner join employee on employee.id = requisition.request_by
                                             inner join requisition_detail on requisition.id = requisition_detail.id_req
                                             inner join items on requisition_detail.id_item = items.id
                            $where2)
                            order by 1 desc"); }

require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tayron Perez');
$pdf->SetTitle("Reporte de Inventario");

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10, false);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('Helvetica', '', 10);
$pdf->addPage();

$content = '';

$content .= '
  <div class="row">
        <div class="col-md-12">
            <h1 style="text-align:center;">GRUAS SHL</h1>
            <div style="background-color:gray; height:10px;"><span style="text-align:center; height:10px; color:white;"><b>Reporte de Inventario</b></span></div>
            <h5 style="text-align:center;">RUC: 1021630-1-540548  DV: 50 - CORREO: plataformas@gruasshl.com</h5>
            <h5 style="text-align:center;">Telefonos: 231-5818 / 231-6811</h5>';

$content .='<table border="0" cellpadding="5">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              </table>';

    $content .='<table border="1" cellpadding="5">
                <thead>
                  <tr>
                    <th colspan="8" align="center">FILTROS</th>
                  </tr>
                  <tr>
                    <th>FECHA DESDE:</th>
                    <th>'.$_POST['desde'].'</th>
                    <th>FECHA HASTA:</th>
                    <th>'.$_POST['hasta'].'</th>
                    <th>TIPO DE ITEM:</th>';
                    if($_POST['id_type_item']!=''){
                    $tipos = GetRecords("SELECT * FROM item_types WHERE id=".$_POST['id_type_item']);
                    $descripcon = $tipos[0]['description'];
                  }else{ $descripcon=""; }
                    if(isset($_POST['id_type']) && $_POST['id_type']==1){ $entsal="Ingreso"; }
                    elseif($_POST['id_type']==2){ $entsal="Salida"; }
                    else{ $entsal=""; }
                    $content .='<th>'.$descripcon.'</th>
                    <th>ENTR/SAL:</th>
                    <th>'.$entsal.'</th>
                  </tr>
                </thead>
                </table>';

                $content .='<table border="0" cellpadding="5">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>
                              </table>';

                $content .='<table border = "1" class="table table-striped table-bordered table-hover dataTables-example">
                              <thead>
                                <tr>
                                  <th>Fecha</th>
                                  <th>Motivo</th>
                                  <th>Localidad</th>
                                  <th>Item</th>
                                  <th>Costo</th>
                                  <th>Tipo</th>
                                  <th>C. Ingresada</th>
                                  <th>C. Solicitada</th>
                                  <th>Stock</th>
                                  <th>Actual</th>
                                  <th>Solisitado Por</th>
                                </tr>
                              </thead>
                              <tbody>';

      foreach ($arrUser as $key => $value) {

        $content.='<tr>
                      <td class="tbdata"> '.$value['fecha'].'</td>
                      <td class="tbdata"> '.$value['motivo'].'</td>
                      <td class="tbdata"> '.$value['localidad'].'</td>
                      <td class="tbdata"> '.$value['nombre_item'].'</td>
                      <td class="tbdata"> '.$value['value'].'</td>
                      <td class="tbdata"> '.$value['stat'].'</td>
                      <td class="tbdata"> '.$value['cantidad_ingresada_solicitada'].'</td>
                      <td class="tbdata"> '.$value['cantidad_ingresada_solicitada'].'</td>
                      <td class="tbdata"> '.$value['cantidad_actual'].'</td>
                      <td class="tbdata"> '.$value['nueva_cantidad_restante'].'</td>
                      <td class="tbdata"> '.$value['nombre'].' '.$value['apellido'].'</td>
                  </tr>';
              }
        $content.='</tbody>
        </table>';

        $content .='<table border="0" cellpadding="5">
                      <thead>
                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      </table>';

$content .='<table border="0" cellpadding="5">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              </table>';

$content .= '<div class="row padding">
                <div class="col-md-12" style="text-align:center;">
                    <span>Gruas SHL </span>
                  </div>
              </div>

';

$pdf->writeHTML($content, true, 0, true, 0);

$pdf->lastPage();
$pdf->output('Reporte_Inventario.pdf', 'I');



 ?>
