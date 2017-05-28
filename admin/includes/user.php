<?php

class User{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users(){

        //global $database; calling another class object
//        $result_set = $database ->query("SELECT * FROM users");
//        return $result_set;
        return self::find_this_query("SELECT * FROM users");
    }//this function finds all users

    public static function find_user_by_id($user_id){

        //global $database;
//        $result_set = $database ->query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
//        $found_user = mysqli_fetch_array($result_set);
//        return $found_user;
//        if (!empty($the_result_array)){
//
//            $first_item = array_shift($the_result_array);
//            return $first_item;
//            array_shift grabs the first item ie., id
//        }
//        else{
//            return false;
//        }
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
        //array_shift grabs the first item ie., id
    }//this function finds user by their id

    public static function find_this_query($sql){

        global $database;
        $result_set = $database ->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantation($row);
        }
        return $the_object_array;
    }

    public static function verify_user($username, $password){

        global $database;
        $username = $database ->escape_string($username);
        $password = $database ->escape_string($password);
        $sql  = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' AND ";
        $sql .= "password = '{$password}' LIMIT 1";
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function instantation($the_record){

        //this function gets the record from database and loops through the record
        $the_object = new self();//this object talks about itself
        //these objects will be able to instantiate with this method
//        $the_object ->id = $user_found['id'];
//        $the_object ->username = $user_found['username'];
//        $the_object ->password = $user_found['password'];
//        $the_object ->first_name = $user_found['first_name'];
//        $the_object ->last_name = $user_found['last_name'];

        foreach ($the_record as $the_attribute => $value){

            if ($the_object ->has_the_attribute($the_attribute)){
                //the_attribute is key
                //if the object has attribute then assign that attribute to that object
                $the_object ->$the_attribute = $value;
                //$value is username or password etc...
            }
        }//now we have value and attribute of the record

        return $the_object;
    }//this function automatically calls Class and instantiate records from database

    private function has_the_attribute($the_attribute){

        $object_properties = get_object_vars($this);
        //get_object_vars gets the attributes of the given class
        //get_object_vars returns associative array
        return array_key_exists($the_attribute, $object_properties);
        //if the attribute is there in object properties then array_key_exists returns true
    }
}
