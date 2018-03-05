<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group required">
          <label class="col-sm-2 text-right control-label font-bold">Ticket Id</label>
          <div class="col-sm-5 ph0">
            <input type="text" class="form-control" required="" name="ticketid" id="ticketid" value="<?php echo $ticketid ?>">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-sm-2 text-right control-label font-bold">Project</label>
          <div class="col-sm-5  ph0 ">
            <input type="text" class="form-control" required="" name="project" id="project" value="<?php echo $project ?>">                        
          </div>  
        </div>
        <div class="form-group required">
            <label class="col-sm-2 text-right control-label font-bold">Contact</label>
            <div class="col-sm-5 ph0">
                <select class="chosen-select form-control" name="contact" id="contact" required="required" onChange="getOptionsData(this.value, 'showcustomerlink', 'showcustomerlink');">
                  <option value="">--Select---</option>
                  <?PHP
                  $arrKindMeetings = GetRecords("Select * from contact where stat=1");
                  foreach ($arrKindMeetings as $key => $value) {
                    $kinId = $value['id'];
                    $kinDesc = $value['name'];
                    $selRoll = (isset($contact) && $contact == $kinId) ? 'selected' : '';
                  ?>
                  <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                  <?php
              }
                  ?>
                </select>
            </div>
            <div class="col-sm-3" id="showcustomerlink" style="display: none;">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-5">
              <label class="col-sm-2 control-label">Date</label>
            </div>
            <div class="col-sm-5">
              <label class="col-sm-2 control-label">Time</label>
            </div>
            <div id="showerror" class="col-sm-12" style="display:none;color: red">Dates should be equal or greater than start date</div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Start</label>
            <div class="col-sm-4 ph0" id="data_1">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" required="" class="form-control" name="startdate" id="startdate" value="<?php echo $startdate ?>">
                </div>
              
            </div>
            <div class="col-sm-5">
              <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" class="form-control" name="starttime" value="<?php echo $starttime?>" >
                  <span class="input-group-addon">
                      <span class="fa fa-clock-o"></span>
                  </span>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Estimated End</label>
            <div class="col-sm-4 ph0" id="data_2">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" required="" class="form-control" name="estimatedate" id="estimatedate" value="<?php echo $estimatedate ?>" onchange="checkDate()">
                </div>
              
            </div>
            <div class="col-sm-5">
              <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" class="form-control" name="estimatetime" value="<?php echo  $estimatetime?>" >
                  <span class="input-group-addon">
                      <span class="fa fa-clock-o"></span>
                  </span>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Delivery</label>
            <div class="col-sm-4 ph0" id="data_3">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" onchange="checkDate()" name="deliverydate" id="deliverydate" value="<?php echo $deliverydate ?>">
                </div>
              
            </div>
            <div class="col-sm-5">
              <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" class="form-control" name="deliverytime" value="<?php echo $deliverytime?>" >
                  <span class="input-group-addon">
                      <span class="fa fa-clock-o"></span>
                  </span>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Actual End</label>
            <div class="col-sm-4 ph0" id="data_4">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" onchange="checkDate()" name="actualenddate" id="actualenddate" value="<?php echo $actualenddate ?>">
                </div>
              
            </div>
            <div class="col-sm-5">
              <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" class="form-control" name="actualendtime" value="<?php echo $actualendtime?>" >
                  <span class="input-group-addon">
                      <span class="fa fa-clock-o"></span>
                  </span>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-9 pl0">
              
              <select class="chosen-select form-control" name="status" required="required" >
                <?PHP
                
                foreach ($arrJobStatus as $key => $value) {
                  $selRoll = (isset($jobstatus) && $jobstatus == $key) ? 'selected' : '';
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