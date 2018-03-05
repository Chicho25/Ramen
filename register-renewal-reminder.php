<?php 

    ob_start();
    $fleetclass="class='active'";
    $registerRenewRemindclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID'])) 
     {
          header("Location: index.php");
          exit;
     }
     $message="";

    if(isset($_POST['submitUser']))
     {       
        
          $arrVal = array(
                        "id_vehicle" => $vehicle,
                        "reason" => $reason,
                        "duedate" => $duedate,
                        "tiemthreshold" => $tiemthreshold,
                        "timethresholdopt" => $timethresholdopt,
                        "emailsubscribed" => $emailsubscribed,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "stat" => 1
                       );

          $nId = InsertRec("renewal_reminder", $arrVal);    

          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Renewal Reminder created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Renewal Reminder created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Renewal Reminder not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Renewal Reminder";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Renewal Reminder</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" id="renewalForm" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---" onChange="checkVal();" id="vehicle"  name="vehicle" required="required" >
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['name'];
                                    
                                  ?>
                                  <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>                   
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Reason</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="reason">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Time Threshold</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required=""   name="tiemthreshold">                        
                              </div>
                              <div class="col-lg-4">
                                <select class="chosen-select form-control"  name="timethresholdopt" required="required" >
                                    <?PHP
                                    foreach ($arrThreshold as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>                       
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Email  Subscribed Users</label>
                              <div class="col-lg-4">
                                
                                <textarea rows="7" class="form-control" cols="44" name="emailsubscribed" id="emailsubscribed" required=""  placeholder="" onblur="validateEmails(this.value)"></textarea>                        
                              </div>  
                            </div>
                          <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary" name="submitUser" type="submit">Save</button>
                                <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    
<?php    
	include("footer.php"); 
?> 