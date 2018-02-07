<?php

    class Application{
        
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
        public function all_Published_BlogInfo(){
            
            $sql = "SELECT * FROM tbl_blog WHERE publication_status = 1 ORDER BY blog_id DESC";
            
            if(mysqli_query($this->connection, $sql)){
                $query_result = mysqli_query($this->connection, $sql);
                return $query_result;
            }
            else{
                die ('Query Problem'.mysqli_error($this->connection));
            }
        }
        
        public function select_BlogInfo_byId($blog_id){
            
            $sql = "SELECT * FROM tbl_blog WHERE blog_id = '$blog_id'";
            
            if(mysqli_query($this->connection, $sql)){
                $query_result = mysqli_query($this->connection, $sql);
                return $query_result;
            }
            else{
                die ('Query Problem'.mysqli_error($this->connection));
            }
        }
    }
?>