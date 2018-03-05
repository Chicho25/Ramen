<div class="panel-body qualification">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-4">
              <label class="col-sm-6 control-label">Certification Date</label>
            </div>
            <div class="col-sm-4">
              <label class="col-sm-6 control-label">Expiration Date</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 pr0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="craneoperator" id="craneoperator" onclick="checkQlf()" <?php echo $craneoperator ?>> Crane Operator
                </label>
            </div>
            <div class="col-sm-1 ph0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfcertified1" id="qlfcertified1" onclick="checkQlf()" <?php echo $qlfcertified1 ?>> Certified
                </label>
            </div>
            <div class="col-sm-4 ph0" id="data_1">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="certificationdate1" id="certificationdate1" value="<?php echo $certificationdate1 ?>">
                </div>
              
            </div>
            <div class="col-sm-4" id="data_2">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="expirationdate1" id="expirationdate1" value="<?php echo $expirationdate1 ?>">
                </div>
              
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 pr0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfsignalperson" id="qlfsignalperson" onclick="checkQlf()" <?php echo $qlfsignalperson ?>> SignalPerson
                </label>
            </div>
            <div class="col-sm-1 ph0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfcertified2" id="qlfcertified2"  onclick="checkQlf()" <?php echo $qlfcertified2 ?>> Certified
                </label>
            </div>
            <div class="col-sm-4 ph0" id="data_3">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="certificationdate2" id="certificationdate2" value="<?php echo $certificationdate2 ?>">
                </div>
              
            </div>
            <div class="col-sm-4" id="data_4">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="expirationdate2" id="expirationdate2" value="<?php echo $expirationdate2 ?>">
                </div>
              
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 pr0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfrigger" id="qlfrigger" onclick="checkQlf()" <?php echo $qlfrigger ?>> Rigger
                </label>
            </div>
            <div class="col-sm-1 ph0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfcertified3" id="qlfcertified3" onclick="checkQlf()" <?php echo $qlfcertified3 ?>> Certified
                </label>
            </div>
            <div class="col-sm-4 ph0" id="data_5">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="certificationdate3" id="certificationdate3" value="<?php echo $certificationdate3 ?>">
                </div>
              
            </div>
            <div class="col-sm-4 " id="data_6">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="expirationdate3" id="expirationdate3" value="<?php echo $expirationdate3 ?>">
                </div>
              
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 pr0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfmechanic" id="qlfmechanic" onclick="checkQlf()" <?php echo $qlfmechanic ?>> Mechanic
                </label>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-sm-2 pr0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfelectromechanic" id="qlfelectromechanic" onclick="checkQlf()" <?php echo $qlfelectromechanic ?>> Electro Mechanic
                </label>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-sm-2 pr0">
                <label class="checkbox-inline">
                    <input type="checkbox" name="qlfinspector" id="qlfinspector" onclick="checkQlf()" <?php echo $qlfinspector ?>> Inspector
                </label>
            </div>
        </div>    
    </fieldset>
</div>        