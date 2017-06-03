<?php

class Photo extends Db_object {

    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size');
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";
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
            $this ->filename = basename($file['name']);
            //The basename(path,suffix) function returns the filename from a path
            //suffix is extension of filename and its optional
            $this ->tmp_path = $file['tmp_name'];
            $this ->type = $file['type'];
            $this ->size = $file['size'];
        }
    }//This is passing $_FILES['uploaded_file'] as an argument

    public function picture_path(){

        return $this ->upload_directory . DS . $this ->filename;
        //this func returns directory/name of file
        //even though we change directory name it doesn't give any errors
    }//making images path dynamic

    public function save(){

        //if $photo_id is present then update it else create photo
        if ($this ->photo_id){

            $this ->update();
        }
        else{

            if (!empty($this->errors)){

                return false;
                //this means we have errors
            }
            if (empty($this ->filename) || empty($this ->tmp_path)){

                $this ->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this ->upload_directory . DS . $this ->filename;
            //path for images and their filename

            if (file_exists($target_path)){

                //if same file exists we are going to display this error in errors[]
                $this ->errors = "The file {$this ->filename} already exists";
                return false;
            }

            if (move_uploaded_file($this ->tmp_path, $target_path)){

                //The move_uploaded_file(file,location) function moves an uploaded file to a new location.
                if ($this ->create()){

                    //if this file was able to create then remove temporary path and return true
                    unset($this ->tmp_path);
                    return true;
                }
                else{
                    //if nothing works and file could not be uploaded
                    $this ->errors[] = "The file directory wasn't given enough permissions";
                    return false;
                }
            }
        }
    }
}
