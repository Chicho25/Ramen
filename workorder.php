<?php
    ob_start();
    $fleetclass="class='active'";
    $editWorkOrderclass="class='active'";

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
        $where.=" and  (vehicle.name LIKE '%".$_POST['cname']."%' OR workorder.assigneddate LIKE '%".$_POST['cname']."%' OR workorder.id like '%".$_POST['cname']."%' )";
        $name = $_POST['cname'];
      }
      if(isset($_POST['status']) && $_POST['status'] != "")
      {
        $where.=" and  workorder.stat =  ".$_POST['status'];
        $status = $_POST['status'];
      }
      else
      {
        $where.=" and  workorder.stat =  1";
        $status = 1;
      }

      $arrUser = GetRecords("SELECT workorder.*, vehicle.name as VehName
                            from workorder
                            inner join vehicle on vehicle.id = workorder.id_vehicle
                            $where
                            order by vehicle.name");

?>
     <?php
      $bcName = "Work Order List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Work Order List</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-2 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-workorder.php'"?>Add Work Order Entry</button>
                            </span>
                          </div>
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <a href="excel_ordenes_trabajo.php" target="_blank" class="btn btn-success btn-rounded"?>Excel</a>
                            </span>
                          </div>
                          <!-- <div class="col-sm-3 m-b-xs pull-right">
                            <div class="input-group">
                              <span class="input-group-btn padder "><button class="btn btn-success btn-rounded">Search</button></span>
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="text" class="input-s input-sm form-control" value="<?php echo $name?>" name="cname" placeholder="">
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="radio" name="status" value="1" <?php echo $c=(isset($status) && $status == 1) ? 'checked' : ''?> > Active
                              <input type="radio" name="status" value="0" <?php echo $c=(isset($status) && $status == 0) ? 'checked' : ''?> > Archived
                            </div>
                          </div> -->

                        </div>
                      </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-examplewithSearch">
                              <thead>
                                <tr>
                                  <th>Work Order Id</th>
                                  <th>Vehicle Name</th>
                                  <th>Assigned On</th>
                                  <th>Status</th>
                                  <th>Priority</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP
                                $i=1;
                                foreach ($arrUser as $key => $value) {

                                  $status = ($value['stat'] == 1) ? 'Active' : 'In Active';
                                ?>
                              <tr>
                                  <td class="tbdata"> <?php echo $value['id']?> </td>
                                  <td class="tbdata"> <?php echo $value['VehName']?> </td>
                                  <td class="tbdata"> <?php echo $value['assigneddate']?> </td>
                                  <?php if($value['isCompleted'] != 1) : ?>
                                    <td class="tbdata"> <?php echo $arrWOStatus[$value['id_status']]?> </td>
                                  <?php else :?>
                                    <td class="tbdata"> Completed </td>
                                  <?php endif ?>
                                  <td class="tbdata"> <?php echo $arrPriority[$value['id_priority']]?> </td>
                                  <td>
                                    <?php if($value['isCompleted'] == 1) : ?>
                                      <button type="button" onclick="window.location='view-workorder.php?id=<?php echo $value['id']?>';" class="btn green btn-info">View</button>
                                    <?php endif;?>
                                    <?php if($value['isCompleted'] != 1) : ?>
                                    <button type="button" onclick="window.location='status-workorder.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Status</button>

                                      <button type="button" onclick="window.location='edit-workorder.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Edit</button>
                                    <?php endif;?>
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
