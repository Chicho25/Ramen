<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Smtp Server</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $smtp?>"  name="smtp" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Port</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $port?>" name="port" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">SSL Option</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $ssl?>" name="ssl" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Subject</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $subject?>" name="subject" data-required="true">                        
          </div>  
        </div>
    </fieldset>

</div>