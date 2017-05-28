<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard
            </h1>

            <?php

            $users = User::find_all_users();
            foreach ($users as $user){
                echo $user ->id . "<br>";
            }

//            $found_user = User::find_user_by_id(2);
//            echo $found_user ->username;

//            $result = User::find_all_users();
//            while ($row = mysqli_fetch_array($result)){
//                echo $row['username'] . "<br>";
//            }

//            $result = User::find_user_by_id(2);
//            $user = User::instantation($result);
//            $user ->username = $result['last_name'];
//            echo $user ->username;
            ?>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->