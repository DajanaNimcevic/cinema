<?php
require "../includes/db_config.php";
if(isset($_POST['update'])) {

    $id = mysqli_real_escape_string ($conn, $_POST['id']);
    $sql = "SELECT * FROM movie WHERE id_movie = $id;";
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
                <form method="post" action="updateMovie.php" enctype="multipart/form-data" class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= $result['title'] ?>"><br>
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="<?= $result['description'] ?>"><br>
                    <label for="length">Length</label>
                    <input type="text" name="length" id="length" class="form-control" value="<?= $result['lengthMin'] ?>"><br>
                    <label for="trailer">Trailer</label>
                    <input type="text" name="trailer" id="trailer" class="form-control" value="<?= $result['trailer_link'] ?>"><br>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="picture" id="picture">
                        <label class="custom-file-label" for="picture">Choose Picture</label>
                    </div>
                    <label for="imdb">IMDB</label>
                    <input type="text" name="imdb" id="imdb" class="form-control" value="<?= $result['imdb_link']?>">
                    <input type="hidden" name="id" value="<?=$result['id_movie']?>">
                    <button class="btn btn-danger btn-block mt-3" type="submit" name="updateData">Insert</button>
                </form>
            </div>
        </div>
    </div>
    <?php
}

if(isset($_POST['updateData'])){

    $id = mysqli_real_escape_string ($conn,$_POST['id']);
    $title = mysqli_real_escape_string ($conn,$_POST['title']);
    $description = mysqli_real_escape_string ($conn,$_POST['description']);
    $lengthMin = mysqli_real_escape_string ($conn,$_POST['length']);
    $trailer = mysqli_real_escape_string ($conn,$_POST['trailer']);
    $imdb = mysqli_real_escape_string ($conn,$_POST['imdb']);


    $picture = $_FILES['picture'];
    $pictureName = $_FILES['picture']['name'];
    $pictureTmp = $_FILES['picture']['tmp_name'];

    if($pictureTmp != ''){

        $pictureDestination = "../uploads/".$pictureName;
        $upload = move_uploaded_file($pictureTmp,$pictureDestination);

        if(!$upload){
            header ("Location: index.php?error=errorUpload&submit=list");
            exit();
        }
        $sql = "UPDATE movie SET title = '$title',description = '$description',lengthMin = '$lengthMin',trailer_link = '$trailer',picture = '$pictureName',imdb_link = '$imdb' WHERE id_movie = '$id';";
    }else{
        $sql = "UPDATE movie SET title = '$title',description = '$description',lengthMin = '$lengthMin',trailer_link = '$trailer',imdb_link = '$imdb' WHERE id_movie = '$id';";
    }


    $query = mysqli_query ($conn,$sql);

    if(mysqli_affected_rows ($conn) < 1){
        header ("Location: index.php?error=errorQuery&submit=list");
        exit();
    }

    header ("Location: index.php?error=success&submit=list");
    exit();

}else if(isset($_POST['delete'])){

    $id = mysqli_real_escape_string ($conn,$_POST['id']);
    $sql = "DELETE FROM movie WHERE id_movie=$id;";
    $query = mysqli_query ($conn,$sql);
    if(mysqli_affected_rows ($conn) < 1){
       // var_dump($id);
        header ("Location: index.php?error=errorQuery&submit=list");
        exit();
    }

    header ("Location: index.php?error=success&submit=list");
    exit();

}