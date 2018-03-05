<?php

ob_start();

$fleetclass="class='active'";
$editPreWorkOrderclass="class='active'";
include("include/config.php");
include("include/defs.php");
$loggdUType = current_user_type();
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tayron Perez');
$pdf->SetTitle("Reporte Orden de Trabajo");
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('Helvetica', '', 10);
$pdf->addPage();
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
/*
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gruas SHL');
$pdf->SetTitle('Gruas SHL');
$pdf->SetSubject('Issue');
$pdf->SetKeywords('SHL, Tayron, PHP, Computo, SHL');
// establecemos los datos del encabezado que tendrán las páginas del PDF
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// establecemos el tipo de letra que se ocupara en el encabezado y píe de página
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// establecemos la medida del interlineado
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// establecemos las medidas de los margenes
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//establecemos que haga un salto de página cada vez que el contenido del PDF sobre
  // pase el límite del margen inferior
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// establecemos que ajuste las imagenes cuando sea muy grande y se salga de los límites
//   de los margenes
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// agregamos una página
$pdf->AddPage();
*/
$arrUser = GetRecord("workorder", "id = ".$_REQUEST['id']);
$arrKindMeetings = GetRecords("Select * from vehicle where stat=1 and id = '".$arrUser['id_vehicle']."'");

$arrOrden = GetRecords("Select * from workorder where id = '".$_REQUEST['id']."'");
$costo_partes = $arrOrden[0]['costinparts'];
$horas_trabajadas = $arrOrden[0]['thirdpartylaborhr'];
$costo = $arrOrden[0]['costinthirdparty'];
$bitacora = $arrOrden[0]['worktoperformed'];
$referencia = $arrOrden[0]['reference'];

foreach ($arrKindMeetings as $key => $value) {
        $mane_veicle = $value['name'];
      }

$employees = GetRecords("Select * from employee where stat=1 and id = '".$arrUser['id_person_change']."'");

foreach ($employees as $key => $value) {
        $mane_charge = $value['firstname'].' '.$value['lastname'];
        }
        if(!isset($mane_charge)){
          $mane_charge="";
        }

$mecanico1 = GetRecords("Select * from employee where stat=1 and id = '".$arrUser['id_especialist1']."'");

foreach ($mecanico1 as $key => $value) {
        $mane_mecanico1 = $value['firstname'].' '.$value['lastname'];
      }
      if(!isset($mane_mecanico1)){
        $mane_mecanico1="";
      }

$mecanico2 = GetRecords("Select * from employee where stat=1 and id = '".$arrUser['id_especialist2']."'");

foreach ($mecanico2 as $key => $value) {
        $mane_mecanico2 = $value['firstname'].' '.$value['lastname'];
        }
        if(!isset($mane_mecanico2)){
          $mane_mecanico2="";
        }

$mecanico3 = GetRecords("Select * from employee where stat=1 and id = '".$arrUser['id_especialist3']."'");

foreach ($mecanico3 as $key => $value) {
        $mane_mecanico3 = $value['firstname'].' '.$value['lastname'];
        }
        if(!isset($mane_mecanico3)){
          $mane_mecanico3="";
        }

$mecanico4 = GetRecords("Select * from employee where stat=1 and id = '".$arrUser['id_especialist3']."'");

foreach ($mecanico4 as $key => $value) {
        $mane_mecanico4 = $value['firstname'].' '.$value['lastname'];
        }
        if(!isset($mane_mecanico4)){
          $mane_mecanico4="";
        }

$mecanico5 = GetRecords("Select * from employee where stat=1 and id = '".$arrUser['id_especialist3']."'");

foreach ($mecanico5 as $key => $value) {
        $mane_mecanico5 = $value['firstname'].' '.$value['lastname'];
        }
        if(!isset($mane_mecanico5)){
          $mane_mecanico5="";
        }

if($arrUser['id_vehsection']==1){
  $seccion = "Carrier";
}elseif($arrUser['id_vehsection']==2){
  $seccion = "Upper";
}else{
  $seccion = "";
}

if($arrUser['id_vehsection']==2){ $horas_seccion = $arrUser['enginehour'];}else{ $horas_seccion = ""; }
if($arrUser['id_vehsection']==1){$odometro = $arrUser['odometer'];}else{ $odometro = ""; }

