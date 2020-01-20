<?php
require "../includes/db_config.php";
if(isset($_POST['update'])) {

    $id = mysqli_real_escape_string ($conn, $_POST['id']);
    $sql = "SELECT * FROM screening s JOIN movie m ON s.id_movie = m.id_movie WHERE id_screening = $id";
    $query = mysqli_query ($conn, $sql);
    $result = mysqli_fetch_assoc ($query);
    ?>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4 offset-2">
                <img class="img-fluid" src="../uploads/<?= $result['picture']?>" width="250" height="300">
            </div>
            <div class="col-sm-4">
                <form method="post" action="insertScreening.php" enctype="multipart/form-data" class="form-group">
                    <label for="movie">Movie</label>
                    <select id="movie" name="movie" class="form-control" value="<?= $result['id_movie'] ?>">
                        <?php
                        if(!isset($_POST['insertData'])) {
                            $sql = "SELECT * FROM movie";
                            $query = mysqli_query($conn, $sql);
                            $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            foreach ($results as $result) {
                                if ($result['id_screening'] == $id)
                                     echo "<option value=\"{$result['id_movie']} selected\">{$result['title']}</option>";
                                echo "<option value=\"{$result['id_movie']}\">{$result['title']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="date">Date</label>
                    <input type="datetime-local" name="date" id="date" class="form-control" value="<?= $result['date'] ?>"><br>

                    <button class="btn btn-danger btn-block mt-3" type="submit" name="insertData">Insert</button>
                </form>
            </div>
        </div>
    </div>
    <?php
}

if(isset($_POST['updateData'])){

    $movie = mysqli_real_escape_string ($conn,$_POST['movie']);
    $date = mysqli_real_escape_string ($conn,$_POST['date']);

    $sql = "UPDATE screening SET movie = '$movie',date = '$date' WHERE id_screening = '$id';";
    $query = mysqli_query ($conn,$sql);

    if(mysqli_affected_rows ($conn) < 1){
        header ("Location: index.php?error=errorQuery&submit=listScreenings");
        exit();
    }

    header ("Location: index.php?error=success&submit=listScreenings");
    exit();

}else if(isset($_POST['delete'])){

    $id = mysqli_real_escape_string ($conn,$_POST['id']);
    $sql = "DELETE FROM screening WHERE id_screening = $id;";
    $query = mysqli_query ($conn,$sql);
    if(mysqli_affected_rows ($conn) < 1){
        header ("Location: index.php?error=errorQuery&submit=listScreenings");
        exit();
    }

    header ("Location: index.php?error=success&submit=listScreenings");
    exit();

}