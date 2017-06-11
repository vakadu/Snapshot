<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $tmp_path;
    public $upload_directory = 'images';
    public $image_placeholder = 'http://placehold.it/400x400&text=image';

    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK  => "There is no error in uploading to temporary file path.",
        UPLOAD_ERR_INI_SIZE  => "The uploaded_file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL  => "The uploaded file was only partially loaded.",
        UPLOAD_ERR_NO_FILE  => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR  => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE  => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload."
    );

    public function image_path_and_placeholder(){

        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }//this function is used for user profile image

    public function set_file($file){

        //$file is same as $_FILES[]
        if (empty($file) || !$file || !is_array($file)){

            //here we checking if the file was empty or if its not a file or if its not an array          then we are taking some custom errors and saving it into an empty errors array
            $this ->errors[] = "There was no file uploaded here";
            return false;
        }
        elseif ($file['error'] != 0){

            //if the error != 0 then we are taking those errors and saving those in errors array           to display those errors. Here 0 means UPLOAD_ERR_OK from $upload_errors_array
            $this ->errors[] = $this ->upload_errors_array[$file['error']];
            return false;
        }
        else{

            //means we have no errors and upload is success
            $this ->user_image = basename($file['name']);
            //The basename(path,suffix) function returns the user_image from a path
            //suffix is extension of user_image and its optional
            $this ->tmp_path = $file['tmp_name'];
            $this ->type = $file['type'];
            $this ->size = $file['size'];
        }
    }//This is passing $_FILES['uploaded_file'] as an argument

    public function upload_photo(){

        if (!empty($this->errors)) {

            return false;
            //this means we have errors
        }
        if (empty($this->user_image) || empty($this->tmp_path)) {

            $this->errors[] = "The file was not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
        //path for images and their user_image

        if (file_exists($target_path)) {

            //if same file exists we are going to display this error in errors[]
            $this->errors = "The file {$this ->user_image} already exists";
            return false;
        }

        if (move_uploaded_file($this->tmp_path, $target_path)) {

            //The move_uploaded_file(file,location) function moves an uploaded file to a new location.

            unset($this->tmp_path);
            return true;
        }
        else {
            //if nothing works and file could not be uploaded
            $this->errors[] = "The file directory wasn't given enough permissions";
            return false;
        }
    }

    public static function verify_user($username, $password){

        global $database;
        $username = $database ->escape_string($username);
        $password = $database ->escape_string($password);
        $sql  = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' AND ";
        $sql .= "password = '{$password}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }//this function is used to verify user before logging in

    public function ajax_save_user_image($user_image, $user_id){

//        $this ->user_image = $user_image;
//        $this ->id = $user_id;
//        $this ->save();
        global $database;
        $user_image = $database ->escape_string($user_image);
        $user_id = $database ->escape_string($user_id);
        $this ->user_image = $user_image;
        $this ->id = $user_id;

        $sql  = "UPDATE " . self::$db_table . " SET user_image = '{$this ->user_image}' ";
        $sql .= " WHERE id = {$this ->id} ";
        $update_image = $database ->query($sql);

        echo $this->image_path_and_placeholder();
    }

    public function delete_photo()
    {

        if ($this->delete()) {

            //we are providing path to delete func to delete the image
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS .
                $this ->user_image;
            //now we have the path of image in $target_path
            return unlink($target_path) ? true : false;
            //The unlink(filename) function deletes a file.
        } else {
            //if we are not able to delete then
            return false;
        }
    }//delete data from database and from server(images folder)
}
