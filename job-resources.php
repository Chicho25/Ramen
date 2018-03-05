<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group required">
          <label class="col-lg-2 text-right control-label font-bold">Choose Vehicles</label>
          <div class="col-lg-6">
            <select class="chosen-select" data-placeholder="---select---" multiple name="vehicle[]" required="required" >
              <option value="">---select---</option>
              <?PHP
              $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
              foreach ($arrKindMeetings as $key => $value) {
                $kinId = $value['id'];
                $kinDesc = $value['name'];
                if($resvehicle != "") : 
                $expResVehicle = explode(",", $resvehicle);
                if (in_array($kinId, $expResVehicle))
                  $selRoll = 'selected' ;
                else
                  $selRoll = ''; 
                endif;
              ?>
              <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
              <?php
          }
              ?>
            </select>                   
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-2 text-right control-label font-bold">Choose Employees</label>
          <div class="col-lg-6">
            <select  class="chosen-select" data-placeholder="---select---" multiple name="employee[]"   required="required" >
              <option value="">---select---</option>
              <?PHP
              $arrKindMeetings = GetRecords("Select * from employee where stat=1");
              foreach ($arrKindMeetings as $key => $value) {
                $kinId = $value['id'];
                $kinDesc = $value['firstname'] ." ".$value['lastname'];

                if($resemployee != "") : 
                $expResEmp = explode(",", $resemployee);
                if (in_array($kinId, $expResEmp))
                  $selRoll = 'selected' ;
                else
                  $selRoll = ''; 
                endif;
              ?>
              <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
              <?php
          }
              ?>
            </select>                         
          </div>  
        </div>
    </fieldset>

</div>