$content = '';

$content .= '
  <div class="row">
        <div class="col-md-12">
            <h1 style="text-align:center;">GRUAS SHL</h1>
            <div style="background-color:gray; height:10px;"><span style="text-align:center; height:10px; color:white;"><b>ORDEN DE TRABAJO</b></span></div>
            <h5 style="text-align:center;">RUC: 1021630-1-540548  DV: 50 - CORREO: plataformas@salernoheavylift.com</h5>
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


    $content .='<table border="0" cellpadding="5">';

    if($arrUser['createdOn']!=""){
            $content .='<thead>
              <tr>
                <th>FECHA DE INICIO:</th>
                <th>'.$arrUser['createdOn'].'</th>
                <th></th>
                <th></th>
              </tr>
            </thead>';
    }


      $content .='<tr>';
      if($mane_veicle!=""){

        $content .='<td>VEHICULO:</td>
        <td>'.$mane_veicle.'</td>';

        }

      if($seccion!=""){

        $content .='<td>SECCION DEL VEHICULO:</td>
        <td>'.$seccion.'</td>';

        }

      $content .='</tr>
      <tr>';
        if($horas_seccion!=""){
        $content .='<td>HORAS SUPER:</td>
        <td>'.$horas_seccion.'</td>';
        }
        if($odometro!=""){
        $content .='<td>KM CARRIER:</td>
        <td>'.number_format($odometro).'</td>';
        }
      $content .='</tr>
      </table>';

      $content .='<table border="0" cellpadding="5">
                    <thead>
                      <tr>';
                        if($mane_charge!=""){
                        $content .='<th>PERSONA A CARGO:</th>
                        <th>'.$mane_charge.'</th>';
                      }else{
                        $content .='<th></th>
                                    <th></th>';
                      }
                        if($mane_mecanico1!=""){
                        $content .='<th>MECANICO ASIGNAGO 1:</th>
                        <th>'.$mane_mecanico1.'</th>';
                        }else{
                          $content .='<th></th>
                                      <th></th>';
                        }
                      $content .='</tr>
                    </thead>';

if($mane_mecanico2 !="" && $mane_mecanico3 !="" ){

                    $content .='<tr>';
                      if($mane_mecanico2!=""){
                      $content .='<td>MECANICO ASIGNAGO 2:</td>
                      <td>'.$mane_mecanico2.'</td>';
                    }else{
                      $content .='<td></td>
                                  <td></td>';
                    }
                      if($mane_mecanico3!=""){
                      $content .='<td>MECANICO ASIGNAGO 3:</td>
                      <td>'.$mane_mecanico3.'</td>';
                     }else{
                       $content .='<td></td>
                                   <td></td>';
                     }
                    $content .='</tr>';

}

        $content .='</table>';

