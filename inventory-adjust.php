<?php

    ob_start();
    $inventoryclass="class='active'";
    $registerInvAdjustclass="class='active'";

    include("include/config.php");
    include("include/defs.php");
    $loggdUType = current_user_type();

    include("header.php");

    if(!isset($_SESSION['USER_ID']))
     {
          header("Location: index.php");
          exit;
     }
     $message="";

    if(isset($_POST['submitUser']))
     {

          $arrVal = array(
                        "id_item" => $itemid,
                        "id_warehouse" => $warehouse,
                        "reference" => $reference,
                        "date" => $date,
                        "order_no" => maxAdjNumber(),
                        "qty" => $adjqty,
                        "qty_in_hand" => $qtyinhand,
                        "qty_new" => $addqty,
                        "reason" => $reason,
                        "entry_by" => $_SESSION['USER_ID'],
                        "value"=>$price
                       );

          $nId = InsertRec("inventory_adjustment", $arrVal);

          if($nId > 0)
          {

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Inventario ajustado</strong>
                    </div>';
          }
          else
          {

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error al ajustar el inventario</strong>
                  </div>';
          }

     }
?>
  <?php
      $bcName = "Inventory Adjustment";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ajuste de Inventario</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php
                                if($message !="")
                                    echo $message;
                          ?>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Localidad</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="warehouse" id="warehouse" required="required" onchange="getQtyInHand()">
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from location where stat=1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['description'];
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Item</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" onchange="getQtyInHand()" name="itemid" id="itemid" required="required" >
                                    <option value="">--------</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from items where stat=1");
                                    foreach ($arrKindMeetings as $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['description'];
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Referencia</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="reference">
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 text-right control-label font-bold">Fecha</label>
                                <div class="col-lg-4" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" required="" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Ajuste Orden#</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" readonly="" value="<?php echo maxAdjNumber()?>"   name="adjorderno">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Ajuste de cantidad por</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required="" onblur="addAdjustQty()"   name="adjqty" id="adjqty">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold"></label>
                              <div class="col-lg-8 no-padding">
                                <div class="col-lg-6 no-padding">
                                  <label class="col-lg-12 text-left control-label font-bold" style="text-align: center !important;">Cantida a la mano</label>
                                  <div class="col-lg-12">
                                    <input type="text" readonly="" class="form-control" required=""   name="qtyinhand" id="qtyinhand">
                                  </div>
                                </div>
                                <div class="col-lg-6 no-padding">
                                  <label class="col-lg-12 text-right control-label font-bold" style="text-align: center !important;">Nueva Cantidad</label>
                                  <div class="col-lg-12">
                                    <input type="text" class="form-control" readonly="" required=""   name="addqty" id="addqty">
                                  </div>
                                </div>
                                <div class="col-lg-6 no-padding">
                                  <label class="col-lg-12 text-right control-label font-bold" style="text-align: center !important;">Precio</label>
                                  <div class="col-lg-12">
                                    <input type="text" class="form-control" required="" name="price" id="addqty">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Motivo para ajustar</label>
                              <div class="col-lg-4">
                                <textarea rows="7" class="form-control" cols="44" name="reason" required=""  placeholder=""></textarea>
                              </div>
                            </div>
                          <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary" name="submitUser" type="submit">Guardar</button>
                                <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancelar</button>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

<?php
	include("footer.php");
?>
