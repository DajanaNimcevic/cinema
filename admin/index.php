<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Admin</title>
</head>
<body>
<form method="get" action="index.php">
    <nav class="navbar navbar-expand navbar-dark bg-danger">
        <a class="navbar-brand" href="../index.php">Cinema</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Početna</a>
            </li>
            <li>
                <button class="btn btn-danger btn-block" type="submit" name="submit" value="list">LIST MOVIES</button>
            </li>
            <li>
                <button class="btn btn-danger btn-block" type="submit" name="submit" value="listScreenings">LIST SCREENINGS</button>
            </li>
            <li>
                <button class="btn btn-danger btn-block" type="submit" name="submit" value="insert">INSERT MOVIE</button>
            </li>
            <li>
                <button class="btn btn-danger btn-block" type="submit" name="submit" value="insertScreening">INSERT SCREENING</button>
            </li>
        </ul>
    </nav>
</form>


<?php
if(isset($_GET['error'])){
    $error = $_GET['error'];
    if($error === 'empty')
        echo "<h4 class=\"text-center text-danger mt-3\">Empty fields</h4>";
    if($error === 'errorImage')
        echo "<h4 class=\"text-center text-danger mt-3\">Bad Image Format</h4>";
    if($error === 'errorUpload')
        echo "<h4 class=\"text-center text-danger mt-3\">Failed to upload Image</h4>";
    if($error === 'errorQuery')
        echo "<h4 class=\"text-center text-danger mt-3\">No changes were made to the database</h4>";
    if($error === 'success')
        echo "<h4 class=\"text-center text-success mt-3\">Action completed successfully</h4>";
}
if(isset($_GET['submit'])){

    $action = $_GET['submit'];

    switch ($action){
        case "list":
            include "listMovie.php";
            break;
        case "insert":
            include "insertMovie.php";
            break;
        case "listScreenings":
            include "listScreening.php";
            break;
        case "insertScreening":
            include "insertScreening.php";
            break;
        default:
            header ("Location: index.php");
            exit();
    }
}
?>

</body>
</html>