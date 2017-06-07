<?php include "includes/header.php"; ?>

<?php

$photos = Photo::find_all();

?>

<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnail row">

                <?php foreach ($photos as $photo): ?>

                        <div class="col-xs-6 col-md-3">
                            <a class="thumbnail" href="post.php?id=<?php echo $photo ->id;?>">
                                <img src="admin/<?php echo $photo ->picture_path() ?>"
                                     class="img-responsive home_page_photo" alt="No image">
                            </a>
                        </div>

                <?php endforeach; ?>

                </div>
            </div>

        </div>
        <!-- /.row -->

<?php include "includes/footer.php"; ?>