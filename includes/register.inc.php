<?php
session_start();
include "db_config.php";

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];

    $logged = 0;
    $sql2 = "SELECT * FROM user WHERE username = '$username';";
    $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn)); // CHECK USERNAME
    $error = 0;
    if (mysqli_num_rows($result2) > 0) {
        $error = 1;
    }
    $password3 = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, password, email) values ('$username', '$password3', '$email')";
    if ($password == $password2 and $error == 0) {
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("location: ../login.php");
    } elseif ($error == 1 and $password != $password2) {
        header("Location: ../register.php?nav=3");
    } elseif ($error == 1) {
        header("Location: ../register.php?nav=1");
    } elseif ($password != $password2) {
        header("Location: ../register.php?nav=2");
    }




