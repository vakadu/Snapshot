<?php include "includes/header.php"; ?>
<?php include "includes/photo_library_modal.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php



if (empty($_GET['id'])){

    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if (isset($_POST['update'])){

    if ($user){

        //if ($user) means if there is a user then do this
        $user ->username = $_POST['username'];
        $user ->password = $_POST['password'];
        $user ->first_name = $_POST['first_name'];
        $user ->last_name = $_POST['last_name'];

        if (empty($_FILES['user_image'])){

            $user ->save();
        }
        else{
            $user ->set_file($_FILES['user_image']);
            $user ->upload_photo();
            $user ->save();
            redirect("edit_user.php?id={$user ->id}");
        }
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
                    Edit User
                </h1>


                <div class="col-md-6 user_image_box">
                    <a href="" data-toggle="modal" data-target="#photo-library"><img
                                src="<?php echo $user ->image_path_and_placeholder(); ?>"
                                alt="No Image" class="img-responsive edit_user_photo">
                    </a>
                </div>

                <form method="post" action="" enctype="multipart/form-data">
                    <!--don't do action="edit_user.php" bcz it will be redirected to edit_user.php and edit_user.php doesn't have id after redirecting and it will be redirected to users.php according to line 7-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control"
                                   value="<?php echo $user ->username; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"
                             class="form-control" value="<?php echo $user ->password; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="first_name"
                            class="form-control" value="<?php echo $user ->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="last_name"
                            class="form-control" value="<?php echo $user ->last_name; ?>">
                        </div>
                        <div class="form-group">
                            <input type="file" name="user_image"
                                   class="form-control">
                        </div>
                        <a type="submit" id="delete_id" name="delete" class="btn btn-danger
                        pull-left" href="delete_user.php?id=<?php echo $user
                            ->id?>">Delete</a>
                        <input type="submit" name="update" class="btn btn-success
                        pull-right" value="Update">
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>