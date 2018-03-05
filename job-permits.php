<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Travel Permit</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="travelp"  >
                <?PHP
                
                foreach ($arrPermits as $key => $value) {
                  $selRoll = (isset($travelp) && $travelp == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Street Use Permit</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="streetusep"  >
                <?PHP
                
                foreach ($arrPermits as $key => $value) {
                  $selRoll = (isset($streetusep) && $streetusep == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">City Permit</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="cityp"  >
                <?PHP
                
                foreach ($arrPermits as $key => $value) {
                  $selRoll = (isset($cityp) && $cityp == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Country Permit</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="countryp"  >
                <?PHP
                
                foreach ($arrPermits as $key => $value) {
                  $selRoll = (isset($countryp) && $countryp == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">State Permit</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="statep"  >
                <?PHP
                
                foreach ($arrPermits as $key => $value) {
                  $selRoll = (isset($statep) && $statep == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Miscellaneous Permit</label>
            <div class="col-sm-9">
              
              <select class="chosen-select form-control" name="miscellaneousp"  >
                <?PHP
                
                foreach ($arrPermits as $key => $value) {
                  $selRoll = (isset($miscellaneousp) && $miscellaneousp == $key) ? 'selected' : '';
                ?>
                <option value="<?php echo $key?>" <?php echo $selRoll?>><?php echo $value?></option>
                <?php
              }
                ?>
              </select>
            </div>
        </div>
    </fieldset>


</div>