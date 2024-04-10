<?php

// connect to the database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'login_system';

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    echo 'There was an error while connecting to database. Error: ' . mysqli_connect_error();
    exit();
}