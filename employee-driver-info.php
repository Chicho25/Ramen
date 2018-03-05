<div class="panel-body">
    <fieldset class="form-horizontal">
    	<div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-2 pr0">
            	<label class="checkbox-inline">
                    <input type="checkbox" name="driver" <?php echo $driver ?>> Driver
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">License Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $licensenumber?>"  name="licensenumber">
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-2 control-label">License Class</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $licenseclass?>"  name="licenseclass">
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-2 control-label">License Expiration</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $licenseexpire?>"  name="licenseexpire">
            </div>
        </div>    
    </fieldset>
</div>    