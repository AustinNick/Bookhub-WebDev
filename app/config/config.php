<?php
define('DB_HOST',       'localhost');
define('DB_USER',       'root');
define('DB_PASSWORD',   '');
define('DB_NAME',       'bookhub');

$konek = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Gagal konek ke MySQL: ' . mysqli_connect_error());
