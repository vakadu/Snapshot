<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

if (empty($_GET['id'])){

    redirect("photos.php");
}
else{
    $photo = Photo::find_by_id($_GET['id']);

    if (isset($_POST['update'])){

        if ($photo){

            $photo ->title = $_POST['title'];
            $photo ->caption = $_POST['caption'];
            $photo ->alternate_text = $_POST['alternate_text'];
            $photo ->description = $_POST['description'];

            $photo ->save();
        }
    }
}

//$photos = Photo::find_all();

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
                            <form method="post" action="">
<!--don't do action="edit_photo.php" bcz it will be redirected to edit_photo.php and edit_photo.php doesn't have id after redirecting and it will be redirected to photos.php according to line 7-->
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control"
                                               value="<?php echo $photo ->title?>">
                                    </div>
                                    <div class="form-group">
                                        <a href=""><img src="<?php echo $photo ->picture_path
                                            (); ?>" alt="No image"
                                            class="img-responsive admin-photo-thumbnail">
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="caption" class="form-control"
                                               value="<?php echo $photo ->caption?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="alternate_text"
                                         class="form-control" value="<?php echo $photo
                                            ->alternate_text?>">
                                    </div>
                                    <div class="form-group">
                                    <textarea name="description" class="form-control"
                                              cols="30" rows="5"><?php echo $photo
                                            ->description; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="photo-info-box">
                                        <div class="info-box-header">
                                            <h4>Save <span id="toggle" class="fa fa-arrow-up
                                        pull-right"></span> </h4>
                                        </div>
                                        <div class="inside">
                                            <div class="box-inner">
                                                <p class="text">
                                                    <span class="fa fa-calendar "></span>
                                                    Uploaded On: <?php echo date("Y-m-d"); ?>
                                                </p>
                                                <p class="text">
                                                    Photo Id: <span class="data
                                                photo_id_box">34</span>
                                                </p>
                                                <p class="text">
                                                    Filename: <span class="data">image
                                                        .jpg</span>
                                                </p>
                                                <p class="text">
                                                    File Type: <span class="data">JPG</span>
                                                </p>
                                                <p class="text">
                                                    File Size: <span
                                                        class="data">3245345</span>
                                                </p>
                                            </div>
                                            <div class="info-box-footer clearfix">
                                                <div class="info-box-delete pull-left">
                                                    <a href="delete_photo.php?id=<?php echo
                                                    $photo ->id; ?>" class="btn btn-danger
                                                    btn-lg delete_confirm">Delete</a>
                                                </div>
                                                <div class="info-box-update pull-right ">
                                                    <input type="submit" name="update"
                                                           value="Update" class="btn
                                                           btn-success btn-lg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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