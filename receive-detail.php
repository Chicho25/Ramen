<?php 

    ob_start();
    $inventoryclass="class='active'";
    $editRecvStockclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User") 
     {
          header("Location: index.php");
          exit;
     }
     

     $arrUser = GetRecord("receive_order", "id = ".$_REQUEST['id']);
     
?>
  <?php 
      $bcName = "Receive Detail";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Receive Detail</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                          
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Purchase Order#</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" readonly="" value="<?php echo $arrUser['po_no']?>"   name="pono">                        
                              </div>  
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Warehouse</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" disabled="" name="warehouse" id="warehouse" required="required" >
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
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" readonly="" required="" class="form-control" name="receivetdate" id="receivetdate" value="<?php echo $arrUser['receive_date']?>">
                                    </div>
                                  
                                </div>
                            </div>
                           
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Receive By</label>
                              <div class="col-lg-4">
                                <select class="chosen-select" disabled="" data-placeholder="---select---"  name="requestby" required="required" >
                                  <option value="">---select---</option>
                                  <?PHP
                                  $arrKindMeetings = GetRecords("Select * from employee where stat=1");
                                  foreach ($arrKindMeetings as $key => $value) {
                                    $kinId = $value['id'];
                                    $kinDesc = $value['firstname']." ".$value['lastname'];
                                    $selRoll = (isset($arrUser['receive_by']) && $arrUser['receive_by'] == $kinId) ? 'selected' : '';
                                    
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
                                <input type="text" class="form-control" required="" readonly="" value="<?php echo $arrUser['reference']?>"  name="reference">                        
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
                                  <th>Qty Received</th>
                                  <th>Aisle/Row/Bin</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $arrOppDetail = GetRecords("select receive_detail.*, items.description from receive_detail
                                                              inner join items on items.id = receive_detail.id_item 
                                                             where id_ro = ".$arrUser['id']);
                                foreach ($arrOppDetail as $key => $value) {
                                  
                                ?>
                                    
                                    <tr>
                                      <td><?php echo $value['id_item']?></td>
                                      <td><?php echo $value['description']?></td>
                                      <td><?php echo $value['qty']?></td>
                                      <td><?php echo $value['unitmeasure']?></td>
                                      <td><?php echo $value['cost']?></td>
                                      <td><?php echo $value['amount']?></td>
                                      <td><?php echo $value['RecvQty']?></td>
                                      <td><?php echo $value['AisleRowBin']?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                           </table>
                         </div>
                            <!-- <div class="form-group">
                              <div class="col-sm-4 col-sm-offset-4">
                                  <button class="btn btn-primary" name="submitUser" type="submit">Save</button>
                                  <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                              </div>
                            </div> -->
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    
<?php    
	include("footer.php"); 
?> 