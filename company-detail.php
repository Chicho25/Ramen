<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Name</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $name?>"  name="cname" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Phone Number</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $phone?>"  name="phone" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Address #1</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $address1?>"  name="address1" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Address #2</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $address2?>"  name="address2" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
            <label class="col-lg-4 text-right control-label font-bold">Country</label>
            <div class="col-lg-4">
                <select class="chosen-select form-control" name="country" required="required" onChange="mostrar(this.value);">
                  <?PHP
                  $arrKindMeetings = GetRecords("Select * from country where stat=1");
                  foreach ($arrKindMeetings as $key => $value) {
                    $kinId = $value['id'];
                    $kinDesc = $value['name'];
                    $selVal = ($country != "" && $country ==  $kinId) ? 'selected' : '';
                  ?>
                  <option value="<?php echo $kinId?>" <?php echo $selVal?>><?php echo $kinDesc?></option>
                  <?php
              }
                  ?>
                </select>
            </div>
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Province / State</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $province?>" name="province" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">City</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $city?>" name="city" data-required="true">                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label font-bold">Third Party Id</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" required="" value="<?php echo $thirdparty?>" name="thirdparty" data-required="true">                        
          </div>  
        </div>
        <?php if(isset($compid) && $compid) : ?>
        <div class="form-group required">
          <label class="col-lg-4 text-right control-label">Active/Deactive</label>
          <div class="col-lg-4">
              <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
              
          </div>

        </div>  
      <?php endif;?>
    </fieldset>

</div>