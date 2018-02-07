<?php

session_start();
    $message= '';
    require_once "../class/blog.php";

    $blog = new Blog();


    if(isset($_GET['delete'])){
        
        $id = $_GET['delete'];
        $message = $blog -> delete_blog_info($id);
    }

    
    if(isset($_SESSION['message'])){
        
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    $query_result = $blog -> select_all_blog_info();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Blog Info</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        
        .well{
            width: 100%;
            height: auto;
            margin: 0 auto;
        }
        .delete{
            background: #e33434;
            transition: all .3s ease-in-out;
        }
        .delete:hover{
            background: #801b1b;
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
          <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="dashboard.php">Add Blog</span></a></li>
            <li class="active"><a href="blog_read.php">Manage Blog</a></li>
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
            <div class="well">      
                <table class="table table-borderd table-hover">
                    <thead>
                      <tr>
                        <th>Blog Id</th>
                        <th>Blog Title</th>
                        <th>Author Name</th>
                        <th>Blog Description</th>
                        <th>Publication Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php $i = 1; while($blog_info = mysqli_fetch_assoc($query_result)) {?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $blog_info['blog_title']; ?></td>
                            <td><?php echo $blog_info['author_name']; ?></td>
                            <td><?php echo $blog_info['blog_description']; ?></td>
                            <td>
                                <?php
                                    if($blog_info['publication_status'] == 1){
                                        echo 'Published';
                                    }
                                    else{
                                        echo 'Unpublished';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="blog_update.php?id=<?php echo $blog_info['blog_id']; ?>" class="btn btn-info btn-lg">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="?delete=<?php echo $blog_info['blog_id']; ?>" class="btn btn-info btn-lg delete" title="Delete" onclick="return confirm('Are you sure to delete this?'); ">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                       
                       <?php } ?>
                    </tbody>
                </table>
                
                </div>
                
            </div>
        </div>
    </div>
</div>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>