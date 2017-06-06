<?php include "includes/init.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

if (empty($_GET['id'])){

    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment){

    $comment ->delete();
    redirect("comments.php");
}//if our comment is available then delete it
else{
    redirect("comments.php");
}