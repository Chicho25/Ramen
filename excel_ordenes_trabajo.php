<?php
  ob_start();
  include("include/config.php");
  include("include/defs.php");
	include("excel_lib.php");
	$xls = new ExcelWriter();
	$xls_int = array('type'=>'int');
	$xls_date = array('type'=>'date');
	$arr = array('ID Orden de trabajo',
               'Nombre del vehiculo',
               'Asignado En',
               'Status',
               'Prioridad');
 $arrOrder = GetRecords("SELECT workorder.*, vehicle.name as VehName
                         from workorder
                         inner join vehicle on vehicle.id = workorder.id_vehicle");
	$xls->OpenRow();
	foreach($arr as $cod=>$val)	$xls->NewCell($val,false,array('bold'=>true));
	$xls->CloseRow();

    foreach ($arrOrder as $key => $value) {
      $xls->OpenRow();
			$xls->NewCell($value['id']);
			$xls->NewCell($value['VehName']);
			$xls->NewCell($value['assigneddate']);
      if($value['isCompleted'] != 1) :
			$xls->NewCell($arrWOStatus[$value['id_status']]);
      else :
      $xls->NewCell('Completado');
      endif;
      $xls->NewCell($arrPriority[$value['id_priority']]);
      $xls->CloseRow();
    }

	$xls->GetXLS();
?>
