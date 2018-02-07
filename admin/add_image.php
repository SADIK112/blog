<?php

    session_start();
    
    //Check whether he is a valid user
    
        if($_SESSION['admin_id'] == NULL){
        header('Location: index.php');
    }
    
     require_once '../class/blog.php';
        
        $blog = new Blog();

    //Checking for Logout
    
    if(isset($_GET['logout'])){
        
        require_once '../class/login.php';
        
        $login = new Login();
        $login -> admin_logout();
    }

    // For blog save
    $message = '';
        if(isset($_POST['btn'])){
            
            $message = $blog -> save_image_info($_POST);
        }

    $query_result = $blog -> select_all_imageInfo();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUY SHOP</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        
        .well{
            width: 80%;
            height: auto;
            margin: 0 auto;
        }
        h1{
            text-align: center;
            color: #1d7989;
        }
        
    </style>
  
  </head>
  <body>
    
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Dashboard</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="dashboard.php">Add Blog</span></a></li>
            <li><a href="blog_read.php">Manage Blog</a></li>
            <li class="active" ><a href="add_image.php">Add Image</a></li>
          </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href=""><?php echo $_SESSION['admin_name']; ?></a></li>
            <li><a href="?logout=logout">Logout</a></li>
        </ul>
        </div>
      </div>
</nav>
  
<div class="container">
    <div class="row">
        <div class="col-md-12 col-ms-12">
            <h1><?php echo $message; ?></h1>
        </div>
    </div>
</div>
   
<hr>
   
<div class="container">
    <div class="row">
        <div class="col-md-12 col-ms-12">
            <div class="well">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName3" class="col-sm-2 control-label">Add Image</label>
                        <div class="col-sm-10">
                          <input type="file" id="inputName3" name="blog_image" multiple accept="image/*"/>
                        </div>
                      </div>
            
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success btn-block" name="btn">Save Image Info</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
       <?php while($image_info = mysqli_fetch_assoc($query_result)){ ?>
        <div class="col-md-12 col-ms-12">
            <div class="well">
                <img src="<?php echo $image_info['image']; ?>" alt="" class="img-responsive">
            </div>
        </div>
        <?php } ?>
    </div>
</div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>