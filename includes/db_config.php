<?php
session_start();

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "cinema");

global $conn;
$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

if (!$conn)
    die("Connection failed!");

mysqli_query($conn,"SET NAMES utf8") or die (mysqli_error($conn));
mysqli_query($conn,"SET CHARACTER SET utf8") or die (mysqli_error($conn));
mysqli_query($conn,"SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($conn));