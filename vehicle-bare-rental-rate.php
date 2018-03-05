<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <label class="checkbox-inline"> 
                <input type="checkbox" value="1" name="barerental" <?php echo $bare_rental_product ?>> Bare Rental Product 
              </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Hourly ($/hr)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $hourly_bare?>"   name="hourly">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Daily ($)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $daily_bare?>"  name="daily">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Weekly ($)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $weekly_bare?>"  name="weekly">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Monthly ($)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $monthly_bare?>"  name="monthly">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Yearly ($)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $yearly_bare?>"  name="yearly">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Overtime ($/hr)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $overtime_bare?>"  name="overtime">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Double Time ($/hr)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $doubletime_bare?>"  name="doubletime">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Travel Time ($/hr)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $traveltime_bare?>"  name="traveltime">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Daily Minimum (hr)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $dailyminimum_bare?>"  name="dailyminimu">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Project Minimum (hr)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $projectminimum_bare?>"  name="projectminimu">
            </div>
        </div>
    </fieldset>


</div>