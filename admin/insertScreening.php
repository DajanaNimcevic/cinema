<?php require "../includes/db_config.php" ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6 offset-3">
            <form method="post" action="insertScreening.php" enctype="multipart/form-data" class="form-group">
                <label for="movie">Movie</label>
                <select id="movie" name="movie" class="form-control">
                    <?php
                    if(!isset($_POST['insertData'])) {
                        $sql = "SELECT * FROM movie";
                        $query = mysqli_query($conn, $sql);
                        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        foreach ($results as $result) {
                            echo "<option value=\"{$result['id_movie']}\">{$result['title']}</option>";
                        }
                    }
                    ?>
                </select>
                <label for="date">Date</label>
                <input type="datetime-local" name="date" id="date" class="form-control" value=""><br>

                <button class="btn btn-danger btn-block mt-3" type="submit" name="insertData">Insert</button>
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['insertData'])) {

    $movie = mysqli_real_escape_string ($conn,$_POST['movie']);
    $date = mysqli_real_escape_string ($conn,$_POST['date']);


    $sql = "INSERT INTO screening(id_movie, start) VALUES('$movie','$date');";
    $query = mysqli_query ($conn,$sql);

    if(empty($date) or empty($movie)){
        header ("Location: index.php?error=empty&submit=insert");
        exit();
    }

    if(mysqli_affected_rows ($conn) < 1){
        header ("Location: index.php?error=errorQuery&submit=insert");
        exit();
    }

    header ("Location: index.php?error=success&submit=insert");
    exit();

}