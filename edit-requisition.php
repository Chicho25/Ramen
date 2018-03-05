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
     $message="";
     if(isset($_POST['submitUser']) && $_REQUEST['id'] > 0)
     {
          $stval = (isset($_POST['status'])) ? 1 : 0;
          
          $arrVal = array(

                        "request_date" => $requestdate,
                        "wo_no" => $wono,
                        "department" => $department,
                        "request_by" => $requestby,
                        "notes" => $notes,
                        "stat" => $stval
                       );
          
          UpdateRec("requisition", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              $pricline = $_POST['h1'];
              if(count($pricline) > 0)
              {
                DeleteRec("requisition_detail", "id_req=".$nId);
                foreach ($pricline as $key => $value) 
                {
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
                }
              }
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Material Requisition updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("requisition", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';
     
     
?>
  <?php 
      $bcName = "Requisition Edit";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Requisition Edit</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <?php 
                                if($message !="")
                                    echo $message;
                          ?>
                        <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                            
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Warehouse</label>
                              <div class="col-lg-4">
                                  <input type="hidden" name="warehouse" id="warehouse" value="<?php echo $arrUser['id_warehouse']?>">
                                  <select class="chosen-select form-control" name="warehouse1" id="warehouse1" required="required" disabled="">
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
                                    $arrKindMeetings = GetRecords("Select * from workorder where stat=1 and id_status = 1");
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
                                <input type="text" class="form-control" required="" value="<?php echo $arrUser['department']?>"  name="department">                        
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
                              <label class="col-lg-4 text-right control-label font-bold">Notes</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="notes" required=""  placeholder=""><?php echo $arrUser['notes']?></textarea>                      
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
                                <a data-toggle="modal" class="btn btn-primary" onclick="addReqItem()"  data-target="#myModal">
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
                                                    <select class="chosen-select form-control" name="itemid" id="itemid"  onchange="showItemDesc(); getQtyInHand()">
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
                                                  <input type="text" class="form-control"    name="description" id="description">                        
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
                                                  <input type="text" class="form-control"    name="quantity" id="quantity">                        
                                                </div>  
                                              </div>
                                              <div class="form-group required">
                                                <label class="col-lg-4 text-right control-label font-bold">Unit of Measure</label>
                                                <div class="col-lg-4">
                                                  <input type="text" class="form-control"   name="measureunit" id="measureunit">                        
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
                                      <td><a onclick="editReqLine()" data-toggle='modal' data-target="#myModal"><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<i onclick='rm()' class='glyphicon glyphicon-remove'></i></td>
                                    </tr>
                                <?php
                                }
                                ?>
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