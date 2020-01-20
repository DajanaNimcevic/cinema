<?php
require_once "../includes/db_config.php";
$sql = "SELECT * FROM screening s JOIN movie m ON s.id_movie = m.id_movie ORDER BY start asc";
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
            <form method=\"post\" action=\"updateScreening.php\">
                <img src=\"../uploads/{$result['picture']}\"  alt=\"$altName[0]\" width=\"250\" height=\"300\"><br>
        </div>
        <div class=\"col-sm-8 col-md-6 col-lg-8\">
                <strong>Screening time: </strong>{$result['start']}<br>
                <strong>Title: </strong>{$result['title']}<br>
                <strong>Description: </strong>{$result['description']}<br>
                <strong>Length: </strong>{$result['lengthMin']}<br>
                <strong>Trailer: </strong>{$result['trailer_link']}<br>
                <strong>IMDB: </strong>{$result['imdb_link']}<br>
                <input type=\"hidden\" name=\"id\" value=\"{$result['id_screening']}\" >
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
