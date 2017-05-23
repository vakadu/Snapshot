<?php

//Database connection constants

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'sachin10');
define('DB_NAME', 'snapshot');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
