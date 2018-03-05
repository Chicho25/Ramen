<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-12 text-left">Notes</label>
            <div class="col-sm-12">
              <input type="text" class="form-control"  value="<?php echo $notes?>"   name="notes" required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
              <label class="checkbox-inline"> 
                <input type="checkbox" value="1" name="liftprovidedby" <?php echo $liftprovidedby ?> required="required"> Lift Information was provided by us.
              </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Provided By</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $providor?>"   name="providor" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="unit" required="required" >
                <?PHP
                
                foreach ($arrUnits as $key => $value) {
                  $selRoll = (isset($units) && $units == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
        <div class="col-sm-8">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Load Weight (lbs)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $loadweight?>"  name="loadweight" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Load Length (ft)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $loadlength?>"  name="loadlength" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Load Width (ft)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $loadwidth?>"  name="loadwidth" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Load Height (ft)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $loadheight?>"  name="loadheight" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Load Radius (ft)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $loadradius?>"  name="loadradius" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Obstruction Length ($/hr)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $obstructionlength?>"  name="obstructionlength" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Obstruction Width (hr)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $obstructionwidth?>"  name="obstructionwidth" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Obstruction Height (hr)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $obstructionheight?>"  name="obstructionheight" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Lift Depth (ft)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $liftdepth?>"  name="liftdepth" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Setup Distance (hr)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  value="<?php echo $setupdistance?>"  name="setupdistance" required="required">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <img src="img/lift.png" border="0">
            </div>
    </fieldset>


</div>