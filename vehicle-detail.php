<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required="" value="<?php echo $name?>"  name="name">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Make</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required="" value="<?php echo $make?>"  name="make" >
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Model</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required="" value="<?php echo $model?>"  name="model" >
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Year</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="year" value="<?php echo $year?>" >
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">License Plate</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="license" value="<?php echo $license?>">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Serial No</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="serialno" value="<?php echo $serial_no?>">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Tonnage</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tonnage" value="<?php echo $tonnage?>" >
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-2 control-label">Type</label>
            <div class="col-sm-10">
                <select class="chosen-select form-control" name="type" required="required" onChange="mostrar(this.value);">
                  <?PHP
                  $arrKindMeetings = GetRecords("Select * from type_vehicle order by name");
                  foreach ($arrKindMeetings as $key => $value) {
                    $kinId = $value['id'];
                    $kinDesc = $value['name'];
                    $selRoll = (isset($type) && $type == $kinId) ? 'selected' : '';
                  ?>
                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                  <?php
              }
                  ?>
                </select>
            </div>
        </div>
        <?php if(isset($vehid) && $vehid) : ?>
        <div class="form-group required">
          <label class="col-sm-2 control-label">Active/Deactive</label>
          <div class="col-sm-10">
              <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
              
          </div>

        </div>  
      <?php endif;?>
    </fieldset>

</div>