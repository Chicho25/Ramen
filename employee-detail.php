<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group"><label class="col-sm-2 control-label">ID Card/Password</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required="" value="<?php echo $idcard?>"  name="idcard">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required="" value="<?php echo $fname?>"  name="fname" >
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required="" value="<?php echo $lname?>"  name="lname" >
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Job Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jobtitle" value="<?php echo $jobtitle?>" >
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Cell Phone#</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="cellphone" value="<?php echo $cellphone?>">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" required="" name="email" value="<?php echo $email?>">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Third Party Id</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thirdparty" value="<?php echo $thirdparty?>" >
            </div>
        </div>
        <?php if(isset($empid) && $empid) : ?>
        <div class="form-group required">
          <label class="col-sm-2 control-label">Active/Deactive</label>
          <div class="col-sm-10">
              <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
              
          </div>

        </div>  
      <?php endif;?>
    </fieldset>

</div>