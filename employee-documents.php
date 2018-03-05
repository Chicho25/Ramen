<div class="panel-body">

    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Upload File</label>
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
        <?php if($empid > 0) : 
            $getVehDocum = GetRecords("select * from employee_document where id_employee = ".$empid);
        ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                  <thead>
                    <tr>
                      <th>File Id</th>
                      <th>File Name</th>
                      <th>Type</th>
                      <th>DateTime</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?PHP  
                    $i=1;
                    foreach ($getVehDocum as $vdkey => $vdvalue) {
                      
                      $ext = pathinfo($vdvalue['name'], PATHINFO_EXTENSION);
                    ?> 
                  <tr> 
                      <td class="tbdata"> <?php echo $vdvalue['id']?> </td>
                      <td class="tbdata"> <?php echo $vdvalue['name']?> </td>
                      <td class="tbdata"> <?php echo $ext?> </td>
                      <td class="tbdata"> <?php echo ''?> </td>
                      <td> 
                        <div class="lightBoxGallery pull-left">
                          <a href="<?php echo $vdvalue['path']?>" data-gallery="">View</a> <a class="m-l-sm" href='#' onclick="window.location='download.php?file=<?php echo $vdvalue['path']?>';"><i class="fa fa-download"></i></a> 
                          <a class="m-l-sm"  href='#' onclick="window.location='deleteempdoc.php?id=<?php echo $empid?>&did=<?php echo $vdvalue['id']?>&file=<?php echo $vdvalue['path']?>';"><i class="fa fa-trash-o"></i></a>
                        </div>
                      </td>
                  </tr>
                  <?php
                    $i++;
                  }
                  ?>
                  <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>
                  </tbody>
                </table>
            </div>
        <?php endif;?>    
    </fieldset>
</div>