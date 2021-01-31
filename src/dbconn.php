<?php
$serverName = "localhost";
$dbUser = "root";
$dbPwd = "";
$dbName = "arcade_canvas";
$dbConn = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);
if (!$dbConn) {
    die("Connection to Database Failed! : " . mysqli_connect_error());
}