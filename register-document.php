<?php 

    ob_start();
    $fleetclass="class='active'";
    $registerDocumentclass="class='active'";
    
    include("include/config.php"); 
    include("include/defs.php"); 
    $loggdUType = current_user_type();
    
    
    include("header.php"); 

    if(!isset($_SESSION['USER_ID'])) 
     {
          header("Location: index.php");
          exit;
     }
     $message="";

    if(isset($_POST['submitUser']))
     {       
        // echo "<pre>";
        // print_r($_FILES);exit;
          $arrVal = array(
                        "id_vehicle" => $vehicle,
                        "name" => $name,
                        "description" => $description,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "stat" => 1
                       );

          $nId = InsertRec("documents", $arrVal);    
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
                      <strong>Document created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Document created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Document not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Document";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Document</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
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
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Name</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Name" name="name" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group">
                            <label class="col-lg-4 text-right control-label font-bold">Description</label>
                            <div class="col-lg-4">
                              <textarea rows="7" class="form-control" cols="44" name="description" required=""  placeholder=""></textarea>                          
                            </div>  
                          </div>
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
                          <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary" name="submitUser" type="submit">Save</button>
                                <button class="btn btn-white" type="button" onclick="window.location='home.php'">Cancel</button>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>    
    </div>
    
<?php    
	include("footer.php"); 
?> 