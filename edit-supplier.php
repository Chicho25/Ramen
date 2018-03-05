<?php 

    ob_start();
    $countryclass="class='active'";
    $editSupclass="class='active'";
    
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
                        "name" => $cname,
                        "phone" => $phone,
                        "website" => $website,
                        "contactname" => $contact,
                        "cellno" => $cellphone,
                        "email" => $email,
                        "address1" => $address1,
                        "address2" => $address2,
                        "id_country" => $country,
                        "province" => $province,
                        "city" => $city,
                        "thirdparty" => $thirdparty,
                        "stat" => $stval
                       );
          
          UpdateRec("supplier", "id=".$_REQUEST['id'], $arrVal);    
          $nId=$_REQUEST['id'];
          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Supplier updated successfully</strong>
                    </div>';
          }
          
          
        
     }

     $arrUser = GetRecord("supplier", "id = ".$_REQUEST['id']);
     $status = ($arrUser['stat'] == 1) ? 'checked' : '';

?>
  <?php 
      $bcName = "Edit Supplier";
      include("breadcrumb.php") ;
    ?>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Supplier</h5>
                    </div>
                    <div class="ibox-content">
                     <form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $arrUser['id']?>" name="id">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Name</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['name']?>" required="" placeholder="Copmany Name" name="cname" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Phone Number</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['phone']?>" required="" placeholder="Phone Number" name="phone" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Website</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  value="<?php echo $arrUser['website']?>" placeholder="Website" name="website" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Contact Name</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['contactname']?>" required="" placeholder="Contact Name" name="contact" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Cell Phone Number</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  value="<?php echo $arrUser['cellno']?>" placeholder="Cell Phone Number" name="cellphone" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Email</label>
                            <div class="col-lg-4">
                              <input type="email" class="form-control" value="<?php echo $arrUser['email']?>" required="" placeholder="Email" name="email" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Address #1</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['address1']?>" required="" placeholder="Address #1" name="address1" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Address #2</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['address2']?>" required="" placeholder="Address #2" name="address2" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                              <label class="col-lg-4 text-right control-label font-bold">Country</label>
                              <div class="col-lg-4">
                                  <select class="chosen-select form-control" name="country" required="required" onChange="mostrar(this.value);">
                                    <?PHP
                                    $arrKindMeetings = GetRecords("Select * from country where stat=1");
                                    foreach ($arrKindMeetings as $key => $value) {
                                      $kinId = $value['id'];
                                      $kinDesc = $value['name'];
                                      $selRoll = (isset($arrUser['id_country']) && $arrUser['id_country'] == $kinId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $kinId?>" <?php echo $selRoll?>><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Province / State</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['province']?>" required="" placeholder="Province / State" name="province" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">City</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['city']?>" required="" placeholder="City" name="city" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Third Party Id</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $arrUser['thirdparty']?>" required="" placeholder="Third Party Id" name="thirdparty" data-required="true">                        
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