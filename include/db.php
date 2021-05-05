<?php
const db = ['DB_HOST'=>'localhost', 'DB_USERNAME'=>'root', 'DB_PASS'=>'', 'DB_NAME'=>'cms-php-demo'];
// $connection = mysqli_connect(db['DB_HOST'], db['DB_USERNAME'], db['DB_PASS'], db['DB_NAME']);
$connection = new mysqli(db['DB_HOST'], db['DB_USERNAME'], db['DB_PASS'], db['DB_NAME']);

if (!$connection) {
    die('Connection to database faild!<br>' . mysqli_error($connection));
}