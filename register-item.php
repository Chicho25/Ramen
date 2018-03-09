<?php

    ob_start();
    $inventoryclass="class='active'";
    $registerItemclass="class='active'";

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
                        "description" => $description,
                        "id_type" => $itemtype,
                        "manufacturer" => $manufacturer,
                        "manufacturer_num" => $manufacturernumber,
                        "unitofmeasure" => $unitofmeasure,
                        "lastunitcost" => round($lastunitcost,2),
                        "barcode" => $barcode,
                        "stat" => 1
                       );

          $nId = InsertRec("items", $arrVal);

          if($nId > 0)
          {

            if(isset($_FILES['photo']) && $_FILES['photo']['tmp_name'] != "")
            {
                $target_dir = "photos_items/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $filename = $target_dir . $nId.".".$imageFileType;
                $filenameThumb = $target_dir . $nId."_thumb.".$imageFileType;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $filename))
                {
                    makeThumbnailsWithGivenWidthHeight($target_dir, $imageFileType, $nId, 400, 400);

                    UpdateRec("items", "id = ".$nId, array("photos" => $filenameThumb));
                }
            }

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Item Creado con exito!</strong>
                    </div>';

                echo '<script>
                              alert("Item created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {

            $message = '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Item no fue creado!</strong>
                        </div>';
          }

     }
?>
  <?php
      $bcName = "Register Item";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Registrar Item</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php
                                if($message !="")
                                    echo $message;
                          ?>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Descripcion</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="description">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Item Tipo</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="itemtype" required="required" >
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from item_types where stat=1");
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
                              <label class="col-lg-4 text-right control-label font-bold">Manofactura</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="manufacturer">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Manofactura Parte#</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="manufacturernumber">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Unidad de medida</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="unitofmeasure">
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Ultimo costo unitario</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="lastunitcost">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-4 text-right control-label font-bold">Imagen</label>
                              <div class="col-lg-4">
                                  <div style="width:204px;
                                              height:154px;
                                              background-color: #cccccc;
                                              border: solid 2px gray;
                                              margin: 5px;">
                                      <img id="img" src="#" style='width:200px; height:150px;display: none;' alt="your image" />
                                  </div>
                                  <label class="btn yellow btn-default">
                                    Cargar Foto <input type="file" name="photo" style="display: none;" onchange="readURL(this);">
                                  </label>
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Codigo de barra</label>
                              <div class="col-lg-4">
                                <input type="text" class="form-control" required=""   name="barcode">
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
