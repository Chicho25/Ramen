<?php

include("include/config.php");
include("include/defs.php");

$arrUser = GetRecords("SELECT * FROM inventory_adjustment WHERE id =".$_GET['id']);

 ?>
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Ajuste de Inventario</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Localidad</label>
            <div class="col-lg-8">
                <select class="chosen-select form-control" name="warehouse" id="warehouse" required="required" onchange="getQtyInHand()">
                  <?PHP
                  $arrKindMeetings = GetRecords("Select * from location where stat=1");
                  foreach ($arrKindMeetings as $value) {
                    $kinId = $value['id'];
                    $kinDesc = $value['description'];
                  ?>
                  <option value="<?php echo $kinId?>" <?php if($arrUser[0]['id_warehouse']==$kinId){ echo 'selected';} ?> ><?php echo $kinDesc?></option>
                  <?php
                  }
                  ?>
                </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Item</label>
            <div class="col-lg-8">
                <select class="chosen-select form-control" onchange="getQtyInHand()" name="itemid" id="itemid" required="required" >
                  <option value="">--------</option>
                  <?PHP
                  $arrKindMeetings = GetRecords("Select * from items where stat=1");
                  foreach ($arrKindMeetings as $value) {
                    $kinId = $value['id'];
                    $kinDesc = $value['description'];
                  ?>
                  <option value="<?php echo $kinId?>" <?php if($arrUser[0]['id_item']==$kinId){ echo 'selected';} ?> ><?php echo $kinDesc?></option>
                  <?php
                  }
                  ?>
                </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Tipo</label>
            <div class="col-lg-8">
                <select class="chosen-select form-control" onchange="getQtyInHand()" name="type" id="itemid" required="required" >
                  <option value="">Seleccionar</option>
                  <option value="1" <?php if($arrUser[0]['type']==1){ echo 'selected';} ?> >Compra</option>
                  <option value="2" <?php if($arrUser[0]['type']==2){ echo 'selected';} ?> >Ajuste</option>
                </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Referencia</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" required="" name="reference" value="<?php echo $arrUser[0]['reference'];?>">
            </div>
          </div>
          <div class="form-group">
              <label class="col-lg-4 text-right control-label font-bold">Fecha</label>
              <div class="col-lg-8" id="data_1">
                  <div class="input-group date">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" required="" class="form-control" name="date" id="date" value="<?php echo $arrUser[0]['date'];?>">
                  </div>

              </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Ajuste Orden#</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" required="" readonly="" value="<?php echo $arrUser[0]['order_no'];?>" name="adjorderno">
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Ajuste de cantidad por</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" required="" value="<?php echo $arrUser[0]['qty'];?>"  name="adjqty" id="adjqty">
            </div>
          </div>

          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Cantida a la mano</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" required="" required="" value="<?php echo $arrUser[0]['qty_in_hand'];?>" name="qtyinhand" >
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Nueva Cantidad</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" required="" value="<?php echo $arrUser[0]['qty_new'];?>"  name="addqty" id="addqty">
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Precio</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" required="" name="price" id="addqty" value="<?php echo $arrUser[0]['value'];?>">
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Motivo para ajustar</label>
            <div class="col-lg-8">
              <textarea rows="7" class="form-control" cols="44" name="reason" required=""  placeholder=""><?php echo $arrUser[0]['reason'];?></textarea>
            </div>
          </div>
          <div class="form-group required">
            <?php $status = ($arrUser[0]['stat'] == 0) ? 'checked' : ''; ?>
            <label class="col-lg-4 text-right control-label font-bold">Active/Deactive</label>
            <div class="col-lg-8">
                <input type="checkbox" class="js-switch" name="stat" <?php echo $status;?>>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_ajustament" value="<?php echo $_GET['id']; ?>">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" name="messaje">Enviar</button>
      </div>
    </div>
    </form>
  </div>
