<?php 

    ob_start();
    $countryclass="class='active'";
    $registerSupclass="class='active'";
    
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
                        "stat" => 1
                       );

          $nId = InsertRec("supplier", $arrVal);    

          if($nId > 0)
          {
              
              $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Supplier created successfully</strong>
                    </div>';

              echo '<script>
                              alert("Supplier created successfully");
                              window.location="'.$_SERVER['PHP_SELF'].'";
                          </script>';
          }
          else
          {
            

            $message = '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Supplier not created</strong>
                  </div>';
          }
        
          
        
     }
?>
  <?php 
      $bcName = "Register Supplier";
      include("breadcrumb.php") ;
    ?>
	<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Register Supplier</h5>
                    </div>
                    <div class="ibox-content">
                	<form class="form-horizontal" data-validate="parsley" method="post"   enctype="multipart/form-data">
                          <?php 
                                if($message !="")
                                    echo $message;
                          ?> 
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Name</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Customer Name" name="cname" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Phone Number</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Phone Number" name="phone" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Website</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  placeholder="Website" name="website" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Contact Name</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" required="" placeholder="Contact Name" name="contact" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Cell Phone Number</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  placeholder="Cell Phone Number" name="cellphone" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Email</label>
                            <div class="col-lg-4">
                              <input type="email" class="form-control" required="" placeholder="Email" name="email" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Address #1</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  placeholder="Address #1" name="address1" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Address #2</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" placeholder="Address #2" name="address2" data-required="true">                        
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
                                    ?>
                                    <option value="<?php echo $kinId?>"><?php echo $kinDesc?></option>
                                    <?php
                                }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Province / State</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" placeholder="Province / State" name="province" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">City</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control"  placeholder="City" name="city" data-required="true">                        
                            </div>  
                          </div>
                          <div class="form-group required">
                            <label class="col-lg-4 text-right control-label font-bold">Third Party Id</label>
                            <div class="col-lg-4">
                              <input type="text" class="form-control" placeholder="Third Party Id" name="thirdparty" data-required="true">                        
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