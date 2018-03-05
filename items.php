<?php
    ob_start();
    $inventoryclass="class='active'";
    $edititemclass="class='active'";

    include("include/config.php");
    include("include/defs.php");
    $loggdUType = current_user_type();

    include("header.php");

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User")
     {
          header("Location: index.php");
          exit;
     }

     $message = "";

     if (isset($_POST['id_item'])){
       if($_POST['n_cantidad']!=''){
         $array_cant = array("m_min_stock"=>$_POST['n_cantidad']);
        UpdateRec("items", "id=".$_POST['id_item'], $array_cant);
        $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Actualizado con Exito</strong>
                    </div>';
      }
     }

    $where = "where (1=1)";

      $name = "";
      if(isset($_POST['cname']) && $_POST['cname'] != "")
      {
        $where.=" and  (items.description LIKE '%".$_POST['cname']."%' OR item_types.description LIKE '%".$_POST['cname']."%' OR items.id LIKE '%".$_POST['cname']."%' )";
        $name = $_POST['cname'];
      }
      if(isset($_POST['status']) && $_POST['status'] != "")
      {
        $where.=" and  items.stat =  ".$_POST['status'];
        $status = $_POST['status'];
      }
      else
      {
        $where.=" and  items.stat =  1";
        $status = 1;
      }
      $arrUser = GetRecords("SELECT items.*, item_types.description as typename
                            from items
                            inner join item_types on item_types.id = items.id_type
                              $where ");

?>
     <?php
      $bcName = "Items List";
      include("breadcrumb.php") ;
    ?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
            <?php echo $message; ?>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Items Lista</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='register-item.php'"?>Agregar un Item</button>
                            </span>
                          </div>
                          <div class="col-sm-3 m-b-xs pull-right">
                            <div class="input-group">
                              <span class="input-group-btn padder "><button class="btn btn-success btn-rounded">Buscar</button></span>
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="text" class="input-s input-sm form-control" value="<?php echo $name?>" name="cname" placeholder="">
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">
                              <input type="radio" name="status" value="1" <?php echo $c=(isset($status) && $status == 1) ? 'checked' : ''?> > Activo
                              <input type="radio" name="status" value="0" <?php echo $c=(isset($status) && $status == 0) ? 'checked' : ''?> > Archivado
                            </div>
                          </div>

                        </div>
                      </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                              <thead>
                                <tr>
                                  <th>Item Id</th>
                                  <th>Descripcion</th>
                                  <th>Tipo</th>
                                  <th>Accion</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP
                                $i=1;
                                foreach ($arrUser as $key => $value) {

                                  $status = ($value['stat'] == 1) ? 'Active' : 'In Active';
                                  //$stock = getInventoryItemQty($value['id']);

                                  $cantidad_items = cantidadEnInventario($value['id']);
                                ?>
                              <tr>
                                  <td class="tbdata"> <?php echo $value['id']?> </td>
                                  <td class="tbdata"> <?php echo $value['description']?> </td>
                                  <td class="tbdata"> <?php echo $value['typename']?> </td>
                                  <td><button type="button" onclick="window.location='edit-item.php?id=<?php echo $value['id']?>';" class="btn green btn-info">Edit</button>
                                      <button type="button" onclick="window.location='view-item.php?id=<?php echo $value['id']?>';" class="btn green btn-info">View</button>
                                  </td>
                              </tr>

                              <div class="modal fade" id="modal_cant<?php echo $value["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <form class="" action="" method="post">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Actualizar Minimo en Stock</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <label for="exampleInputEmail1">Item</label>
                                      <input class="form-control" name="" value="<?php echo $value['description']?>" readonly>
                                      <label for="exampleInputEmail1">Cantidad Actual</label>
                                      <input class="form-control" name="" value="<?php echo $value['m_min_stock']; ?>" readonly>
                                      <label for="exampleInputEmail1">Nueva Cantidad</label>
                                      <input class="form-control" type="number" name="n_cantidad" value="">
                                    </div>
                                    <div class="modal-footer">
                                      <input type="hidden" name="id_item" value="<?php echo $value["id"]; ?>">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                      <button class="btn btn-primary" name="messaje">Enviar</button>
                                    </div>
                                  </div>
                                  </form>
                                </div>
                              </div>
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
