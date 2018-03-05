<?php

    ob_start();
    $inventoryclass="class='active'";
    $editReqsclass="class='active'";

    include("include/config.php");
    include("include/defs.php");
    $loggdUType = current_user_type();


    include("header.php");

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User")
     {
          header("Location: index.php");
          exit;
     }

     $arrUser = GetRecord("requisition", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';


?>
  <?php
      $bcName = "Requisition Approve";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Requisition Approve</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">

                        <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">

                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Request Date</label>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" required="" readonly="" class="form-control" name="requestdate" id="requestdate" value="<?php echo $arrUser['request_date']?>">
                                    </div>

                                </div>
                            </div>
                           <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Work Order</label>
                              <div class="col-lg-4">
                                <select class="chosen-select form-control"  name="wono" required="required" disabled="">
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from workorder where stat=1 and id_status = 1 and isCompleted != 1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['wo_no'];
                                      $kinDesc = $value['wo_no'];
                                      $selRoll = (isset($arrUser['wo_no']) && $arrUser['wo_no'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Department</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" readonly="" value="<?php echo $arrUser['department']?>"  name="department">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Request By</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="requestby" required="required"  disabled="">
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from employee where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['firstname']." ".$value['lastname'];
                                    $selRoll = (isset($arrUser['request_by']) && $arrUser['request_by'] == $kinId) ? 'selected' : '';

                                  ?>
                                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Notes</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="notes" required=""  placeholder=""  disabled=""><?php echo $arrUser['notes']?></textarea>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                              <div class="col-lg-4">
                                  <input type="checkbox"  disabled="" class="js-switch" name="status" <?php echo $status?>>

                              </div>

                            </div>
                            <div class="table-responsive">
                            <table class="table table-striped b-t b-light tableline">
                              <thead>
                                <tr>
                                  <th>Item Id</th>
                                  <th>Item Description</th>
                                  <th>Stock</th>
                                  <th>Quantity</th>
                                  <th>Buy</th>
                                  <th>Unit of Measure</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $arrOppDetail = GetRecords("select requisition_detail.* from requisition_detail
                                                             where id_req = ".$arrUser['id']);
                                foreach ($arrOppDetail as $key => $value) {

                                  $hdata = $value['id_item']."!".$value['stock']."!".$value['qty']."!".$value['buy']."!".$value['itmdesc']."!".$value['unitmeasure'];
                                  if($value['id_item'] == -1)
                                    $itm = "Not in Inventory";
                                  else
                                    $itm = $value['id_item'];
                                ?>

                                    <tr>
                                      <input type='hidden' name='h1[]' value='<?php echo $hdata?>'>
                                      <td><?php echo $itm?></td>
                                      <td><?php echo $value['itmdesc']?></td>
                                      <td><?php echo $value['stock']?></td>
                                      <td><?php echo $value['qty']?></td>
                                      <td><?php echo $value['buy']?></td>
                                      <td><?php echo $value['unitmeasure']?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                           </table>
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
