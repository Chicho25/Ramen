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
    
     $arrUser = GetRecord("documents", "id = ".$_REQUEST['id']);
     $arrDocList = GetRecords("select * from documents_file where id_document = ".$_REQUEST['id']);
     
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';

?>
  <?php 
      $bcName = "View Document";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>View Document</h5>
                    </div>
                    <div class="ibox-content">
                      
                      <?php 
                        foreach ($arrDocList as $key => $value) {
                        
                      ?>
                          <div class="form-group">
                            <a href="download.php?file=<?php echo $value['path']?>" title="Image from Unsplash" target="_blank"><?php echo $value['path']?></a>
                          </div>
                        <?php
                          }
                        ?>    
                      </div>
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