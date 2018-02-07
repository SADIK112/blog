<?php

    class Blog{
        
        protected $connection;
        
            public function __construct(){
                   
            $host_name = 'localhost';
            $user_name = 'root';
            $password = '';
            $db_name = 'db_blog';
           
            $this->connection = mysqli_connect($host_name , $user_name , $password , $db_name);
            
            if(!$this->connection){
                die('Connection failed'.mysqli_error($this->connection));
            }
            
        }
        
        public function save_blog_info($data){
            
            $image_url = $this -> save_image_info();
     
            $sql = "INSERT INTO tbl_blog (blog_title, author_name, blog_description, blog_image, publication_status)"."VALUES ('$data[blog_title]' , '$data[author_name]' , '$data[blog_description]' , '$image_url' , '$data[publication_status]')";
            
            
            if(mysqli_query ($this->connection , $sql)) {
               $message = "Save Blog Info Succesfully";
                return $message;
            }
            else{
                die ('Query Problem'.mysqli_error($this->connection));
            }
        }
        
        public function select_all_blog_info(){
            
            $sql = "SELECT * FROM tbl_blog ORDER BY blog_id DESC";
            
            if(mysqli_query($this->connection , $sql)){
                $query_result = mysqli_query($this->connection , $sql);
                return $query_result;
            }
            else{
                die('Query Problem'.mysqli_error($this->connection));
            }
        }
        
        public function select_blog_info_by_id($blog_id){
            
               $sql = "SELECT * FROM tbl_blog WHERE blog_id = '$blog_id'";
            
            if(mysqli_query($this->connection , $sql)){
                $query_result = mysqli_query($this->connection , $sql);
                return $query_result;
            }
            else{
                die('Query Problem'.mysqli_error($this->connection));
            }
        }
        
        public function update_blog_info($data){
            
            if($_FILES['blog_image']['name']){
            $image_url = $this -> save_image_info();
                
            $sql = "UPDATE tbl_blog SET blog_title = '$data[blog_title]' , author_name = '$data[author_name]' , blog_description = '$data[blog_description]' , blog_image = '$image_url' , publication_status = '$data[publication_status]' WHERE blog_id = '$data[blog_id]'";

              if(mysqli_query($this->connection , $sql)){

              session_start();
                  $_SESSION['message'] = 'Blog info updated succesfully';
                  header('Location: blog_read.php');
            }
            else{
                  die('Query Problem'.mysqli_error($this->connection));
                }
              }
        }
        
        public function delete_blog_info($id){
            
            $sql = "DELETE FROM tbl_blog WHERE blog_id = '$id'";
            
             if(mysqli_query($this->connection , $sql)){
                $message = 'Blog info delete succesfully';
                return $message;
            }
            else{
                die('Query Problem'.mysqli_error($this->connection));
            
            }
        }
        
        public function save_image_info(){
            
            $image_name = $_FILES['blog_image']['name'];
            $directory = '../assets/blog_image/';
            
            $image_url = '../assets/blog_image/'.$_FILES['blog_image']['name'];
            
            $image_type = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_size = $_FILES['blog_image']['size'];
            $check = getimagesize($_FILES['blog_image']['tmp_name']);
            
            if($check){
                
                if(file_exists($image_url)){
                    die('The file already exists.Please try another one');
                }
                else{
                    if($image_size > 50000000){
                        die('File is too large !');
                    }
                    else{
                        if($image_type != 'jpg' && $image_type != 'png'){
                            die('File type is not valid.Please use JPG or PNG');
                        }
                        else{
                            move_uploaded_file($_FILES['blog_image']['tmp_name'], $image_url);
                            return $image_url;
                        }
                    }
                }
            }
            else{
                die('the file you Uploaded is not an image file');
            }
            
        }
        
        public function select_all_imageInfo(){
            
            $sql = "SELECT * FROM tbl_image";
            
             if(mysqli_query($this->connection , $sql)){
                $query_result = mysqli_query($this->connection , $sql);
                return $query_result;
            }
            else{
                die('Query Problem'.mysqli_error($this->connection));
            }
        }
    }
?>
    

