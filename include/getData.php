<?php
	include("config.php"); 
    include("defs.php");
	
	
	$loggdUType = current_user_type();
	$reqType = $_POST['reqtype'];
	switch($reqType)
	{
		
		case "getresources":

			$type = $_POST['type'];
			$val = $_POST['val'];
			$dtype = $_POST['dtype'];
			$jType = $_POST['jType'];
			$whjType = ($jType != "") ? " and jobs.status IN (".$jType.")" : '';
			$Qryinner = "";
			if($type == "vehicle")
			{
				if($dtype != "" || $val != "")
				{
					$whr = " where 1=1";
					if($dtype != "")
						$whr.=" and vehicle.type = ".$dtype;		
					if($val != "")
						$whr.=" and vehicle.id = ".$val;		

					$Qryinner = "INNER join
								   (
								   		Select distinct jobs.id from jobs 
								   		inner join jobs_resource_vehicle on jobs_resource_vehicle.id_job = jobs.id
								   		inner join vehicle on vehicle.id = jobs_resource_vehicle.id_vehicle
								   		inner join type_vehicle on type_vehicle.id = vehicle.type
								   		$whr $whjType
								   ) tblVehRes ON tblVehRes.id = jobs.id";

				}
				
			}
			else if($type == "employee") 
			{
				if($dtype != "" || $val != "")
				{
					$whr = " where 1=1";
					if($dtype != "")
						$whr.=" and $dtype = 1";		
					if($val != "")
						$whr.=" and employee.id = ".$val;	

					$Qryinner = "INNER join
								   (
								   		Select distinct jobs.id from jobs 
								   		inner join jobs_resource_employee on jobs_resource_employee.id_job = jobs.id
								   		inner join employee on employee.id = jobs_resource_employee.id_employee
								   		$whr $whjType
								   ) tblEmpRes ON tblEmpRes.id = jobs.id";
				}
				
			}
			
			$arrData= array();
			$arrjobs = GetRecords("SELECT jobs.id, jobs.ticketid, jobs.project, jobs.startdate from jobs								   
									$Qryinner
									where 1=1 $whjType
								   ");
			
			 $year = date('Y'); 
   			 $month = date('m');	
			foreach ($arrjobs as $key => $value) {
		        $arrJob = array('title' => $value['project'], 'start' => $value['startdate'], 'url' => 'edit-jobs.php?id='.$value['id'] );
		        $arrData[] = $arrJob;
		      }
		      echo json_encode($arrData);
		break;

		case "getqtyinhand":

			$warehouseid = $_POST['warehouse'];
			$itemId = $_POST['itemid'];
			if($itemId > 0)
			{
				$getQtyInHand = getInventoryItemQty($warehouseid, $itemId);
				
				if($getQtyInHand > 0)
					echo $getQtyInHand;
				else
					echo 0;
			}	
		break;

		case "getitemdetailwithstock":

			$warehouseid = $_POST['warehouse'];	
			$itemId = $_POST['id'];
			if($itemId > 0)
			{
				$getRecord = GetRecord("items", "id = ".$itemId);
				$getQtyInHand = getInventoryItemQty($warehouseid, $itemId);
				$getQtyInHand = ($getQtyInHand > 0) ? $getQtyInHand : 0;
				
				$arr = array();
				$arr[0] = $getRecord['id'];
				$arr[1] = $getRecord['description'];
				$arr[2] = $getRecord['unitofmeasure'];
				$arr[3] = $getRecord['lastunitcost'];
				$arr[4] = $getQtyInHand;
				echo json_encode($arr);
			}	
		break;

		case "getitemdetail":

			$itemId = $_POST['id'];
			if($itemId > 0)
			{
				$getRecord = GetRecord("items", "id = ".$itemId);
				
				$arr = array();
				$arr[0] = $getRecord['id'];
				$arr[1] = $getRecord['description'];
				$arr[2] = $getRecord['unitofmeasure'];
				$arr[3] = $getRecord['lastunitcost'];

				echo json_encode($arr);
			}	
		break;
		// case "getQtyInHand":
		// 	$vehId = $_POST['id'];
		// 	if($vehId > 0)
		// 	{
		// 		$arrIssues = GetRecords("SELECT sum(qty_in_hand) from inventory_adjustment 
		// 								where id_item = ".$vehId." ");
		// 		$html="";
		// 		foreach ($arrIssues as $key => $value) {

		// 			$html.="<p><input type='checkbox' name='woissues[]' value='".$value['id']."'> Issue #".$value['id']." - ".$value['summary']."</p>";

		// 		}
		// 		echo $html;
				
		// 	}	
		// break;
		case "getwoissues" : 
			$vehId = $_POST['id'];
			if($vehId > 0)
			{
				$arrIssues = GetRecords("SELECT id, summary from fleet_issue 
										where id_vehicle = ".$vehId." and stat = 1 and isClosed != 1 order by id");
				$html="";
				foreach ($arrIssues as $key => $value) {

					$html.="<p><input type='checkbox' name='woissues[]' value='".$value['id']."'> Issue #".$value['id']." - ".$value['summary']."</p>";

				}
				echo $html;
				
			}	
		break;

		case "getlastfuelodometer" : 
			$regId = $_POST['id'];
			$sectype = $_POST['sectype'];
			if($regId > 0)
			{
				$arrUser = GetRecords("SELECT odometer as odm, enginehour from odometer_history 
										where id_vehicle = ".$regId." and id_vehsection = ".$sectype." order by id desc limit 1");
				if(isset($arrUser[0]['odm']) && $arrUser[0]['odm'] != 0)
					echo $arrUser[0]['odm'].":".$arrUser[0]['enginehour'];
				else
				{
					$arrUser = GetRecords("SELECT odometer as odm, carrierengine, upperengine from vehicle 
											where id = ".$regId);
					if(isset($arrUser[0]['odm']) && $arrUser[0]['odm'] != 0)
					{
						if($sectype == 1)
							echo $arrUser[0]['odm'].":".$arrUser[0]['carrierengine'];
						else
							echo $arrUser[0]['odm'].":".$arrUser[0]['upperengine'];
					}
					else
						echo 0;
				}
			}	
		break;

		case "getlastWOodometer" : 
			$regId = $_POST['id'];
			$sectype = $_POST['sectype'];
			if($regId > 0)
			{
				$arrUser = GetRecords("SELECT odometer as odm, enginehour from odometer_history 
										where id_vehicle = ".$regId." and id_vehsection = ".$sectype." order by id desc limit 1");
				if(isset($arrUser[0]['odm']) && $arrUser[0]['odm'] != 0)
					echo $arrUser[0]['odm'].":".$arrUser[0]['enginehour'];
				else
				{
					$arrUser = GetRecords("SELECT odometer as odm, carrierengine, upperengine from vehicle 
											where id = ".$regId);
					if(isset($arrUser[0]['odm']) && $arrUser[0]['odm'] != 0)
					{
						if($sectype == 1)
							echo $arrUser[0]['odm'].":".$arrUser[0]['carrierengine'];
						else
							echo $arrUser[0]['odm'].":".$arrUser[0]['upperengine'];
					}
					else
						echo 0;
				}
				
			}	
		break;

		case "getlastFleetIssueodometer" : 
			$regId = $_POST['id'];
			$sectype = $_POST['sectype'];
			if($regId > 0)
			{
				$arrUser = GetRecords("SELECT odometer as odm, enginehour from odometer_history 
										where id_vehicle = ".$regId." and id_vehsection = ".$sectype." order by id desc limit 1");
				if(isset($arrUser[0]['odm']) && $arrUser[0]['odm'] != 0)
					echo $arrUser[0]['odm'].":".$arrUser[0]['enginehour'];
				else
				{
					$arrUser = GetRecords("SELECT odometer as odm, carrierengine, upperengine from vehicle 
											where id = ".$regId);
					if(isset($arrUser[0]['odm']) && $arrUser[0]['odm'] != 0)
					{
						if($sectype == 1)
							echo $arrUser[0]['odm'].":".$arrUser[0]['carrierengine'];
						else
							echo $arrUser[0]['odm'].":".$arrUser[0]['upperengine'];
					}
					else
						echo 0;
				}
				
			}	
		break;

		case "showcustomerlink" : 
			$regId = $_POST['id'];
			if($regId > 0)
			{
				$arrUser = GetRecords("SELECT customer.id, customer.name as cname  from customer inner join contact on contact.customer =  customer.id
								where contact.customer = ".$regId." ");
				if(isset($arrUser[0]['cname']) && $arrUser[0]['cname'] != "")
					echo "<a href='edit-customer.php?id=".$arrUser[0]['id']."'>".$arrUser[0]['cname']."</a>";
				else
					echo 0;
				
			}	
		break;
		
	}
?>