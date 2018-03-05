<?php
  ob_start();
  include("include/config.php");
  include("include/defs.php");
	include("excel_lib.php");
	$xls = new ExcelWriter();
	$xls_int = array('type'=>'int');
	$xls_date = array('type'=>'date');
	$arr = array('Nombre del vehiculo',
               'Asignado En',
               'Prioridad',
               'Resumen');
 $arrOrder = GetRecords("SELECT fleet_issue.*, vehicle.name as VehName
                        from fleet_issue
                        inner join vehicle on vehicle.id = fleet_issue.id_vehicle");
	$xls->OpenRow();
	foreach($arr as $cod=>$val)	$xls->NewCell($val,false,array('bold'=>true));
	$xls->CloseRow();

    foreach ($arrOrder as $key => $value) {
      $xls->OpenRow();
			$xls->NewCell($value['VehName']);
			$xls->NewCell($value['reportedOn']);
			$xls->NewCell($arrPriority[$value['id_priority']]);
      $xls->NewCell($value['summary']);
      $xls->CloseRow();
    }

	$xls->GetXLS();
?>
