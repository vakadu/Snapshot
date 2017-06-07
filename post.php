<?php include "includes/header.php"; ?>

<?php

require_once ("admin/includes/init.php");

if (empty($_GET['id'])){

    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if (isset($_POST['submit'])){

    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo ->id, $author, $body);

    if ($new_comment){

        $new_comment ->save();
        redirect("post.php?id={$photo ->id}");
    }
    else{
        $message = "There was some problem saving";
    }
}
else{
    $author = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo ->id);

?>


<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo $photo ->title; ?></h1>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>
                <img class="img-responsive" src="admin/<?php echo $photo ->picture_path();
                ?>" alt="">
                <hr>
                <p class="caption"><?php echo $photo ->caption; ?></p>
                <p class="caption"><?php echo $photo ->description; ?></p>

                <hr>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <input type="text" name="author" class="form-control"
                                   placeholder="Author Name">
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"
                                      placeholder="Message"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn
                        btn-success">Submit</button>
                    </form>
                </div>

                <hr>

                <?php foreach ($comments as $comment) : ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment ->author?>
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        <?php echo $comment ->body; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <hr>

<?php include "includes/footer.php"; ?>
