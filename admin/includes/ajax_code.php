<?php require_once "init.php";

$user = new User();
//here we need to catch variables from scripts.js from ajax function variables are image_name, delete_id
if (isset($_POST['image_name'])){

    $user ->ajax_save_user_image($_POST['image_name'], $_POST['delete_id']);
}