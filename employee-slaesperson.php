<div class="panel-body">
    <fieldset class="form-horizontal">
    	<div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-2 pr0">
            	<label class="checkbox-inline">
                    <input type="checkbox" name="salesperson" <?php echo $salesperson ?>> Sales Person
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Commission (%)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $commission?>"  name="commission">
            </div>
        </div>    
    </fieldset>
</div>    