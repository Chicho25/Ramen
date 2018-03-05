<?php

ob_start();

$fleetclass="class='active'";
$editWorkOrderclass="class='active'";
include("include/config.php");
include("include/defs.php");
$loggdUType = current_user_type();
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tayron Perez');
$pdf->SetTitle("Reporte Orden de Trabajo");

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 0, 10, false);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('Helvetica', '', 10);
$pdf->addPage();

$arrUser = GetRecord("workorder", "id = ".$_REQUEST['id']);
$arrKindMeetings = GetRecords("Select * from vehicle where stat=1 and id = '".$arrUser['id_vehicle']."'");

foreach ($arrKindMeetings as $key => $value) {
        $mane_veicle = $value['name'];}

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

    $content .='<table border="0" cellpadding="5">
      <thead>
        <tr>
          <th>FECHA DE INICIO:</th>
          <th>'.$arrUser['createdOn'].'</th>
          <th>HORA DE INICIO:</th>
          <th>'.$arrUser['start_hour'].'</th>
        </tr>
      </thead>
      <tr>
        <td>VEHICULO:</td>
        <td>'.$mane_veicle.'</td>
        <td>SECCION DEL VEHICULO:</td>
        <td>'.$seccion.'</td>
      </tr>
      <tr>
        <td>HORAS SUPER:</td>
        <td>'.$horas_seccion.'</td>
        <td>KM CARRIER:</td>
        <td>'.$odometro.'</td>
      </tr>
      </table>';

      $content .='<table border="0" cellpadding="5">
                    <thead>
                      <tr>
                        <th>PERSONA A CARGO:</th>
                        <th>'.$mane_charge.'</th>
                        <th>MECANICO ASIGNAGO 2:</th>
                        <th>'.$mane_mecanico2.'</th>
                      </tr>
                    </thead>
                    <tr>
                      <td>MECANICO ASIGNAGO 1:</td>
                      <td>'.$mane_mecanico1.'</td>
                      <td>MECANICO ASIGNAGO 3:</td>
                      <td>'.$mane_mecanico3.'</td>
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

      $content .='<h3>PROBLEMAS RELACIONADOS:</h3>';

$content .= '';

      if($arrUser['relatedIssues'] != "")
      {
        $expRelIssues = explode(",", $arrUser['relatedIssues']);
        $arrIssues = GetRecords("SELECT id, summary, description from fleet_issue
                    where id_vehicle = ".$arrUser['id_vehicle']." and stat = 1 order by id");

        /*$content .="<tr>
                      <th><b>Titulo</b></th>
                      <th><b>Descripcion</b></th>
                    </tr>";*/

        foreach ($arrIssues as $key => $value) {
          $content .='<table border="1" cellpadding="5">
                      <tr>
                        <th>Issue # '.$value['id'].' - '.$value['summary'].'</th>
                      </tr>
                      <tr>
                        <th>'.$value['description'].'</th>
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
        }

      }else{
/*$content .='<tr>
              <th></th>
            </tr>'; */
      }
/*$content .='</table>';*/

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
$pdf->output('Reporte_1.pdf', 'I');



 ?>
