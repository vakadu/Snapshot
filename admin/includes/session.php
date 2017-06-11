<?php

class Session{

    private $signed_in = false;
    public $user_id;
    public $username;
    public $count;
    public $message;

    function __construct(){

        session_start();
        $this ->visitor_count();
        $this->check_the_login();
        $this ->check_message();
    }//this function starts session automatically when the class is instantiated

    public function message($msg = ""){

        if (!empty($msg)){

            $_SESSION['message'] = $msg;
        }
        else{
            return $this->message;
        }
    }

    private function check_message(){

        if (isset($_SESSION['message'])){

            $this ->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else{
            $this ->message = "";
        }
    }//this func is checking for messages

    public function visitor_count(){

        if (isset($_SESSION['count'])){

            return $this ->count = $_SESSION['count']++;
        }
        else{
            return $_SESSION['count'] = 1;
        }
    }//this function counts number of visitors in admin_content.php

    public function is_signed_in(){

        return $this->signed_in;
    }//getter method

    public function login($user){

        if ($user){

            $this->user_id = $_SESSION['user_id'] = $user ->id;
            $this->username = $_SESSION['username'] = $user ->username;
            //if there is a user then set user_id to $_SESSION['user_id'] and User class id
            $this ->signed_in = true;
        }
    }//this function checks that the user is logged in

    public function logout(){

        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($this->user_id);
        unset($this->username);
        $this->signed_in = false;
    }

    private function check_the_login(){

        if (isset($_SESSION['user_id'])){

            $this ->user_id = $_SESSION['user_id'];
            //if the session user_id is set then set that to this ->user_id() and signed_in as true
            $this ->signed_in = true;
        }
        else{
            unset($this ->user_id);
            //if we don't find session user_id then unset it and keep signed_in as false
            $this ->signed_in = false;
        }
    }//this function checks if the session user_id is set
}

$session = new Session();
$message = $session ->message();