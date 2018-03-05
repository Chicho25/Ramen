<?php 

    ob_start();
    $countryclass="class='active'";
    $editVehclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    if(!isset($_SESSION['USER_ID']) ) 
     {
          header("Location: index.php");
          exit;
     }

     if(isset($_GET['id']) && $_GET['id'] > 0)
     {
     	unlink($_GET['file']);
     	DeleteRec("vehicle_document", "id=".$_GET['did']);	
     	header("location:edit-vehicle.php?id=".$_GET['id']);
     }
     