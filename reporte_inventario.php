<?php
    ob_start();
    $reportclass="class='active'";
    $reportinvclass="class='active'";

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
		$where2 = "where (1=1)";

      if(isset($_POST['desde']) && $_POST['desde'] != "")
      {
        $where.=" and inventory_adjustment.date >= '".$_POST['desde']."'";
				$where2.=" and requisition.request_date >= '".$_POST['desde']."'";
        $desde = $_POST['desde'];
      }
			if(isset($_POST['hasta']) && $_POST['hasta'] != "")
			{
				$where.=" and inventory_adjustment.date <= '".$_POST['hasta']."'";
				$where2.=" and requisition.request_date <= '".$_POST['hasta']."'";
				$hasta = $_POST['hasta'];
			}

      if(isset($_POST['id_type']) && $_POST['id_type'] == 1)
      {
        $where.=" and inventory_adjustment.stat = 1";
        $id_type = $_POST['id_type'];
      }elseif(isset($_POST['id_type']) && $_POST['id_type'] == 0){
				$where2.=" and requisition.stat = 1";
				$id_type = $_POST['id_type'];
			}
      $arrUser = GetRecords("(select
																inventory_adjustment.date as fecha,
																inventory_adjustment.reason as motivo,
																location.description as localidad,
																inventory_adjustment.reference as referencia,
																items.description as nombre_item,
																inventory_adjustment.qty as cantidad_ingresada_solicitada,
																inventory_adjustment.qty_in_hand as cantidad_actual,
																inventory_adjustment.qty_new as nueva_cantidad_restante,
																inventory_adjustment.value,
																'Ingreso' as stat,
																1 as tipo,
																'-' as nombre,
																'-' as apellido
																from
																inventory_adjustment inner join items on items.id = inventory_adjustment.id_item
																					 					 inner join location on location.id = inventory_adjustment.id_warehouse
																$where
																)union(
																select
																requisition.request_date as fecha,
																requisition.notes as motivo,
																location.description as localidad,
																requisition.department as referencia,
																items.description as nombre_item,
																requisition_detail.qty as cantidad_ingresada_solicitada,
																requisition_detail.stock as cantidad_actual,
																(requisition_detail.stock - requisition_detail.qty) as nueva_cantidad_restante,
																'-' as value,
																'Salida' as stat,
																0 as tipo,
																employee.firstname as nombre,
																employee.lastname as apellido
																from requisition inner join location on location.id = requisition.id_warehouse
																				 				 inner join employee on employee.id = requisition.request_by
																                 inner join requisition_detail on requisition.id = requisition_detail.id_req
																                 inner join items on requisition_detail.id_item = items.id
																$where2)
																order by 1 desc");?>
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
                        <h5>Inventario</h5>
                    </div>
                    <div class="ibox-content">
                      <form method="post">
                        <div class="row wrapper ">
                          <div class="col-sm-3 pull-left">
                            <span class="input-group-btn padder ">
                              <button type="button" class="btn btn-success btn-rounded">PDF</button>
                            </span>
                          </div>
                          <div class="col-sm-2 m-b-xs pull-left">
                            <div class="input-group">
                              <select class="form-control" name="id_type">
                                <option value="">Seleccionar</option>
                                <option value="1" <?php if (isset($id_type) && $id_type == 1) { echo 'selected';} ?>>Ingreso</option>
																<option value="0" <?php if (isset($id_type) && $id_type == 0) { echo 'selected';} ?>>Salida</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3 m-b-xs pull-right">
                            <div class="input-group">
                              <span class="input-group-btn padder "><button class="btn btn-success btn-rounded">Buscar</button></span>
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" id="data_1">
                            <div class="input-group">Hasta
															<div class="input-group date">
                                  <input type="text" class="form-control" name="hasta" id="date" value="<?php if(isset($hasta)){ echo $hasta;}?>">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>
                          </div>
													<div class="col-sm-2 m-b-xs ph0 pull-right" id="data_2">
                            <div class="input-group">Desde
															<div class="input-group date">
                                  <input type="text" class="form-control" name="desde" id="date" value="<?php if(isset($desde)){ echo $desde;}?>">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2 m-b-xs ph0 pull-right" >
                            <div class="input-group">

                            </div>
                          </div>
                        </div>
                      </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                              <thead>
                                <tr>
                                  <th>Fecha</th>
                                  <th>Motivo</th>
                                  <th>Localidad</th>
                                  <th>Item</th>
																	<th>Costo</th>
																	<th>Tipo</th>
                                  <th>C. Ingresada</th>
                                  <th>C. Solicitada</th>
                                  <th>Stock</th>
																	<th>Actual</th>
																	<th>Solisitado Por</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?PHP
                                $i=1;
                                foreach ($arrUser as $key => $value) { ?>
                              <tr>
                                  <td class="tbdata"> <?php echo $value['fecha']?> </td>
                                  <td class="tbdata"> <?php echo $value['motivo']?> </td>
                                  <td class="tbdata"> <?php echo $value['localidad']?> </td>
                                  <td class="tbdata"> <?php echo $value['nombre_item']?> </td>
                                  <td class="tbdata"> <?php echo $value['value']?> </td>
                                  <td class="tbdata"> <?php echo $value['stat']?> </td>
                                  <td class="tbdata"> <?php echo $value['cantidad_ingresada_solicitada']?> </td>
																	<td class="tbdata"> <?php echo $value['cantidad_ingresada_solicitada']?> </td>
																	<td class="tbdata"> <?php echo $value['cantidad_actual']?> </td>
																	<td class="tbdata"> <?php echo $value['nueva_cantidad_restante']?> </td>
																	<td class="tbdata"> <?php echo $value['nombre'].' '.$value['apellido']?> </td>
                              </tr>
                              <?php } ?>
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
