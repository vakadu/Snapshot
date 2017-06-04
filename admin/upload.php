<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<?php

$msg = "";
if (isset($_POST['submit'])){

    $photo = new Photo();
    $photo ->title = $_POST['title'];
    $photo ->set_file($_FILES['file_upload']);
    if ($photo ->save()){
        $msg = "Upload success";
    }
    else{
        $msg = join("<br>" . $photo ->errors);
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
                    Upload
                </h1>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo $msg; ?>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file_upload" class="form-control">
                                </div>
                                <input type="submit" name="submit" class="btn btn-success pull-right">
                            </form>
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