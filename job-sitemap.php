<div class="panel-body">

        <div class="form-group required">
          <label class="col-lg-2 text-right control-label font-bold">Contact</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" required="" value="<?php echo $contactoff?>"  name="contactoff"  >                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-2 text-right control-label font-bold">Phone</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" required="" value="<?php echo $phone?>" name="phone" >                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-2 text-right control-label font-bold">Address</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" required="" onblur="setMarket()" value="<?php echo $address1?>" name="address1" id="address1" >                        
          </div>  
        </div>
        <div class="form-group required">
          <label class="col-lg-2 text-right control-label font-bold"></label>
          <div class="col-lg-6">
            <input type="text" class="form-control" value="<?php echo $address2?>" name="address2" >                        
          </div>  
        </div>
        <div class="form-group required">
          <div class="google-map" id="map1"></div>
        </div>

</div>