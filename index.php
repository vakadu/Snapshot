<?php include "includes/header.php"; ?>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();

//$photos = Photo::find_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql  = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate ->offset()}";
$photos = Photo::find_by_query($sql);

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
                <div class="row">
                    <ul class="pager">

                        <?php

                        if ($paginate ->page_total() > 1){

                            if ($paginate ->has_next()){

                                //if page doesn't have next page then don't show this
                                echo "<li class='next'><a href='index.php?page={$paginate 
                                ->next()}'>Next</a> </li>";
                            }

                            for ($i = 1; $i <= $paginate ->page_total(); $i++){

                                if ($i == $paginate ->current_page){

                                    echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a> </li>";
                                }
                                else{

                                    echo "<li><a href='index.php?page={$i}'>{$i}</a> </li>";
                                }
                            }

                            if ($paginate ->has_previous()){

                                //if page doesn't have Previous page then don't show this
                                echo "<li class='previous'><a href='index.php?page={$paginate 
                                ->previous()}'>Previous</a> </li>";
                            }
                        }

                        ?>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.row -->

<?php include "includes/footer.php"; ?>