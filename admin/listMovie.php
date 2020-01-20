<?php
require "../includes/db_config.php";
$sql = "SELECT * FROM movie ORDER BY id_movie desc";
$query = mysqli_query ($conn,$sql);
?>
<div class="container mt-5">
    <?php
    while($result = mysqli_fetch_assoc($query)){
        $name = $result['picture'];
        $altName = explode (".",$name);
        echo"
     <div class=\"row\">
        <div class=\"col-sm-4 col-md-12 col-lg-4\">
            <form method=\"post\" action=\"updateMovie.php\">
                <img src=\"../uploads/{$result['picture']}\" alt=\"$altName[0]\" width=\"250\" height=\"300\"><br>
        </div>
        <div class=\"col-sm-8 col-md-6 col-lg-8\">
                <strong>Title: </strong>{$result['title']}<br>
                <strong>Description: </strong>{$result['description']}<br>
                <strong>Length: </strong>{$result['lengthMin']}<br>
                <strong>Trailer: </strong>{$result['trailer_link']}<br>
                <strong>IMDB: </strong>{$result['imdb_link']}<br>
                <input type=\"hidden\" name=\"id\" value=\"{$result['id_movie']}\" >
                <button class=\"btn btn-danger mt-3\"  name=\"update\">UPDATE</button>
                <button class=\"btn btn-danger mt-3\"  name=\"delete\">DELETE</button>
            </form>
        </div>
     </div>
     <hr>
";
    }
    ?>
</div>
