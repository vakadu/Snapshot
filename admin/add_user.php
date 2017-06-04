<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

$user = new User();

if (isset($_POST['create'])){

    if ($user){

        //if ($user) means if there is a user then do this
        $user ->username = $_POST['username'];
        $user ->password = $_POST['password'];
        $user ->first_name = $_POST['first_name'];
        $user ->last_name = $_POST['last_name'];
        $user ->set_file($_FILES['user_image']);

        $user ->upload_photo();
        $user ->save();
    }
}

?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <?php include "includes/top-navigation.php"; ?>
        <?php include "includes/side-navigation.php"; ?>

    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add User
                    </h1>

                    <div class="container">
                        <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">
                                <!--don't do action="edit_user.php" bcz it will be redirected to edit_user.php and edit_user.php doesn't have id after redirecting and it will be redirected to users.php according to line 7-->
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control"
                                        placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password"
                                        class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="first_name"
                                        class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="last_name"
                                        class="form-control" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="user_image"
                                               class="form-control">
                                    </div>
                                    <input type="submit" name="create" class="btn btn-success
                                    pull-right">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>