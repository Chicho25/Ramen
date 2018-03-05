<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Upload Logo</label>
            <div class="col-sm-6">
              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <span class="fileinput-filename"></span>
                    </div>
                    <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="document"/>
                    </span>
                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div> 
            </div>
        </div>
        <?php if($compid > 0) : 
            $getCompLogo = GetRecord("company_logo",  " id_company = ".$compid);
        ?>
        <div class="form-group">
          <div class="col-sm-6">
            <img src="<?php echo $getCompLogo['path']?>">
          </div>
        </div>    
        <?php endif;?>    
    </fieldset>
</div>