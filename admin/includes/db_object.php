<?php

//return static::find_by_query("SELECT * FROM " . static::$db_table ." "); every static keyword in this class is replaced with static keyword
//In this class we got problem bcz of static keyword since these methods are extended in other class so we should not be using static keyword here if we use it we get errors so in this case use "Late Static binding" means replace every static keyword with static keyword or replace static with $this.
//These are some useful links for late static binding
//1.https://stackoverflow.com/questions/1912902/what-exactly-are-late-static-bindings-in-php
//2.https://secure.php.net/manual/en/language.oop5.late-static-bindings.php

class Db_object{

    public static function find_all(){

        //global $database; calling another class object
//        $result_set = $database ->query("SELECT * FROM users");
//        return $result_set;
        return static::find_by_query("SELECT * FROM " . static::$db_table ." ");
    }//this function finds all users

    public static function find_by_id($id){

        //global $database;
//        $result_set = $database ->query("SELECT * FROM users WHERE id = $id LIMIT 1");
        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
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

    public static function find_by_query($sql){

        global $database;
        $result_set = $database ->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = static::instantation($row);
        }
        return $the_object_array;
    }

    public static function instantation($the_record){

        //this function gets the record from database and loops through the record
        $calling_call = get_called_class();
        //get_called_class() gets the name of the class the static method is called in
        //this method will instantiate called class instead of this class
        $the_object = new $calling_call;//this object talks about its self
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

    protected function properties(){

        $properties = array();
        foreach (static::$db_table_fields as $db_field){

            if (property_exists($this, $db_field)){

                $properties[$db_field] = $this ->$db_field;
                //$this ->$db_field is not a property its a dynamic field
                //$properties[$db_field] has all properties
            }//property_exists — Checks if the object or class has a property
        }
        return $properties;
        //when using get_object_vars it returns all properties, we don't need all of them like $db_table, $id so we use $db_table_fields to store only properties we need.
        //return get_object_vars($this);
    }//whenever we use this method it returns all object properties ie. id,username,first_name etc..

    protected function clean_properties(){

        global $database;
        $clean_properties = array();
        foreach ($this ->properties() as $key => $value){
            $clean_properties[$key] = $database ->escape_string($value);
        }
        return $clean_properties;
    }//this function is used for escaping properties bcz in properties() we not using escape_string()

    public function save(){

        return isset($this ->id) ? $this ->update() : $this ->create();
        //if object id is set then create it else update it
    }//this function creates user and also updates particular user with that id

    public function create(){

        global $database;
        $properties = $this ->clean_properties();
//        $sql  = "INSERT INTO " . self::$db_table . " (username, password, first_name, last_name) ";
        $sql  = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) .") ";
        //The implode() function returns a string from the elements of an array.
        //here pulling out array keys using array_keys()
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";
        //here values are divided by comma and single quotes
        //The array_values() function returns an array containing all the values of an array.
//        $sql .= $database ->escape_string($this ->username) . "', '";
//        $sql .= $database ->escape_string($this ->password) . "', '";
//        $sql .= $database ->escape_string($this ->first_name) . "', '";
//        $sql .= $database ->escape_string($this ->last_name) . "')";
        if ($database ->query($sql)){

            $this ->id = $database ->the_insert_id();
            //the_insert_id gives last id in this query and assign it to this class object id
            return true;
        }
        else{
            die("Query Failed " .mysqli_error($database ->connection));
        }
    }//this function creates a user

    public function update(){

        global $database;
        $properties = $this ->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value){
            $properties_pairs[] = "{$key} = '{$value}'";
            //here we need 'username=' so we did it different than create
        }

        $sql  = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
//        $sql .= "username= '" . $database ->escape_string($this ->username) . "', ";
//        $sql .= "password= '" . $database ->escape_string($this ->password) . "', ";
//        $sql .= "first_name= '" . $database ->escape_string($this ->first_name) . "', ";
//        $sql .= "last_name= '" . $database ->escape_string($this ->last_name) . "' ";
        $sql .= " WHERE id= " . $database ->escape_string($this ->id);//for integer we don't need single quotes
        $database ->query($sql);
        return (mysqli_affected_rows($database ->connection) == 1) ? true : false;
    }//this function updates user data in database

    public function delete(){

        global $database;
        $sql  = "DELETE FROM " . static::$db_table ." ";
        $sql .= "WHERE id = " . $database ->escape_string($this ->id);
        $sql .= " LIMIT 1";
        $database ->query($sql);
        return (mysqli_affected_rows($database ->connection) == 1) ? true : false;
    }//this function deletes user from database

    public static function count_all(){

        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        //counting number of records in database table
        $result_set = $database ->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }//counting number of things like photos, users etc...
}