<?php 

    ob_start();
    $countryclass="class='active'";
    $editVehclass="class='active'";
    
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

    if(isset($_POST['submitUser']) && $_REQUEST['id'] > 0)
     {       
          $barerental = (isset($barerental)) ? 1 : 0;
          $mannedrental = (isset($mannedrental)) ? 1 : 0;
          $stval = (isset($_POST['status'])) ? 1 : 0;
          $arrVal = array(
                        "name" => $name,"make" => $make,"model" => $model,"year" => $year,
                        "license_plate" => $license,"serial_no" => $serialno, "tonnage" => $tonnage,"type" => $type,
                        
                        "bare_rental_product" => $barerental, "hourly_bare" => $hourly,"daily_bare" => $daily,
                        "weekly_bare" => $weekly,"monthly_bare" => $monthly,"yearly_bare" => $yearly,
                        "overtime_bare" => $overtime,"doubletime_bare" => $doubletime,"traveltime_bare" => $traveltime,
                        "dailyminimum_bare" => $dailyminimu,"projectminimum_bare" => $projectminimu,
                        
                        "manned_rental_product" => $mannedrental,"hourly_manned" => $hourly1,"daily_manned" => $daily1,
                        "weekly_manned" => $weekly1,"monthly_manned" => $monthly1, "yearly_manned" => $yearly1,
                        "overtime_manned" => $overtime1,"doubletime_manned" => $doubletime1,"traveltime_manned" => $traveltime1,
                        "dailyminimum_manned" => $dailyminimu1,"projectminimum_manned" => $projectminimu1,

                        "fuelcarrier" => $fuelcarrier,"fuelupper" => $fuelupper,"fuelcapacity1carrier" => $fuelcapacity1carrier,
                        "fuelcapacity1upper" => $fuelcapacity1upper,"fuelcapacity2carrier" => $fuelcapacity2carrier,
                        "fuelcapacity2upper" => $fuelcapacity2upper,"engineoilcarrier" => $engineoilcarrier,
                        "engineoilupper" => $engineoilupper,"hydraulicoilcarrier" => $hydraulicoilcarrier,
                        "hydraulicoilupper" => $hydraulicoilupper,"transmissionoilcarrier" => $transmissionoilcarrier,
                        "transmissionoilupper" => $transmissionoilupper,"differentialoilcarrier" => $differentialoilcarrier,
                        "differentialoilupper" => $differentialoilupper,"gearoilcarrier" => $gearoilcarrier,
                        "gearoilupper" => $gearoilupper,"axleoilcarrier" => $axleoilcarrier,"axleoilupper" => $axleoilupper,
                        "greasecarrier" => $greasecarrier,"greaseupper" => $greaseupper,"coolantcarrier" => $coolantcarrier,"coolantupper" => $coolantupper,"otherscarrier" => $otherscarrier,"othersupper" => $othersupper,

                        "fronttire" => $fronttire,"reartire" => $reartire,"fronttirepsi" => $fronttirepsi,
                        "reartirepsi" => $reartirepsi,

                        "primarymeter" => $primarymeter,"odometer" => $odometer,"carrierengine" => $carrierengine,
                        "upperengine" => $upperengine,

                        "wfcarrier" => $wfcarrier,"wfupper" => $wfupper,"pfcarrier" => $pfcarrier,"pfupper" => $pfupper,
                        "ofcarrier" => $ofcarrier,"ofupper" => $ofupper,"hfcarrier" => $hfcarrier,"hfupper" => $hfupper,
                        "sfcarrier" => $sfcarrier,"sfupper" => $sfupper,"tfcarrier" => $tfcarrier,"tfupper" => $tfupper,
                        "afcarrier" => $afcarrier,"afupper" => $afupper,"gfcarrier" => $gfcarrier,"gfupper" => $gfupper,
                        "otfcarrier" => $otfcarrier, "otfupper" => $otfupper,

                        "stat" => $stval
                       );

          // echo "<pre>";
          // print_r($_FILES);
          //exit;  
          UpdateRec("vehicle", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              
              if(isset($_FILES['document']) && $_FILES['document']['tmp_name'] != "")
              {
                  $target_dir = "vehicledocuments/";
                  $target_file = $target_dir . basename($_FILES["document"]["name"]);
                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                  $filename = $target_dir . $nId.".".$imageFileType;
                  $filenameThumb = $target_dir . $nId."_thumb.".$imageFileType;
                  if (move_uploaded_file($_FILES["document"]["tmp_name"], $filename)) 
                  {
                      makeThumbnailsWithGivenWidthHeight($target_dir, $imageFileType, $nId, 100, 100);
                      $arrDocument = array("id_vehicle" => $nId, "name" => $target_file, "path" => $filenameThumb, "createdOn" => date("Y-m-d h:i:s"));
                      InsertRec("vehicle_document", $arrDocument);    
                  }
              }

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Vehicle updated successfully</strong>
                    </div>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Vehicle not updated</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $arrVehicle = GetRecord("vehicle", "id = ".$_REQUEST['id']);
      $vehid = $arrVehicle['id'];
      $status = ($arrVehicle['stat'] == 1) ? 'checked' : '';
      $bcName = "Register Vehicle";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Vehicle</h5>
                    </div>
                    <div class="ibox-content">
                      <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrVehicle['id']?>" name="id">
                        <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                        <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-1">Details</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-2">Bare Rental Rates</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-3">Manned Rental Rates</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-4">Fluids</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-5">Wheels &amp; Tires</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-6">Telematics</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-7">Filters</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-8">Documents</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <?php 
                                              $name = $arrVehicle['name'];
                                              $make = $arrVehicle['make'];
                                              $model = $arrVehicle['model'];
                                              $year = $arrVehicle['year'];
                                              $license = $arrVehicle['license_plate'];
                                              $serial_no = $arrVehicle['serial_no'];
                                              $tonnage = $arrVehicle['tonnage'];
                                              $type = $arrVehicle['type'];

                                              include("vehicle-detail.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                              $bare_rental_product = ($arrVehicle['bare_rental_product'] == 1) ? 'checked' : '';
                                              $hourly_bare = $arrVehicle['hourly_bare'];
                                              $daily_bare = $arrVehicle['daily_bare'];
                                              $weekly_bare = $arrVehicle['weekly_bare'];
                                              $monthly_bare = $arrVehicle['monthly_bare'];
                                              $yearly_bare = $arrVehicle['yearly_bare'];
                                              $overtime_bare = $arrVehicle['overtime_bare'];
                                              $doubletime_bare = $arrVehicle['doubletime_bare'];
                                              $traveltime_bare = $arrVehicle['traveltime_bare'];
                                              $dailyminimum_bare = $arrVehicle['dailyminimum_bare'];
                                              $projectminimum_bare = $arrVehicle['projectminimum_bare'];
                                              include("vehicle-bare-rental-rate.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <?php 
                                              $manned_rental_product = ($arrVehicle['manned_rental_product'] == 1) ? 'checked' : '';
                                              $hourly_manned = $arrVehicle['hourly_manned'];
                                              $daily_manned = $arrVehicle['daily_manned'];
                                              $weekly_manned = $arrVehicle['weekly_manned'];
                                              $monthly_manned = $arrVehicle['monthly_manned'];
                                              $yearly_manned = $arrVehicle['yearly_manned'];
                                              $overtime_manned = $arrVehicle['overtime_manned'];
                                              $doubletime_manned = $arrVehicle['doubletime_manned'];
                                              $traveltime_manned = $arrVehicle['traveltime_manned'];
                                              $dailyminimum_manned = $arrVehicle['dailyminimum_manned'];
                                              $projectminimum_manned = $arrVehicle['projectminimum_manned'];
                                              include("vehicle-manned-rental-rate.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <?php 
                                              $fuelcarrier = $arrVehicle['fuelcarrier'];
                                              $fuelupper = $arrVehicle['fuelupper'];
                                              $fuelcapacity1carrier = $arrVehicle['fuelcapacity1carrier'];
                                              $fuelcapacity1upper = $arrVehicle['fuelcapacity1upper'];
                                              $fuelcapacity2carrier = $arrVehicle['fuelcapacity2carrier'];
                                              $fuelcapacity2upper = $arrVehicle['fuelcapacity2upper'];
                                              $engineoilcarrier = $arrVehicle['engineoilcarrier'];
                                              $engineoilupper = $arrVehicle['engineoilupper'];
                                              $hydraulicoilcarrier = $arrVehicle['hydraulicoilcarrier'];
                                              $hydraulicoilupper = $arrVehicle['hydraulicoilupper'];
                                              $transmissionoilcarrier = $arrVehicle['transmissionoilcarrier'];
                                              $transmissionoilupper = $arrVehicle['transmissionoilupper'];
                                              $differentialoilcarrier = $arrVehicle['differentialoilcarrier'];
                                              $differentialoilupper = $arrVehicle['differentialoilupper'];
                                              $gearoilcarrier = $arrVehicle['gearoilcarrier'];
                                              $gearoilupper = $arrVehicle['gearoilupper'];
                                              $axleoilcarrier = $arrVehicle['axleoilcarrier'];
                                              $axleoilupper = $arrVehicle['axleoilupper'];
                                              $greasecarrier = $arrVehicle['greasecarrier'];
                                              $greaseupper = $arrVehicle['greaseupper'];
                                              $coolantcarrier = $arrVehicle['coolantcarrier'];
                                              $coolantupper = $arrVehicle['coolantupper'];
                                              $otherscarrier = $arrVehicle['otherscarrier'];
                                              $othersupper = $arrVehicle['othersupper'];
                                              include("vehicle-fluid.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <?php 
                                              $fronttire = $arrVehicle['fronttire'];
                                              $reartire = $arrVehicle['reartire'];
                                              $fronttirepsi = $arrVehicle['fronttirepsi'];
                                              $reartirepsi = $arrVehicle['reartirepsi'];
                                              include("vehicle-wheel-tyre.php"); 
                                            ?>                                    
                                        </div>
                                        <div id="tab-6" class="tab-pane">
                                            <?php 
                                              $odometer = $arrVehicle['odometer'];
                                              $carrierengine = $arrVehicle['carrierengine'];
                                              $upperengine = $arrVehicle['upperengine'];
                                              $kc = ($arrVehicle['primarymeter'] == "kc") ? 'checked' : '';
                                              $hc = ($arrVehicle['primarymeter'] == "hc") ? 'checked' : '';
                                              $hcu = ($arrVehicle['primarymeter'] == "hcu") ? 'checked' : '';
                                              include("vehicle-telematics.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-7" class="tab-pane">
                                            <?php 
                                              $wfcarrier = $arrVehicle['wfcarrier'];
                                              $wfupper = $arrVehicle['wfupper'];
                                              $pfcarrier = $arrVehicle['pfcarrier'];
                                              $pfupper = $arrVehicle['pfupper'];
                                              $ofcarrier = $arrVehicle['ofcarrier'];
                                              $ofupper = $arrVehicle['ofupper'];
                                              $hfcarrier = $arrVehicle['hfcarrier'];
                                              $hfupper = $arrVehicle['hfupper'];
                                              $sfcarrier = $arrVehicle['sfcarrier'];
                                              $sfupper = $arrVehicle['sfupper'];
                                              $tfcarrier = $arrVehicle['tfcarrier'];
                                              $tfupper = $arrVehicle['tfupper'];
                                              $afcarrier = $arrVehicle['afcarrier'];
                                              $afupper = $arrVehicle['afupper'];
                                              $gfcarrier = $arrVehicle['gfcarrier'];
                                              $gfupper = $arrVehicle['gfupper'];
                                              $otfcarrier = $arrVehicle['otfcarrier'];
                                              $otfupper = $arrVehicle['otfupper'];
                                              include("vehicle-filter.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-8" class="tab-pane">
                                            <?php 
                                              
                                              include("vehicle-documents.php"); 
                                            ?>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-4 m-t-sm col-sm-offset-4">
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