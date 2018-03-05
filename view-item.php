<?php 

    ob_start();
    $inventoryclass="class='active'";
    $edititemclass="class='active'";
    
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
    
     $arrUser = GetRecord("items", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "View Item";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>View Item</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Description</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required=""  name="description" value="<?php echo $arrUser['description']?>" readonly="">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Item Type</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="itemtype" required="required" disabled="">
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from item_types where stat=1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['description'];
                                      $selRoll = (isset($arrUser['id_type']) && $arrUser['id_type'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Manufacturer</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""  value="<?php echo $arrUser['manufacturer']?>" name="manufacturer" readonly="">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Manufacturer Part#</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['manufacturer_num']?>"  name="manufacturernumber" readonly="">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Unit Of Measure</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['unitofmeasure']?>"  name="unitofmeasure" readonly="">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Last Unit Cost</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""  value="<?php echo $arrUser['lastunitcost']?>" name="lastunitcost" readonly="">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Barcode</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['barcode']?>"  name="barcode" readonly="">                        
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
    
<?php    
	include("footer.php"); 
?> 