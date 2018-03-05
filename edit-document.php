<?php 

    ob_start();
    $fleetclass="class='active'";
    $editDocumentclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID']) || $loggdUType == "User") 
     {
          header("Location: index.php");
          exit;
     }
     $message="";
    if(isset($_POST['submitUser']) && $_REQUEST['id'] > 0)
     {
        
          $stval = (isset($_POST['status'])) ? 1 : 0;
          $arrVal = array(
                        "id_vehicle" => $vehicle,
                        "name" => $name,
                        "description" => $description,
                        "stat" => $stval
                       );
          
          UpdateRec("documents", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              if(isset($_FILES['document']) && count($_FILES['document']['tmp_name']) > 0 )
              {
                  $target_dir = "fleetdocuments/";
                  foreach ($_FILES['document']['tmp_name'] as $key => $value) {
                    $fbase = basename($_FILES['document']["name"][$key]);
                    $target_file = $target_dir . basename($_FILES['document']["name"][$key]);  
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    $filename = $target_dir . $fbase.".".$imageFileType;
                    $filenameThumb = $target_dir . $fbase."_thumb.".$imageFileType;
                    if (move_uploaded_file($value, $filename)) 
                    {
                        makeThumbnailsWithGivenWidthHeight($target_dir, $imageFileType, $fbase, 100, 100);
                        $arrDocument = array("id_document" => $nId, "name" => $target_file, "path" => $filenameThumb);
                        InsertRec("documents_file", $arrDocument);    
                    }
                  }
                  
              }

              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Document updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("documents", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';

?>
  <?php 
      $bcName = "Edit Document";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Document</h5>
                    </div>
                    <div class="ibox-content">
                     <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Vehicle</label>
                              <div class="col-sm-4">
                                  <select class="chosen-select form-control" name="vehicle"  id="vehicle" required="required">
                                    <option value="">--Select---</option>
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from vehicle where stat=1");
                                    foreach ($arrKindMeetings as $key => $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['name'];
                                      $selRoll = (isset($arrUser['id_vehicle']) && $arrUser['id_vehicle'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Name</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" value="<?php echo $arrUser['name']?>" placeholder="Title" name="name" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group">
                            <label class="col-lg-4 text-right control-label font-bold">Description</label>
                            <div class="col-lg-4">
                              <textarea rows="7" class="form-control" cols="44" name="description" required=""  placeholder=""><?php echo $arrUser['description']?></textarea>                          
                            </div>  
                          </div>
                          <?php 
                            $arrDocList = GetRecords("select * from documents_file where id_document = ".$_REQUEST['id']);
                            foreach ($arrDocList as $key => $value) {
                            
                          ?>
                              <div class="form-group">
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-6">
                                  <a href="download.php?file=<?php echo $value['path']?>" title="Image from Unsplash" target="_blank"><?php echo $value['path']?></a>
                                  <a class="btn btn-danger btn-sm" href="delete-document.php?rid=<?php echo $_REQUEST['id']?>&id=<?php echo $value['id']?>&file=<?php echo $value['path']?>" title="Image from Unsplash">Delete</a>
                                </div>
                              </div>
                            <?php
                              }
                            ?>   
                          <div class="form-group">
                              <label class="col-lg-4 control-label">Upload Document</label>
                              <div class="col-lg-6">
                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                      <div class="form-control" data-trigger="fileinput">
                                          <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                      <span class="fileinput-filename"></span>
                                      </div>
                                      <span class="input-group-addon btn btn-default btn-file">
                                          <span class="fileinput-new">Select file</span>
                                          <span class="fileinput-exists">Change</span>
                                          <input type="file" multiple name="document[]"/>
                                      </span>
                                      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                  </div> 
                              </div>
                              <div class="col-lg-2">
                                  <button class="btn btn-primary" name="submitUser" onclick="addMultipleFile()" type="button">Add Multiple File</button>
                              </div>
                              <div id="showMultiple">

                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 font-bold control-label">Active/Deactive</label>
                            <div class="col-lg-4">
                                <input type="checkbox" class="js-switch" name="status" <?php echo $status?>>
                                
                            </div>

                          </div>  

                          <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">  
                                        <button class="btn btn-primary" name="submitUser" type="submit">Update</button>
                                        <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                                    </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show().attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
<?php    
  include("footer.php"); 
?> 