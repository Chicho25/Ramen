<?php 

    ob_start();
    $inventoryclass="class='active'";
    $editPOclass="class='active'";
    
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
          $stval = (isset($_POST['status'])) ? 1 : 0;
          
          $arrVal = array(
                        "id_supplier" => $supplier,
                        "id_warehouse" => $warehouse,
                        "request_date" => $requestdate,
                        "wo_no" => $wono,
                        "department" => $department,
                        "request_by" => $requestby,
                        "terms" => $terms,
                        "reference" => $reference,
                        "stat" => $stval,
                        "unittoal" => $unittoal,
                        "discount" => $discount,
                        "taxval" => $taxval,
                        "grandtotal" => $grandtotal,
                       );
          
          UpdateRec("purchase_order", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              $pricline = $_POST['h1'];
              if(count($pricline) > 0)
              {
                DeleteRec("purchase_detail", "id_po=".$nId);
                foreach ($pricline as $key => $value) {
                  $expVal = explode(",", $value);
                  if(isset($expVal[0]) && $expVal[0] > 0)
                  {
                    $getItemDetail = GetRecord("items", "id = ".$expVal[0]);
                    $arrVal = array(
                          "id_po" => $nId,
                          "id_item" => $expVal[0],
                          "qty" => $expVal[1],
                          "unitmeasure" => $getItemDetail['unitofmeasure'],
                          "cost" => $expVal[3],
                          "amount" => $expVal[3] * $expVal[1],
                         );
                    InsertRec("purchase_detail", $arrVal);
                  }
                }
              }
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Purchase Order updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("purchase_order", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
?>
  <?php 
      $bcName = "Edit Purchase Order";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Purchase Order</h5>
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
                              <label class="col-lg-4 text-right control-label font-bold">Supplier</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="supplier" id="supplier" required="required" >
                                    <option value="">---select---</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from supplier where stat=1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['name'];
                                    $selRoll = (isset($arrUser['id_supplier']) && $arrUser['id_supplier'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Warehouse</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="warehouse" id="warehouse" required="required" >
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
                                <label class="col-lg-4 text-right control-label font-bold">Request Date</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="requestdate" id="requestdate" value="<?php echo $arrUser['request_date']?>">
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Work Order</label>
                              <div class="col-lg-4">
                                <select class="chosen-select form-control"  name="wono" required="required" >
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
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['department']?>"   name="department">                        
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
                              <label class="col-lg-4 text-right control-label font-bold">Terms</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control"   name="terms" required="required" >
                                    <?PHP
                                    
                                    foreach ($arrInvPOTerms as $key => $value) {
                                      $kinId = $key;
                                      $kinDesc = $value;
                                      $selRoll = (isset($arrUser['terms']) && $arrUser['terms'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Reference</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['reference']?>"  name="reference">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                              <div class="col-lg-4">
                                  <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
                                  
                              </div>

                            </div>
                            <div class="form-group">
                              <label class="col-lg-4 text-right control-label font-bold"></label>
                              <div class="col-lg-4">
                                <a data-toggle="modal" class="btn btn-primary" onclick="addItem()"  data-target="#myModal">
                                Add Item
                                </a>
                              </div>
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
                                                    <select class="chosen-select form-control" name="itemid" id="itemid"  >
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
                                                <?php if(count($arrKindMeetings) == 0) : ?>
                                                <div class="col-lg-2">
                                                  <button class="btn btn-warning" type="button" onclick="window.location='register-item.php'">Register Item
                                                </div>
                                              <?php endif ?>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                          <label class="col-lg-4 text-right control-label font-bold">Quantity</label>
                                          <div class="col-lg-4">
                                            <input type="text" class="form-control"    name="quantity" id="quantity">                        
                                          </div>  
                                        </div>
                                        <div class="form-group required">
                                          <label class="col-lg-4 text-right control-label font-bold">Unit Price</label>
                                          <div class="col-lg-4">
                                            <input type="text" class="form-control"    name="unitprice" id="unitprice">                        
                                          </div>  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="getItemDetail()" class="btn btn-primary">Add</button>
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
                                  <th>Unit of Measure</th>
                                  <th>Unit Price</th>
                                  <th>Amount</th>
                                  <th>ACTION</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                               
                                $arrOppDetail = GetRecords("select purchase_detail.*, items.description from purchase_detail
                                                             inner join items on items.id = purchase_detail.id_item  
                                                             where id_po = ".$arrUser['id']);
                                foreach ($arrOppDetail as $key => $value) {
                                  $hdata = $value['id_item'].",".$value['qty'].",".$value['amount'].",".$value['cost'];
                                ?>
                                    
                                    <tr>
                                      <input type='hidden' name='h1[]' value='<?php echo $hdata?>'>
                                      <td><?php echo $value['id_item']?></td>
                                      <td><?php echo $value['description']?></td>
                                      <td><?php echo $value['qty']?></td>
                                      <td><?php echo $value['unitmeasure']?></td>
                                      <td><?php echo number_format($value['cost'], 2)?></td>
                                      <td><?php echo number_format($value['amount'],2)?></td>
                                      <td><a onclick="editPOLine()" data-toggle='modal' data-target="#myModal"><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<i onclick='rm(); showTotalOnRemoveRow(); showPOGTotal()' class='glyphicon glyphicon-remove'></i></td>
                                    </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colspan="4">Sub Total</td>
                                  <td colspan="3">
                                    <input type="text" size="10" readonly="" value="<?php echo number_format($arrUser['unittoal'],2) ?>" name="unittoal" id="unittoal">
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="4">Discount</td>
                                  <td colspan="3"><input type="text" value="<?php echo number_format($arrUser['discount'],2) ?>" size="10" onblur="showPOGTotal()" name="discount" id="discount"></td>
                                </tr>
                                <tr>
                                  <td colspan="4">Tax</td>
                                  <td colspan="3">
                                    <select id="taxval" name="taxval" onchange="showPOGTotal()">
                                      <option value="7" <?php echo $a=($arrUser['taxval'] > 0) ? 'selected' : '';?>>7%</option>
                                      <option value="0" <?php echo $a=($arrUser['taxval'] == 0) ? 'selected' : '';?>>0%</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="4">Total</td>
                                  <td>
                                    <input type="text" size="10" readonly="" value="<?php echo number_format($arrUser['grandtotal'],2) ?>" name="grandtotal" id="grandtotal">
                                  </td>
                                </tr>
                              </tfoot>
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