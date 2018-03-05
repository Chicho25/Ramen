<?php 
    ob_start();
    $countryclass="class='active'";
    $editVehclass="class='active'";
    
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
        $where.=" and  (vehicle.name LIKE '%".$_POST['cname']."%' OR vehicle.make LIKE '%".$_POST['cname']."%' OR vehicle.license_plate LIKE '%".$_POST['cname']."%' OR type_vehicle.name LIKE '%".$_POST['cname']."%' or vehicle.id = '".$_POST['cname']."')";
        $name = $_POST['cname'];
      }
      if(isset($_POST['status']) && $_POST['status'] != "")
      {
        $where.=" and  vehicle.stat =  ".$_POST['status'];
        $status = $_POST['status'];
      }
      else
      {
        $where.=" and  vehicle.stat =  1";
        $status = 1;
      }
      $arrUser = GetRecords("SELECT vehicle.id, vehicle.name, vehicle.make, vehicle.license_plate, vehicle.stat, type_vehicle.name as VehType from vehicle
                              inner join type_vehicle  on type_vehicle.id = vehicle.type
                              $where
                             order by vehicle.name");
     
?>
     <?php 
      $bcName = "Vehicle List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Vehicle List</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-vehicle.php'"?>Add Vehicle</button>
                            </span>
                          </div>
                          <div class="col-sm-3 m-b-xs pull-right">
                            <div class="input-group">
                              <span class="input-group-btn padder "><button class="btn btn-success btn-rounded">Search</button></span>
                            </div>  
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="text" class="input-s input-sm form-control" value="<?php echo $name?>" name="cname" placeholder="Vehicle Name">
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="radio" name="status" value="1" <?php echo $c=(isset($status) && $status == 1) ? 'checked' : ''?> > Active
                              <input type="radio" name="status" value="0" <?php echo $c=(isset($status) && $status == 0) ? 'checked' : ''?> > Archived
                            </div>
                          </div>
                          
                        </div>
                      </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                              <thead>
                                <tr>
                                  <th>Vehicle Id</th>
                                  <th>Name</th>
                                  <th>License Plate</th>
                                  <th>Type</th>
                                  <th>Make</th>
                                  <th>Status</th>
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
                                  <td class="tbdata"> <?php echo $value['name']?> </td>
                                  <td class="tbdata"> <?php echo $value['license_plate']?> </td>
                                  <td class="tbdata"> <?php echo $value['VehType']?> </td>
                                  <td class="tbdata"> <?php echo $value['make']?> </td>                                  
                                  
                                  <td class="tbdata"> <?php echo $status?> </td>
                                  <td> <button type="button" onclick="window.location='edit-vehicle.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Edit</button> 
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