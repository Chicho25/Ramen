<?php
    ob_start();
    $fleetclass="class='active'";
    $editFleetIssueclass="class='active'";

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
        $where.=" and  (vehicle.name LIKE '%".$_POST['cname']."%' OR fleet_issue.reportedOn LIKE '%".$_POST['cname']."%' OR fleet_issue.summary LIKE '%".$_POST['cname']."%' )";
        $name = $_POST['cname'];
      }
      if(isset($_POST['status']) && $_POST['status'] != "")
      {
        $where.=" and  fleet_issue.stat =  ".$_POST['status'];
        $status = $_POST['status'];
      }
      else
      {
        $where.=" and  fleet_issue.stat =  1";
        $status = 1;
      }
      $arrUser = GetRecords("SELECT fleet_issue.*, vehicle.name as VehName
                            from fleet_issue
                            inner join vehicle on vehicle.id = fleet_issue.id_vehicle

                              $where
                             order by vehicle.name");

?>
     <?php
      $bcName = "Fleet Issue  List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Fleet Issue List</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-fleet-issue.php'"?>Add Fleet Issue Entry</button>
                              
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
                      <form method="post" action="reporte_issue.php">
                        <button class="btn btn-success btn-rounded">PDF</button>
                        <a href="excel_llista_issue.php" target="_blank" class="btn btn-success btn-rounded">Excel</a>
                      </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-examplewithSearch">
                              <thead>
                                <tr>
                                  <th>Vehicle Name</th>
                                  <th>Reported On</th>
                                  <th>Priority</th>
                                  <th>Summary</th>
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
                                  <td class="tbdata"> <?php echo $value['VehName']?> </td>
                                  <td class="tbdata"> <?php echo $value['reportedOn']?> </td>
                                  <td class="tbdata"> <?php echo $arrPriority[$value['id_priority']]?> </td>
                                  <td class="tbdata"> <?php echo $value['summary']?> </td>
                                  <td> <button type="button" onclick="window.location='edit-fleet-issue.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Edit</button>
                                  <button type="button" onclick="window.location='view-fleet-issue.php?id=<?php echo $value['id']?>';" class="btn green btn-info">View</button>
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
