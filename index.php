<?php
require("includes/db_config.php");              //#8d0101 boja      //
?>
<html lang="en">
    <head>
        <title>Bioskop</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body style="background-color:#dedede">
        <div class="container">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                <a class="nav-link text-white" style="background-color: #680101" href="index.php">Repertoar</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white " style="background-color: #961a22" href="reserve.php">Rezervacije</a>
                </li>
                <?php if (!isset($_SESSION['username'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link text-white" style="background-color: #961a22" href="login.php" >Login</a>
                                </li>';
                        echo '<li class="nav-item "><a class="nav-link text-white" style="background-color: #961a22" href="register.php" >Register</a>
                                </li>';
                    }
                    elseif ($_SESSION['admin'] == 1) {
                        echo '<li class="nav-item">
                                <a class="nav-link text-white" style="background-color: #961a22" href="admin/index.php">Admin</a>
                                </li>';
                        echo '<li class="nav-item">
                                <a class="nav-link text-white" style="background-color: #961a22" href="logout.php" >Logout</a>
                                </li>';
                    }
                    else
                        echo '<li class="nav-item">
                                <a class="nav-link text-white" style="background-color: #961a22" href="logout.php" >Logout</a>
                                </li>'
                ?>
            </ul>

        <?php
        $sql = "SELECT * FROM screening s JOIN movie m ON s.id_movie = m.id_movie";
             $query = mysqli_query ($conn,$sql);
             while($result = mysqli_fetch_assoc($query)){
                 $name = $result['picture'];
                 $altName = explode (".",$name);
                 echo " <div class=\"card mb-3 border-dark\">
        <div class=\"row no-gutters\">
            <div class=\"col-md-4\">
                <img src=\"uploads/{$result['picture']}\" class=\"card-img\" alt=\"$altName[0]\" width=\"200\" height=\"250\">
            </div>
            <div class=\"col-md-8\">
                <div class=\"card-body  \">
                    <h5 class=\"card-title\">{$result['title']}</h5>
                    <p class=\"card-text border-danger\" >{$result['description']}</p>
                    <p class=\"card-text\"><small class=\"text\">{$result['start']}</small></p>
                    <button class=\"btn mt-3 text-white\" style=\"background-color: #961a22\"  name=\"movie\">Više informacija</button>
                    <button class=\"btn mt-3 text-white\" style=\"background-color: #961a22\"  name=\"reserve\">Rezerviši</button>
                  </div>
                  </div>
                    </div>
                    </div>
                     
                 ";

             }
        ?>
        </div>

        <script src="js/bootstrap.min.js"></script>
    </body>
</html>



