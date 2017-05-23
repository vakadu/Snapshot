<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard
            </h1>

            <?php
            $sql = "SELECT * FROM users WHERE id = 1";
            $result = $database ->query($sql);
            $user_found = mysqli_fetch_array($result);
            echo $user_found['username'];
            ?>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->