<?php

    session_start();

    if(isset($_SESSION['admin_id'])){
        if($_SESSION['admin_id'] != NULL){
            header('Location: dashboard.php');
        }
    }

    if(isset($_POST['btn'])){
        
        require_once '../class/login.php';
        
        $login = new Login();
            
            $message = $login -> admin_login_check($_POST);
        
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign in</title>
    
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <link href="signin.css" rel="stylesheet">

    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
  </head>

  <body>

    <div class="container">
      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
         <div class="alert alert-danger">
            <strong><?php
                
                    if(isset($message)){
                        echo $message;
                        unset($message);
                    }
                ?></strong>
          </div>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email_address" placeholder="Email address">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password">
        
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn">Sign in</button>
      </form>

    </div> 

    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>