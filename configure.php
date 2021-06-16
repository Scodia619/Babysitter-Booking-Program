<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'will');
define('DB_PASS', 'Dragonfable1!');

$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);

$database = "booking_app";

$db_found = mysqli_select_db($db_handle, $database);

?>