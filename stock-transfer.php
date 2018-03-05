<?php 

    ob_start();
    $inventoryclass="class='active'";
    $registerStockTransclass="class='active'";
    
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
          $getLocatFromData = GetRecord("location", "id=".$warehouse);
          $getLocatToData = GetRecord("location", "id=".$warehouseto);
          $arrVal = array(
                        "id_warehouse" => $warehouse,
                        "id_warehouseTo" => $warehouseto,
                        "request_date" => $requestdate,
                        "delivery_date" => $deliverydate,
                        "request_by" => $requestby,
                        "authorize_by" => $authorizeby,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "entry_by" => $_SESSION['USER_ID']
                       );

          $nId = InsertRec("stock_transfer", $arrVal);    

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
                          "id_trans" => $nId,
                          "id_item" => $expVal[0],
                          "qty" => $expVal[1]
                         );
                    InsertRec("stock_transfer_detail", $arrVal);
                  }
                }
              }
              
              $arrOppDetail = GetRecords("select stock_transfer_detail.* from stock_transfer_detail
                                                             where id_trans = ".$nId);
              foreach ($arrOppDetail as $key => $value) {

                if($value['id_item'] != -1)
                {
                  $totInvQty = getInventoryItemQty($warehouse, $value['id_item']);
                  $qtyinhand = $totInvQty;
                  $qtyNew = $qtyinhand - $value['qty'];
                  $arrInvVal = array(
                    "id_warehouse" => $warehouse,
                    "id_item" => $value['id_item'],
                    "reference" => "Stock transfer # ".$nId,
                    "date" => $requestdate,
                    "order_no" => '',
                    "qty" => "-".$value['qty'],
                    "qty_in_hand" => $qtyinhand,
                    "qty_new" => $qtyNew,
                    "reason" => "Stock Transfer To ".$getLocatToData['description'],
                    "entry_by" => $_SESSION['USER_ID']
                   );

                  InsertRec("inventory_adjustment", $arrInvVal);

                  $totInvQty = getInventoryItemQty($warehouseto, $value['id_item']);
                  $qtyinhand = $totInvQty;
                  $qtyNew = $qtyinhand + $value['qty'];
                  $arrInvVal = array(
                    "id_warehouse" => $warehouseto,
                    "id_item" => $value['id_item'],
                    "reference" => "Stock transfer # ".$nId,
                    "date" => $requestdate,
                    "order_no" => '',
                    "qty" => $value['qty'],
                    "qty_in_hand" => $qtyinhand,
                    "qty_new" => $qtyNew,
                    "reason" => "Stock Transfer from ".$getLocatFromData['description'],
                    "entry_by" => $_SESSION['USER_ID']
                   );

                  InsertRec("inventory_adjustment", $arrInvVal);
                }

              }
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Stock transferred  successfully</strong>
                    </div>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Stock  not transferred</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Stock Transfer";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Stock Transfer</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">From Warehouse</label>
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

                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">To Warehouse</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="warehouseto" id="warehouseto" required="required" >
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
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Delivery Date</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="deliverydate" id="deliverydate" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                  
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
                              <label class="col-lg-4 text-right control-label font-bold">Authorize By</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" data-placeholder="---select---"  name="authorizeby" required="required" >
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
                                                    </select>
                                                </div>
                                              </div>
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Stock</label>
                                                <div class="col-lg-4">
                                                  <input type="text" class="form-control" readonly="" required=""   name="qtyinhand" id="qtyinhand">                        
                                                </div>  
                                              </div>
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Quantity</label>
                                                <div class="col-lg-4">
                                                  <input type="text" class="form-control" required=""   name="quantity" id="quantity">                        
                                                </div>  
                                              </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="getStockTransferDetail()" class="btn btn-primary">Add</button>
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
                                  <th>Quantity</th>
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