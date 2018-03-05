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
    $where = "where (1=1)";
      
      $name = "";
      if(isset($_POST['cname']) && $_POST['cname'] != "")
      {
        $where.=" and  (name LIKE '%".$_POST['cname']."%' or receive_order.po_no LIKE '%".$_POST['cname']."%' or receive_order.receive_date LIKE '%".$_POST['cname']."%' or location.description LIKE '%".$_POST['cname']."%' or reference LIKE '%".$_POST['cname']."%'   or receive_order.id = '".$_POST['cname']."')";
        $name = $_POST['cname'];
      }
      
      $arrUser = GetRecords("SELECT receive_order.*, location.description as WareHouseName, users.name, users.Last_name, sum(receive_detail.RecvQty) as totQty from receive_order 
                             inner join location on location.id = receive_order.id_warehouse
                             inner join receive_detail on receive_detail.id_ro = receive_order.id
                             inner join users on users.id = receive_order.receive_by
                             $where
                             GROUP BY receive_order.id
                             order by name");
     
?>
     <?php 
      $bcName = "Reveived Stock List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Reveived Stock List</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-receive-stock.php'"?>Add Receive Order</button>
                            </span>
                          </div>
                          <div class="col-sm-3 m-b-xs pull-right">
                            <div class="input-group">
                              <span class="input-group-btn padder "><button class="btn btn-success btn-rounded">Search</button></span>
                            </div>  
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="text" class="input-s input-sm form-control" value="<?php echo $name?>" name="cname" >
                            </div>
                          </div>
                          <!-- <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="radio" name="status" value="1" <?php echo $c=(isset($status) && $status == 1) ? 'checked' : ''?> > Active
                              <input type="radio" name="status" value="0" <?php echo $c=(isset($status) && $status == 0) ? 'checked' : ''?> > Archived
                            </div>
                          </div> -->
                          
                        </div>
                      </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                              <thead>
                                <tr>
                                  <th>PO#</th>
                                  <th>Receive Date</th>
                                  <th>Ware House</th>
                                  <th>Received By</th>
                                  <th>Qty</th>
                                  <th>Reference</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP  
                                $i=1;
                                foreach ($arrUser as $key => $value) {
                                  
                                  
                                ?> 
                              <tr> 
                                  <td class="tbdata"> <?php echo $value['po_no']?> </td>
                                  <td class="tbdata"> <?php echo $value['receive_date']?> </td>
                                  <td class="tbdata"> <?php echo $value['WareHouseName']?> </td>
                                  <td class="tbdata"> <?php echo $value['name']." ".$value['Last_name']?> </td>
                                  <td class="tbdata"> <?php echo $value['totQty']?> </td>
                                  <td class="tbdata"> <?php echo $value['reference']?> </td>
                                  <td> <button type="button" onclick="window.location='receive-detail.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Detail</button>
                                  <!-- <?php if($value['isReceived'] != 1) : ?> 
                                    <button type="button" onclick="window.location='edit-po.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Receive</button> 
                                  <?php endif;?>   -->
                                  </td>
                              </tr>
                              <?php
                                $i++;
                              }
                              ?>
                              </tbody>
                            </table>
                        </div>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show().attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
<?php    
  include("footer.php"); 
?> 