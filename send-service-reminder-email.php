<?php 

    include("include/config.php"); 
    include("include/defs.php"); 
    //https://www.phpflow.com/php/how-to-get-days-difference-from-date-in-php/

    $arrSR = GetRecords("SELECT service_reminder.*, vehicle.name as VehName
                            from service_reminder
                            inner join vehicle on vehicle.id = service_reminder.id_vehicle
                              where service_reminder.stat = 1
                             order by vehicle.name");
     
    foreach ($arrSR as $key => $value) {
        $fromDate = substr($value['createdOn'], 0, 10);
        $meterinterval = $value['meterinterval'];
        $tieminterval = $value['tieminterval'];
        $timeintervalopt = $value['timeintervalopt'];

        $meterthreshold = $value['meterthreshold'];
        $tiemthreshold = $value['tiemthreshold'];
        $timethresholdopt = $value['timethresholdopt'];

        $nextIntervalDate = date("Y-m-d", strtotime($fromDate." +".$tieminterval ." ".$timeintervalopt ));
        
        if($tiemthreshold > 0)
        {
            
            $nextIntervalThresDate = date("Y-m-d", strtotime($fromDate." +".$tiemthreshold ." ".$timethresholdopt ));
            if(strtotime(date("Y-m-d")) == strtotime($nextIntervalThresDate))
            {
                sendEmail("saad", "smccape@gmail.com", "Test Email", "this is test message from Ramen");
            }
        }

        if(strtotime(date("Y-m-d")) == strtotime($nextIntervalDate))
        {
            sendEmail("saad", "smccape@gmail.com", "Test Email", "this is test message from Ramen");
        }
    }

    function sendEmail($name, $emailto, $subject, $message)
    {

        $name       = @trim(stripslashes($name)); 
        $emailfrom       = @trim(stripslashes("smccape@gmail.com")); 
        $emailsubject    = @trim(stripslashes($subject)); 
        $emailmessage    = @trim(stripslashes($message)); 
         
        $headers = "MIME-Version: 1.0\\r\
        "; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\\r\
        "; 
        $headers .= "From: ".$emailfrom; 
        //$headers .= "X-Mailer: PHP \\r\";
         
        if(mail($emailto, $emailsubject, $emailmessage, $headers)) {
          echo "done";
        }else{ 
          
        }

    }
     
