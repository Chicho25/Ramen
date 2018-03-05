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
    $where = "where (1=1)";

      $name = "";
      if(isset($_POST['cname']) && $_POST['cname'] != "")
      {
        $where.=" and  (firstname LIKE '%".$_POST['cname']."%' or lastname LIKE '%".$_POST['cname']."%' or requisition.wo_no LIKE '%".$_POST['cname']."%' or requisition.id = '".$_POST['cname']."' or requisition.request_date LIKE '%".$_POST['cname']."%')";
        $name = $_POST['cname'];
      }

      $arrUser = GetRecords("SELECT requisition.*, employee.firstname, employee.lastname, sum(requisition_detail.qty) as totQty from requisition
                             inner join requisition_detail on requisition_detail.id_req = requisition.id
                             inner join employee on employee.id = requisition.request_by
                             $where
                             GROUP BY requisition.id
                             order by employee.firstname");

?>
     <?php
      $bcName = "Requisition List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Requisition List</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-requisition.php'"?>Add Material Requisition</button>
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
                                  <th>Requisicion#</th>
                                  <th>Orden de trabajo #</th>
                                  <th>Fecha Solicitud</th>
                                  <th>Solisitado Por</th>
                                  <th>Nota</th>
                                  <th>Total</th>
                                  <th>Accion</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP
                                $i=1;
                                foreach ($arrUser as $key => $value) { ?>
                              <tr>
                                  <td class="tbdata"> <?php echo $value['id']?> </td>
                                  <td class="tbdata"> <?php echo $value['wo_no']?> </td>
                                  <td class="tbdata"> <?php echo $value['request_date']?> </td>
                                  <td class="tbdata"> <?php echo $value['firstname']." ".$value['lastname']?> </td>
                                  <td class="tbdata"> <?php echo $value['notes']?> </td>
                                  <td class="tbdata"> <?php echo $value['totQty']?> </td>
                                  <td>
                                    <a href="modal-see_products_requisition.php?id=<?php echo $value['id']?>" title="Ver productos" data-toggle="ajaxModal" class="btn btn-sm btn-icon btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <?php if($value['is_Approved'] != 1) : ?>
                                    <button type="button" onclick="window.location='edit-requisition.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Edit</button>
                                    <button type="button" onclick="window.location='requisition-approve.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Approve</button>
                                  <?php endif;?>
                                  <button type="button" onclick="window.location='requisition-view.php?id=<?php echo $value['id']?>';" class="btn green btn-info">View</button>
                                  <a href="report_requsition.php?id=<?php echo $value['id']?>" class="btn primary btn-info" target="_blank">PDF</a>
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
<?php
  include("footer.php");
?>
