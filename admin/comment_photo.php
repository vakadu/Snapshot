<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

if (empty($_GET['id'])){

    redirect("photos.php");
}

$comments = Comment::find_the_comments($_GET['id']);

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
                        Comments
                    </h1>
                    <p class="bg-success"><?php echo $message; ?></p>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-11">
                                <table class="table table-responsive table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($comments as $comment) : ?>
                                        <tr>
                                            <td><?php echo $comment ->id; ?></td>
                                            <td>
                                                <?php echo $comment ->author; ?>
                                                <div class="action_link">
                                                    <a href="delete_comment_photo.php?id=<?php
                                                    echo $comment ->id; ?>">Delete</a>
                                                </div>
                                            </td>
                                            <td><?php echo $comment ->body; ?></td>
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