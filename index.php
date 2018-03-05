<?php
    ob_start();
    session_start();
    include("include/config.php"); 
    include("include/defs.php"); 
    
    // it will never let you open index(login) page if session is set
     if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] !="") 
     {
          header("Location: home.php");
          exit;
     }
     

    $errMSG="";
     

     if( isset($_POST['btn-login']) ) { 
        
        $username = $_POST['username'];
        $password = encryptIt($_POST['password']);
        $username = strip_tags(trim($username));
        $password = strip_tags(trim($password));

        
        if(RecCount("users", "user = '".$username."' and password = '".$password."' and stat = 1") > 0)
        {
            
            $row = GetRecord("users", "user = '".$username."' and password = '".$password."' and stat = 1");
            $getRole = GetRecord("type_user", "id = ".$row['id_roll_user']." ");

            $_SESSION['USER_ID'] = $row['id'];
            $_SESSION['USER_NAME'] = $row['user'];
            $_SESSION['USER_ROLE'] = $getRole['name'];
            
            header("Location: home.php");

        }
        else
          $errMSG = '<div class="alert alert-danger"><a href="#" class="close" style="color:#000;" data-dismiss="alert">&times;</a><strong>Invalid Email or Password, Try again...!</strong></div>'; 
     }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ramen | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            
            <p>Ramen.</p>
            <form class="m-t" role="form" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="btn-login" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
