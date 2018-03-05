<?php

    ob_start();
    $inventoryclass="class='active'";
    $registerReqsclass="class='active'";

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
                        "id_warehouse" => $warehouse,
                        "request_date" => $requestdate,
                        "wo_no" => $wono,
                        "department" => $department,
                        "request_by" => $requestby,
                        "notes" => $notes,
                        "entry_by" => $_SESSION['USER_ID'],
                        "is_Approved" => 0,
                        "stat" => 1
                       );

          $nId = InsertRec("requisition", $arrVal);

          if($nId > 0)
          {
              $pricline = $_POST['h1'];
              if(count($pricline) > 0)
              {
                foreach ($pricline as $key => $value) {
                  $expVal = explode("!", $value);
                  if(isset($expVal[0]))
                  {
                    $arrVal = array(
                          "id_req" => $nId,
                          "id_item" => $expVal[0],
                          "stock" => $expVal[1],
                          "qty" => $expVal[2],
                          "buy" => $expVal[3],
                          "itmdesc" => $expVal[4],
                          "unitmeasure" => $expVal[5]
                         );
                    InsertRec("requisition_detail", $arrVal);
                  }

                  // if($expVal[0] != -1)
                  // {
                  //   $totInvQty = getInventoryItemQty($expVal[0]);

                  //   if($totInvQty > 0)
                  //     $qtyinhand = $totInvQty;
                  //   else
                  //     $qtyinhand = $recvQty;
                  //   $arrInvVal = array(
                  //     "id_item" => $expVal[0],
                  //     "reference" => $reference,
                  //     "date" => $requestdate,
                  //     "order_no" => $wono,
                  //     "qty" => $expVal[2],
                  //     "qty_in_hand" => $qtyinhand,
                  //     "qty_new" => $qtyinhand + $expVal[2],
                  //     "reason" => "Work Order# ".$wono." and Requisition# ".$nId,
                  //     "entry_by" => $_SESSION['USER_ID']
                  //    );

                  //   InsertRec("inventory_adjustment", $arrInvVal);
                  // }

                }
              }

            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Material Requisition created successfully</strong>
                    </div>';

            echo '<script>
                              alert("Material Requisition created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {


            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Material Requisition not created</strong>
                  </div>';
          }



     }
?>
  <?php
      $bcName = "Register Material Requisition";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Material Requisition</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php
                                if($message !="")
                                    echo $message;
                          ?>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Warehouse</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="warehouse" id="warehouse" required="required" >
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from location where stat=1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['description'];
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Request Date</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="requestdate" id="requestdate" value="<?php echo date("Y-m-d") ?>">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Work Order</label>
                              <div class="col-lg-4">
                                <select class="chosen-select form-control"  name="wono">
                                  <option value="">Seleccionar</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from workorder where stat=1 and id_status = 1 and isCompleted != 1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['wo_no'];
                                      $kinDesc = $value['wo_no'];
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Department</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="department">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Request By</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="requestby" required="required" >
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from employee where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['firstname']." ".$value['lastname'];

                                  ?>
                                  <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                  <?php
                              }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Notes</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="notes" required=""  placeholder=""></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-4 text-right control-label font-bold"></label>
                            <div class="col-lg-4">
                              <a data-toggle="modal" class="btn btn-primary" onclick="addReqItem()"  data-target="#myModal">
                              Add Item
                              </a>
                            </div>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add Item</h4>

                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Item</label>
                                                <div class="col-lg-4">
                                                    <select class="chosen-select form-control" name="itemid" id="itemid" required="required" onchange="showItemDesc(); getQtyInHand()">
                                                      <option value="">----------</option>
                                                      <?PHP
                                                      $arrKindMeetings = GetRecords("Select * from items where stat=1");
                                                      foreach ($arrKindMeetings as $value) {
                                                        $kinId = $value['id'];
                                                        $kinDesc = $value['description'];
                                                      ?>
                                                      <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                      <option value="-1">Not In Inventory</option>
                                                    </select>
                                                </div>
                                              </div>
                                              <div class="form-group required" id="itmdesc" style="display: none;">
                                                <label class="col-lg-4 text-right control-label font-bold">Description</label>
                                                <div class="col-lg-4">
                                                  <input type="text" class="form-control"  name="description" id="description">
                                                </div>
                                              </div>
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Stock</label>
                                                <div class="col-lg-4">
                                                  <input type="text" class="form-control" readonly=""    name="qtyinhand" id="qtyinhand">
                                                </div>
                                              </div>
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Quantity</label>
                                                <div class="col-lg-4">
                                                  <input type="text" class="form-control"    name="quantity" id="quantity">
                                                </div>
                                              </div>
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Unit of Measure</label>
                                                <div class="col-lg-4">
                                                  <select class="form-control" name="measureunit" id="measureunit">
                                                      <option value="cm">cm</option>
                                                      <option value="lb">lb</option>
                                                      <option value="pieces">pieces</option>
                                                      <option value="Galon">Galon</option>
                                                  </select>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="getReqItemDetail()" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
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
                                  <th>ACTION</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
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
