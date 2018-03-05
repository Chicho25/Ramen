<?php 

    ob_start();
    $inventoryclass="class='active'";
    $registerRecvStockclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    $totPOQty = getPOQty(1);
    $totROQty = getROQty(1);
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User") 
     {
          header("Location: index.php");
          exit;
     }
     $message="";
    if(isset($_POST['submitUser']) && $_REQUEST['id'] > 0)
     {
      
          $stval = (isset($_POST['status'])) ? 1 : 0;
          
          $arrVal = array(
                        "po_no" => $pono,
                        "id_warehouse" => $hdnwarehouse,
                        "receive_date" => $receivetdate,
                        "receive_by" => $requestby,
                        "reference" => $reference
                       );
          
          $nId= InsertRec("receive_order", $arrVal);    
          //$nId=$_REQUEST['idate(format)'];
          if($nId > 0)
          {
              $pricline = $_POST['h1'];
              if(count($pricline) > 0)
              {
                foreach ($pricline as $key => $value) {
                  $expVal = explode(",", $value);
                  if(isset($expVal[0]) && $_POST['itm-'.$expVal[0]] > 0 )
                  {
                    $getItemDetail = GetRecord("items", "id = ".$expVal[0]);
                    $recvQty = $_POST['itm-'.$expVal[0]];
                    $aisleVal = $_POST['aisle-'.$expVal[0]];
                    $arrVal = array(
                          "id_ro" => $nId,
                          "id_item" => $expVal[0],
                          "qty" => $expVal[1],
                          "unitmeasure" => $getItemDetail['unitofmeasure'],
                          "cost" => $getItemDetail['lastunitcost'],
                          "amount" => $getItemDetail['lastunitcost'] * $expVal[1],
                          "RecvQty" =>  $recvQty,
                          "AisleRowBin" => $aisleVal
                         );
                    if(RecCount("receive_detail", "id_ro = ".$nId." and id_item = ".$expVal[0]) == 0)
                    {
                        InsertRec("receive_detail", $arrVal);
                    }
                    else
                    {
                      MySQLQuery("Update receive_detail set RecvQty = RecvQty + ".$recvQty." where  id_ro = ".$nId." and id_item = ".$expVal[0]);
                      //UpdateRec("receive_detail", "id_ro = ".$nId." and id_item = ".$expVal[0], array("RecvQty" => "RecvQty + ".$_POST['itm-'.$expVal[0]]));
                    }

                    $totInvQty = getInventoryItemQty($hdnwarehouse, $expVal[0]);
                        
                    if($totInvQty > 0)
                      $qtyinhand = $totInvQty;
                    else
                      $qtyinhand = $recvQty;
                    
                    $arrInvVal = array(
                      "id_warehouse" => $hdnwarehouse,
                      "id_item" => $expVal[0],
                      "reference" => $reference,
                      "date" => $receivetdate,
                      "order_no" => $pono,
                      "qty" => $recvQty,
                      "qty_in_hand" => $qtyinhand,
                      "qty_new" => $qtyinhand + $recvQty,
                      "reason" => "Purchase Order# ".$pono." and Receive# ".$nId,
                      "entry_by" => $_SESSION['USER_ID']
                     );

                    InsertRec("inventory_adjustment", $arrInvVal);
                  }
                }
              }

              $totPOQty = getPOQty($pono);
              $totROQty = getROQty($pono);
              if($totPOQty <= $totROQty)
              {
                UpdateRec("purchase_order", "id = ".$_REQUEST['id'], array('isReceived' => 1));
              }
              
              echo "<script>alert('Qty received'); window.location='register-receive-stock.php';</script>";
          }
          
          
        
     }

     $arrUser = GetRecord("purchase_order", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "Receive Stock";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Receive Stock</h5>
                    </div>
                    <div class="ibox-content">
                  <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Purchase Order#</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" readonly="" value="<?php echo $arrUser['po_no']?>"   name="pono">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Warehouse</label>
                              <div class="col-lg-4">
                                  <input type="hidden" name="hdnwarehouse" value="<?php echo $arrUser['id_warehouse']?>">
                                  <select class="chosen-select form-control" name="warehouse" id="warehouse" required="required" disabled="">
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from location where stat=1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['description'];
                                    $selRoll = (isset($arrUser['id_warehouse']) && $arrUser['id_warehouse'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Receive Date</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="receivetdate" id="receivetdate" value="<?php echo date("Y-m-d")?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Receive By</label>
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
                              <label class="col-lg-4 text-right control-label font-bold">Reference</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""  name="reference">                        
                              </div>  
                            </div>
                            <div class="table-responsive">
                            <table class="table table-striped b-t b-light tableline">
                              <thead>
                                <tr>
                                  <th>Item Id</th>
                                  <th>Item Description</th>
                                  <th>Quantity</th>
                                  <th>Unit of Measure</th>
                                  <th>Unit Price</th>
                                  <th>Amount</th>
                                  <th>Remaining Qty</th>
                                  <th>Receive Qty</th>
                                  <th>Aisle/Row/Bin</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $arrOppDetail = GetRecords("select purchase_detail.*, items.description from purchase_detail
                                                             inner join items on items.id = purchase_detail.id_item
                                                             where id_po = ".$arrUser['id']);
                                foreach ($arrOppDetail as $key => $value) {
                                  $hdata = $value['id_item'].",".$value['qty'];
                                  $qtyReceived = getROItemQty($arrUser['po_no'], $value['id_item']);
                                  if($qtyReceived >= 0)
                                    $remQty = $value['qty'] - $qtyReceived;
                                  else
                                    $remQty = 0;
                                ?>
                                    
                                    <tr>
                                      <input type='hidden' name='h1[]' value='<?php echo $hdata?>'>
                                      <td><?php echo $value['id_item']?></td>
                                      <td><?php echo $value['description']?></td>
                                      <td><?php echo $value['qty']?></td>
                                      <td><?php echo $value['unitmeasure']?></td>
                                      <td><?php echo number_format($value['cost'],2)?></td>
                                      <td><?php echo number_format($value['amount'],2)?></td>
                                      <td><?php echo $remQty?></td>
                                      <th><input type="text" name="itm-<?php echo $value['id_item']?>" class="form-control"></th>
                                      <th><input type="text"  name="aisle-<?php echo $value['id_item']?>" class="form-control" data-mask="999/999/999"></th>
                                    </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                           </table>
                         </div>
                            <div class="form-group">
                              <div class="col-sm-4 col-sm-offset-4">
                                  <button class="btn btn-primary" name="submitUser" type="submit">Receive</button>
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