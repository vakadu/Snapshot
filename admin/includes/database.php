<?php

require_once ("new_config.php");

class Database{

    public $connection;

    function __construct(){

        $this ->open_db_connection();
        //open database connection automatically using construct
    }

    public function open_db_connection(){

        //$this ->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        //creating connection in normal way
        $this ->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this ->connection ->connect_errno){

            die("Database connection failed " . mysqli_error($this ->connection));
            //killing connection if there is error
        }
    }

    public function query($sql){

        $result = mysqli_query($this ->connection ,$sql);
        return $result;
        //compulsory return result
    }

    private function confirm_query($result){

        if (!$result){
            die("QUERy Failed");
        }
        //private because it will not be used outside this class
    }

    public function escape_string($string){

        $escaped_string = mysqli_real_escape_string($this ->connection, $string);
        return $escaped_string;
    }

    public function the_insert_id(){

        return mysqli_insert_id($this ->connection);
        //this function returns last inserted id
    }
}

$database = new Database();
