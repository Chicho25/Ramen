<?php
  include("include/config.php");
  include("include/defs.php")
 ?>
<div class="modal-dialog" style="width:80%">
  <div class="modal-content">
  	<form role="form" class="form-horizontal" id="role-form"  method="post" action="" enctype="multipart/form-data">

	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Productos - Items</h4>
	    </div>
	    <div class="modal-body">
	      <div class="row">
		      <div class="form form-horizontal" style="padding:10px; margin:10px;">
            <table class="table table-striped b-t b-light tableline">
              <thead>
                <tr>
                  <th>Item Id</th>
                  <th>Item Descripcion</th>
                  <th>Stock</th>
                  <th>Cantidad</th>
                  <th>Comprados</th>
                  <th>Unidad de medida</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $arrOppDetail = GetRecords("select requisition_detail.* from requisition_detail
                                             where id_req = ".$_GET['id']);
                foreach ($arrOppDetail as $key => $value) {

                  $hdata = $value['id_item']."!".$value['stock']."!".$value['qty']."!".$value['buy']."!".$value['itmdesc']."!".$value['unitmeasure'];
                  if($value['id_item'] == -1)
                    $itm = "No en inventario";
                  else
                    $itm = $value['id_item']; ?>
                    <tr>
                      <input type='hidden' name='h1[]' value='<?php echo $hdata?>'>
                      <td><?php echo $itm?></td>
                      <td><?php echo $value['itmdesc']?></td>
                      <td><?php echo $value['stock']?></td>
                      <td><?php echo $value['qty']?></td>
                      <td><?php echo $value['buy']?></td>
                      <td><?php echo $value['unitmeasure']?></td>
                    </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
			    </div>
			  </div>
    </div>
	    <div class="modal-footer">
	      <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
