<?php 

    ob_start();
    $fleetclass="class='active'";
    $editRenewRemindclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User") 
     {
          header("Location: index.php");
          exit;
     }
     $message="";
    

     $arrUser = GetRecord("renewal_reminder", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
     
?>
  <?php 
      $bcName = "View Renewal Reminder";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>View Renewal Reminder</h5>
                    </div>
                    <div class="ibox-content">
                     <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                      <input type="hidden"  name="lastodm" id="lastodm" value="0">
                      <input type="hidden"  name="lastenghr" id="lastenghr" value="0">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="vehicle" id="vehicle" required="required"  onChange="checkVal();" disabled="">
                                    <option value="">--Select---</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
                                    foreach ($arrKindMeetings as $key => $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['name'];
                                      $selRoll = (isset($arrUser['id_vehicle']) && $arrUser['id_vehicle'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Reason</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['reason']?>"   name="service" readonly="">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Time Threshold</label>
                              <div class="col-lg-4">
                                <input type="number" class="form-control" required="" value="<?php echo $arrUser['tiemthreshold']?>"   name="tiemthreshold" readonly="">                        
                              </div>
                              <div class="col-lg-4">
                                <select class="chosen-select form-control"  name="timethresholdopt" required="required" disabled="">
                                    <?PHP
                                    foreach ($arrThreshold as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                    $selRoll = (isset($arrUser['timethresholdopt']) && $arrUser['timethresholdopt'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>                       
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Email  Subscribed Users</label>
                              <div class="col-lg-4">
                                
                                <textarea rows="7" class="form-control" cols="44" name="emailsubscribed" id="emailsubscribed" required="" disabled=""  placeholder="" onblur="validateEmails(this.value)"><?php echo $arrUser['emailsubscribed']?></textarea>                        
                              </div>  
                            </div>
                          <div class="form-group required">
                            <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                            <div class="col-lg-4">
                                <input type="checkbox" disabled="" class="js-switch" name="status" <?php echo $status?>>
                                
                            </div>

                          </div>  

                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show().attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
<?php    
  include("footer.php"); 
?> 