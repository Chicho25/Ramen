<?php
    ob_start();
    $inventoryclass="class='active'";
    $listAjustclass="class='active'";

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

     if(isset($_POST['messaje']))
      {

           $arrVal = array(
                         "id_item" => $_POST['itemid'],
                         "id_warehouse" => $_POST['warehouse'],
                         "reference" => $_POST['reference'],
                         "date" => $_POST['date'],
                         "order_no" => $_POST['adjorderno'],
                         "qty" => $_POST['adjqty'],
                         "qty_in_hand" => $_POST['qtyinhand'],
                         "qty_new" => $_POST['addqty'],
                         "reason" => $_POST['reason'],
                         "entry_by" => $_SESSION['USER_ID'],
                         "value"=>$_POST['price'],
                         "type"=>$_POST['type']
                        );

           if(UpdateRec("inventory_adjustment", "id=".$_POST['id_ajustament'], $arrVal))
           {
               $message = '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>Inventario ajustado</strong>
                     </div>';
           }
           else
           {
             $message = '<div class="alert alert-success">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Inventario ajustado Actualizado</strong>
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
?>
     <?php
      $bcName = "Lista de Ajuste";
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
                              <button type="button" class="btn btn-success btn-rounded" onclick="window.location='inventory-adjust.php'"?>Ajuste de Inventario</button>
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
                                  <th>Item</th>
                                  <th>Tipo</th>
                                  <th>Almacen</th>
                                  <th>Referencia</th>
                                  <th>Fecha</th>
                                  <th>N# Orden</th>
                                  <th>Cantidad</th>
                                  <th>Motivo</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP
                              $arrUser = GetRecords("SELECT
                                                      items.description as nombre_item,
                                                      location.description as localidad,
                                                      inventory_adjustment.*
                                                     from inventory_adjustment
                                                     inner join items on items.id = inventory_adjustment.id_item
                                                     inner join location on location.id = inventory_adjustment.id_warehouse
                                                     $where ");

                                foreach ($arrUser as $key => $value) {

                                  //$stock = getInventoryItemQty($value['id']);

                                  $cantidad_items = cantidadEnInventario($value['id']);
                                ?>
                              <tr>
                                  <td class="tbdata"> <?php echo $value['nombre_item']?> </td>
                                  <td class="tbdata"> <?php if($value['type']==1){ echo 'Compra';}elseif($value['type']==2){ echo 'Ajuste';}?> </td>
                                  <td class="tbdata"> <?php echo $value['localidad']?> </td>
                                  <td class="tbdata"> <?php echo $value['reference']?> </td>
                                  <td class="tbdata"> <?php echo $value['date']?> </td>
                                  <td class="tbdata"> <?php echo $value['order_no']?> </td>
                                  <td class="tbdata"> <?php echo $value['qty']?> </td>
                                  <td class="tbdata"> <?php echo $value['reason']?> </td>
                                  <td>
                                    <a href="ajustes.php?id=<?php echo $value["id"]; ?>" class="btn btn-primary" title="Actualizar" data-toggle="ajaxModal">Ver/Editar</a>
                                  </td>
                              </tr>
                              <?php
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
