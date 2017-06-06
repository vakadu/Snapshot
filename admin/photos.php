<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

$photos = Photo::find_all();

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
                    Photos
                </h1>

                <div class="container">
                    <div class="row">
                        <div class="col-md-11">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Id</th>
                                    <th>File Name</th>
                                    <th>Title</th>
                                    <th>Size</th>
                                    <th>Comments</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($photos as $photo) : ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $photo ->picture_path(); ?>"
                                             alt="No Image"
                                             class="img-responsive admin-photo-thumbnail">
                                        <div class="actions_link">
                                            <a href="../post.php?id=<?php echo $photo ->id;
                                            ?>">View</a>
                                            <a href="edit_photo.php?id=<?php echo $photo ->id;
                                            ?>">Edit</a>
                                            <a href="delete_photo.php?id=<?php echo $photo ->id
                                            ?>">Delete</a>
                                        </div>
                                    </td>
                                    <td><?php echo $photo ->id; ?></td>
                                    <td><?php echo $photo ->filename; ?></td>
                                    <td><?php echo $photo ->title; ?></td>
                                    <td><?php echo $photo ->size; ?></td>
                                    <td>
                                        <?php
                                        $comments = Comment::find_the_comments($photo ->id);
                                        $comment_count = count($comments);
                                        ?>
                                        <a href="comment_photo.php?id=<?php echo $photo ->id;
                                        ?>"><?php echo $comment_count; ?></a>
                                    </td>
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