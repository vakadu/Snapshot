<?php require_once ("includes/init.php");?>

<?php

if ($session ->is_signed_in()){

    redirect("index.php");
}//if the user is signed_in he will be redirected to admin/index.php

if (isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Method to check db user
    $user_found = User::verify_user($username, $password);
    if ($user_found){

        $session ->login($user_found);
        redirect("index.php");
    }
    else{
        $the_message = "Your password or Username are incorrect";
    }
}
else{
    $username    = "";
    $password    = "";
    $the_message = "";
}

?>

<?php include ("includes/header.php") ?>

    <!-- MAIN CONTENT
    ================================================== -->
    <div id="login_page">
        <div class="col-md-4 col-md-offset-1" id="primary">
            <form action="" method="post" id="login-id">
                <h4 class="bg bg-danger"><?php echo $the_message; ?></h4>
                <div class="row">

                    <div class="form-group">
                        <label for="username" class="control-label sr-only">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo htmlentities($username)?>">
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Submit &raquo;" class="btn btn-success pull-right">
                    <a type="submit" href="../index.php" class="btn btn-success pull-left">Home &raquo;</a>
                </div>
            </form>

        </div>
    </div>

<?php include ("includes/footer.php") ?>