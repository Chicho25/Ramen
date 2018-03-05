<?php 

    ob_start();
    $countryclass="class='active'";
    $registerVehclass="class='active'";
    
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
          $barerental = (isset($barerental)) ? 1 : 0;
          $mannedrental = (isset($mannedrental)) ? 1 : 0;
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

                        "stat" => 1,"created_on" => date("Y-m-d h:i:s")
                       );

          // echo "<pre>";
          // print_r($_FILES);
          //exit;  
          $nId = InsertRec("vehicle", $arrVal);    

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
                      <strong>Vehicle created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Vehicle created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Vehicle not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
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
                                              $name = "";
                                              $make = "";
                                              $model = "";
                                              $year = "";
                                              $license = "";
                                              $serial_no = "";
                                              $tonnage = "";
                                              $type = "";
                                              include("vehicle-detail.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php 
                                              $bare_rental_product = "";
                                              $hourly_bare = "";
                                              $daily_bare = "";
                                              $weekly_bare = "";
                                              $monthly_bare = "";
                                              $yearly_bare = "";
                                              $overtime_bare = "";
                                              $doubletime_bare = "";
                                              $traveltime_bare = "";
                                              $dailyminimum_bare = "";
                                              $projectminimum_bare = "";
                                              include("vehicle-bare-rental-rate.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <?php 
                                              $manned_rental_product = "";
                                              $hourly_manned = "";
                                              $daily_manned = "";
                                              $weekly_manned = "";
                                              $monthly_manned = "";
                                              $yearly_manned = "";
                                              $overtime_manned = "";
                                              $doubletime_manned = "";
                                              $traveltime_manned = "";
                                              $dailyminimum_manned = "";
                                              $projectminimum_manned = "";
                                              include("vehicle-manned-rental-rate.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <?php 
                                              $fuelcarrier = "";
                                              $fuelupper = "";
                                              $fuelcapacity1carrier = "";
                                              $fuelcapacity1upper = "";
                                              $fuelcapacity2carrier = "";
                                              $fuelcapacity2upper = "";
                                              $engineoilcarrier = "";
                                              $engineoilupper = "";
                                              $hydraulicoilcarrier = "";
                                              $hydraulicoilupper = "";
                                              $transmissionoilcarrier = "";
                                              $transmissionoilupper = "";
                                              $differentialoilcarrier = "";
                                              $differentialoilupper = "";
                                              $gearoilcarrier = "";
                                              $gearoilupper = "";
                                              $axleoilcarrier = "";
                                              $axleoilupper = "";
                                              $greasecarrier = "";
                                              $greaseupper = "";
                                              $coolantcarrier = "";
                                              $coolantupper = "";
                                              $otherscarrier = "";
                                              $othersupper = "";
                                              include("vehicle-fluid.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <?php 
                                              $fronttire = "";
                                              $reartire = "";
                                              $fronttirepsi = "";
                                              $reartirepsi = "";
                                              include("vehicle-wheel-tyre.php"); 
                                            ?>   
                                        </div>
                                        <div id="tab-6" class="tab-pane">
                                            <?php 
                                              $odometer = "";
                                              $carrierengine = "";
                                              $upperengine = "";
                                              $kc = "";
                                              $hc = "";
                                              $hcu = "";
                                              include("vehicle-telematics.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-7" class="tab-pane">
                                            <?php 
                                              $wfcarrier = "";
                                              $wfupper = "";
                                              $pfcarrier = "";
                                              $pfupper = "";
                                              $ofcarrier = "";
                                              $ofupper = "";
                                              $hfcarrier = "";
                                              $hfupper = "";
                                              $sfcarrier = "";
                                              $sfupper = "";
                                              $tfcarrier = "";
                                              $tfupper = "";
                                              $afcarrier = "";
                                              $afupper = "";
                                              $gfcarrier = "";
                                              $gfupper = "";
                                              $otfcarrier = "";
                                              $otfupper = "";
                                              include("vehicle-filter.php"); 
                                            ?>
                                        </div>
                                        <div id="tab-8" class="tab-pane">
                                            <?php 
                                              $vehid = 0;
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