<?php
include 'includes/db_config.php';
?>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color: white">
<div class="container">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-6 offset-md-3">
            <div class="card">

                <div class="card-header text-white" style="background-color: #680101">
                <h2 class="text-center">Register</h2>
                 </div>
                <div class="card-body">
                        <form method="post" action="includes/register.inc.php" id="registration-form">
                         <label for="username">Username</label>
                         <input type="text" class="form-control" id="username" name="username">
                         <label for="email">Email address</label>
                         <input type="email" class="form-control" id="email" name="email">
                         <label for="password1">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1">
                         <label for="password2">Confirm your password</label>
                         <input type="password" class="form-control" id="password2" name="password2">
                         <button  type = "submit" name="submit" style="background-color: #680101" class = "btn btn-block mt-3 text-white"><i class="fa fa-sign-in"></i> Register</button>
                     </form>
                    <div class="wrapper">
                </div>
                <?php
                $nav = 0;
                if(isset($_GET['nav']))
                $nav = $_GET['nav'];
                 switch ($nav){
                    case 0:
                    default: echo "";
                     break;
                     case 1: echo "<span> Username already exists !</span>";
                    break;
                    case 2: echo "<span> The passwords don't match !</span>";
                    break;
                    case 3: echo "<span> Check username and password !</span>";
                    break;
                 }
                 ?>
                 </div>
             </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.4.1.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
