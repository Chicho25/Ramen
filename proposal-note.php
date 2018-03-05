<?php 

    ob_start();
    $craneclass="class='active'";
    $ProposalNoteclass="class='active'";
    
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
                        "coverletter" => $coverletter,
                        "proposalnote" => $proposalnote
                       );

          if(RecCount("proposal_note", "1=1") == 0)
          {
            $nId = InsertRec("proposal_note", $arrVal);    
            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Proposal Note created successfully</strong>
                    </div>';
          }
          else
          {
            UpdateRec("proposal_note", "1=1", $arrVal);
            $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Proposal Note updated successfully</strong>
                    </div>';
          }
          
        
          
        
     }
?>
  <?php 
      $bcName = "Proposal Note";
      include("breadcrumb.php") ;
      $arrData = GetRecord("proposal_note", "1=1");
      $coverletter = (isset($arrData['coverletter'])) ? $arrData['coverletter'] : '';
      $proposalnote = (isset($arrData['proposalnote'])) ? $arrData['proposalnote'] : '';
     
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Proposal Note</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-sm-12 text-center">Set the text to be displayed on Your Quotes.</label>
                            <label class="col-sm-12 text-left">Defaul Cover Letter body</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="coverletter" required="required"  ><?php echo $coverletter?></textarea>     
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-12 text-left">Proposal Note</label>
                            <div class="col-sm-12">
                              <textarea rows="3" class="form-control" cols="44" name="proposalnote" required="required"  ><?php echo $proposalnote?></textarea>     
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