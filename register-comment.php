<?php 

    ob_start();
    $fleetclass="class='active'";
    $registerCommentclass="class='active'";
    
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
        
          $arrVal = array(
                        "id_vehicle" => $vehicle,
                        "title" => $title,
                        "comment" => $comment,
                        "createdOn" => date("Y-m-d h:i:s"),
                        "stat" => 1
                       );

          $nId = InsertRec("comment", $arrVal);    

          if($nId > 0)
          {
              
              
              echo '<script>
                              alert("Comment created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Comment not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Comment";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Comment</h5>
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
                            <label class="col-lg-4 text-right control-label font-bold">Title</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Title" name="title" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group">
                            <label class="col-lg-4 text-right control-label font-bold">Comment</label>
                            <div class="col-lg-4">
                              <textarea rows="7" class="form-control" cols="44" name="comment" required=""  placeholder=""></textarea>                          
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