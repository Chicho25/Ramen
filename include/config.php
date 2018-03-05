<?php
	$DB_Server = "localhost";
	$DB_Username ="Ramenplus";
	$DB_Password = "*lxLzwVw)R.C";
	$DB_DBName = "Ramenplus";
	
	$arrStatus = array("1" => "Active", "2" => "Pending", "3" => "Won", "4" => "Lost", "5" => "Cancelled", "6" => "Finished");
	
	$arrJobStatus = array("1" => "Scheduled Job", "2" => "Completed Job", "3" => "Potential Job", "4" => "Cancelled Job", "5" => "Maintenance", "6" => "Completed Maintenance", "7" => "Appointment", "8" => "Completed Appointment", "9" => "Vacation", "10" => "Completed Vacation");

	$arrUnits = array('1' => "US", '2' => "Metrics");
	$arrPermits = array('1' => "Not Needed", '2' => "Not Ordered", '3' => 'On Order', '4' => 'Received');
	$arrVehSection = array('' => '---Select---', '1' => 'Carrier', '2' => 'Upper');
	$arrFuelGrades = array('' => '---Select---', '1' => 'DIESEL', '2' => 'GASOLINE 91', '3' => 'GASOLINE 95');
	$arrWOTypes = array('1' => "Repair", '2' => "Maintenance", "3" => "Improvements");
	$arrWOStatus = array('1' => "Open", '2' => "Waiting for parts - Down", "3" => "Waiting for parts - Rolling");
	$arrPriority = array('1' => "Urgent", '2' => "Important");
	$arrThreshold = array('Day' => "Day", 'Week' => "Week", "Month" => "Month", "Year" => "Year");
	$arrInvPOTerms = array('1' => 'PIA Payment in advance', '2' => 'Net 7 Payment seven days after invoice date', '3' => 'Net 10 Payment ten days after invoice date', '4' => 'Net 30 Payment 30 days after invoice date', '5' => 'Net 60 Payment 60 days after invoice date', '6' => 'Net 90 Payment 90 days after invoice date', '7' => 'EOM End of month');
///////////////////////////////////////////////////////////////////////////////////////
?>