if($mane_mecanico4 !="" && $mane_mecanico5 !="" ){

        $content .='<table border="0" cellpadding="5">
                      <thead>
                        <tr>';
                        if($mane_mecanico4!=""){
                          $content .='<th>MECANICO ASIGNAGO 4:</th>
                          <th>'.$mane_mecanico4.'</th>';
                        }else{
                          $content .='<th></th>
                                      <th></th>';
                        }
                        if($mane_mecanico5!=""){
                          $content .='<th>MECANICO ASIGNAGO 5:</th>
                          <th>'.$mane_mecanico5.'</th>';
                        }else{
                          $content .='<th></th>
                                      <th></th>';
                        }
                        $content .='</tr>
                      </thead>
                      </table>';

}

        $content .='<table border="0" cellpadding="5">
                      <thead>
                        <tr>
                          <th>COSTO EN PARTE:</th>
                          <th>'.$costo_partes.'</th>
                          <th>HORAS TRABAJADAS:</th>
                          <th>'.$horas_trabajadas.'</th>
                        </tr>
                      </thead>
                      <tr>
                        <td>COSTO:</td>
                        <td>'.$costo.'</td>
                      </tr>
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

      $content .='<h3>Bitacora de Trabajo:</h3>';

      $content .='<table border="1" cellpadding="5">
                  <tr>
                    <th>'.$bitacora.'</th>
                  </tr>
                  </table>';

      $content .='<h3>Issues Completados:</h3>';

      if($arrUser['relatedIssues'] != "")
      {
        $arrUser = GetRecord("workorder", "id = ".$_REQUEST['id']);

        if($arrUser['relatedIssues'] != "")
        {
          $expRelIssues = explode(",", $arrUser['relatedIssues']);
          $arrIssues = GetRecords("SELECT id, summary, description from fleet_issue
                      where id_vehicle = ".$arrUser['id_vehicle']." and stat = 0 order by id");

          $z = 0;
          foreach ($arrIssues as $key => $value) {

            $z++;

            if(in_array($value['id'], $expRelIssues)){


              $content .='<table border="1" cellpadding="5">
                          <tr>
                            <th>Issue # '.$value['id'].' - '.$value['summary'].'</th>
                          </tr>
                          <tr>
                            <th>'.$value['description'].'</th>
                          </tr>
                          </table>
                          <table border="0" cellpadding="5">
                            <tr>
                              <th></th>
                            </tr>
                          </table>';

                }

                if ($z==5) {
                    $content .='<table border="0" cellpadding="5">
                                  <tr>
                                    <th></th>
                                  </tr>
                                </table>';
                }
              }
            }
          }

/*$content .='<table border="0" cellpadding="5">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              </table>';*/

$content .='<h3>Referencia:</h3>';

$content .='<table border="1" cellpadding="5">
            <tr>
              <th>'.$referencia.'</th>
            </tr>
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

$content .='<h3>Requisiciones:</h3>';

if($arrUser['relatedIssues'] != "")
{
  $arrReq = GetRecords("SELECT id from requisition
              where wo_no = ".$arrUser['wo_no']." and is_Approved = 1 order by id");
  $html="";
  $content .='<table border="1" cellpadding="5">
                <thead>';
  foreach ($arrReq as $key => $value) {
  $content.="<tr><th>Req #".$value['id']."</th></tr>";
  }
  $content .='</thead>
            </table>';
}

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
                <tr>';
                  if($mane_mecanico1!=""){
                  $content .='<th>_________________</th>';
                  }
                  $content .='<th></th>';
                  if($mane_mecanico2!=""){
                  $content .='<th>_________________</th>';
                  }
                  $content .='<th></th>';
                  if($mane_mecanico3!=""){
                  $content .='<th>_________________</th>';
                  }
                $content .='</tr>';

                $content .='<tr>';
                  if($mane_mecanico1!=""){
                  $content .='<th style="text-align:center">FIRMA MEC.1</th>';
                  }
                  $content .='<th></th>';
                  if($mane_mecanico2!=""){
                  $content .='<th style="text-align:center">FIRMA MEC.2</th>';
                  }
                  $content .='<th></th>';
                  if($mane_mecanico3!=""){
                  $content .='<th style="text-align:center">FIRMA MEC.3</th>';
                  }
                $content .='</tr>
              </thead>
              </table>';

if($mane_mecanico4 !="" && $mane_mecanico5 !="" ){
$content .='<table border="0" cellpadding="5">
              <thead>
                <tr>
                  <th></th>
                  <th>_________________</th>
                  <th></th>
                  <th>_________________</th>
                  <th></th>
                </tr>
                <tr>
                  <th></th>
                  <th style="text-align:center">FIRMA MEC.4</th>
                  <th></th>
                  <th style="text-align:center">FIRMA MEC.5</th>
                  <th></th>
                </tr>
              </thead>
              </table>';
}

$content .='<table border="0" cellpadding="5">
              <thead>
                <tr>
                  <th></th>
                  <th>_____________________________</th>
                  <th></th>
                </tr>
                <tr>
                <th></th>
                <th style="text-align:center">FIRMA PERSONAL A CARGO</th>
                <th></th>
                </tr>
              </thead>
              </table>';

$content .= '<div class="row padding">
                <div class="col-md-12" style="text-align:center;">
                    <span>Gruas SHL </span>
                  </div>
              </div>';

$pdf->writeHTML($content, true, 0, true, 0);
$pdf->lastPage();
$pdf->output('Reporte_1.pdf', 'I');?>
