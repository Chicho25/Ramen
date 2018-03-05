<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Primary Meter</label>
            <div class="col-sm-10">
              <div class="i-checks">
              	<label> <input type="radio" value="kc" name="primarymeter" <?php echo $kc?>> <i></i> Kilometers (Carrier)</label>
              </div>
              <div class="i-checks">
              	<label> <input type="radio"  value="hc" name="primarymeter" <?php echo $hc?>> <i></i> Hours (Carrier) </label>
              </div>
              <div class="i-checks">
              	<label> <input type="radio"  value="hcu" name="primarymeter" <?php echo $hcu?>> <i></i> Hours (Carrier &amp; Upper) </label>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Odometer (km)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $odometer?>"   name="odometer">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Carrier Engine Hour</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $carrierengine?>"   name="carrierengine">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Upper Engine Hour</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  value="<?php echo $upperengine?>"  name="upperengine">
            </div>
        </div>
    </fieldset>
</div>