<?php
session_start();
    $blog_id = $_GET['id'];
    //echo $student_id;
    
    require_once "../class/blog.php";

    $blog = new Blog();
    $query_result = $blog -> select_blog_info_by_id($blog_id);
    $blog_info = mysqli_fetch_assoc($query_result);

    if(isset($_POST['btn'])){
        
        $blog -> update_blog_info($_POST);
    }

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
            <li class="active"><a href="dashboard.php">Add Blog</span></a></li>
            <li><a href="blog_read.php">Manage Blog</a></li>
            <li><a href="add_image.php">Add Image</a></li>
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
            <h1></h1>
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
                        <label for="inputName3" class="col-sm-2 control-label">Blog Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName3" name="blog_title" value="<?php echo $blog_info['blog_title']; ?>" placeholder="Add title">
                          
                          <input type="hidden" class="form-control" id="inputName3" name="blog_id" value="<?php echo $blog_info['blog_id']; ?>" placeholder="Add title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPhone3" class="col-sm-2 control-label">Author Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputPhone3" name="author_name" value="<?php echo $blog_info['author_name']; ?>" placeholder="Author Name">
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="inputAddress3" class="col-sm-2 control-label">Blog Description</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" rows="4" cols="40" name="blog_description" placeholder="Description"><?php echo $blog_info['blog_description']; ?></textarea>
                        </div>
                      </div>
                         <div class="form-group">
                        <label for="inputName3" class="col-sm-2 control-label">Blog Image</label>
                        <div class="col-sm-10">
                          <input type="file" id="inputName3" name="blog_image" multiple accept="image/*"/>
                          <img src="<?php echo $blog_info['blog_image']; ?>" alt="" style="height:150px" width="200px">
                        </div>
                      </div>
                         <div class="form-group">
                             <label for="inputAddress3" class="col-sm-2 control-label">Publication Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="publication_status">
                                <option>---Select Publication Status---</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success btn-block" name="btn">Save Blog Info</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>