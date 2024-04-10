<?php
session_start();
if (!isset($_SESSION["usersName"])) {
    header("Location: login.php");
    exit();
}