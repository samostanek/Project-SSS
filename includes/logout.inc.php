<?php

$uname = $_SESSION["username"];
$uid = $_SESSION["userID"];
session_destroy();
require 'dbconn.inc.php';
require 'sqllog.inc.php';
SQLlog($conn, "login", 'User "'.$uname.'" succesfully Logged Out.', $uid, NULL);
header("Location: ../index.php");
