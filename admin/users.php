<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

$users = User::find_all();

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
                        Users
                        <a href="add_user.php" class="btn btn-success">Add User</a>
                    </h1>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-11">
                                <table class="table table-responsive table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?php echo $user ->id; ?></td>
                                            <td>
                                                <img src="<?php echo $user
                                                    ->image_path_and_placeholder(); ?>"
                                                     alt="No Image"
                                                     class="img-responsive
                                                     user_image">
                                            </td>
                                            <td>
                                                <?php echo $user ->username; ?>
                                                <div class="action_link">
                                                    <a href="edit_user.php?id=<?php echo $user
                                                        ->id; ?>">Edit</a>
                                                    <a href="delete_user.php?id=<?php echo
                                                    $user ->id; ?>">Delete</a>
                                                </div>
                                            </td>
                                            <td><?php echo $user ->first_name; ?></td>
                                            <td><?php echo $user ->last_name; ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
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