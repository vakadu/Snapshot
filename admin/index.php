<?php include "includes/header.php"; ?>

<?php if (!$session ->is_signed_in()){redirect("login.php") ; } ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <?php include "includes/top-navigation.php"; ?>
    <?php include "includes/side-navigation.php"; ?>

</nav>

<div id="page-wrapper">

    <?php include "includes/admin_content.php"; ?>

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>