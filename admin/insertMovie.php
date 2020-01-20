<?php require "../includes/db_config.php" ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6 offset-3">
            <form method="post" action="insertMovie.php" enctype="multipart/form-data" class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control"><br>
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control"><br>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="picture" name="picture">
                    <label class="custom-file-label"  for="picture">Choose Picture</label>
                </div>
                <label for="length">Length</label>
                <input type="text" name="length" id="length" class="form-control"><br>
                <label for="trailer">Trailer link</label>
                <input type="text" name="trailer" id="trailer" class="form-control"><br>
                <label for="imdb">IMDB link</label>
                <input id="imdb" type="text" name="imdb" class="form-control">
                <button class="btn btn-danger btn-block mt-3" type="submit" name="insertData">Insert</button>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['insertData'])) {

    $title = mysqli_real_escape_string ($conn,$_POST['title']);
    $description = mysqli_real_escape_string ($conn,$_POST['description']);
    $length = mysqli_real_escape_string ($conn,$_POST['length']);
    $trailer = mysqli_real_escape_string ($conn,$_POST['trailer']);
    $imdb = mysqli_real_escape_string ($conn,$_POST['imdb']);

    $picture = $_FILES['picture'];
    $pictureName = $_FILES['picture']['name'];
    $pictureTmp = $_FILES['picture']['tmp_name'];
    $pictureSize  = $_FILES['picture']['size'];
    $pictureType = $_FILES['picture']['type'];

    if(empty($title) or empty($description) or empty($length) or empty($trailer) or empty($imdb) or empty($picture)){
        header ("Location: index.php?error=empty&submit=insert");
        exit();
    }
    if($pictureSize > 10000000 or $pictureType !== 'image/jpeg'){
        header ("Location: index.php?error=errorImage&submit=insert");
        exit();
    }
    $pictureDestination = "../uploads/".$pictureName;
    $upload = move_uploaded_file($pictureTmp,$pictureDestination);
    if(!$upload){
        header ("Location: index.php?error=errorUpload&submit=insert");
        exit();
    }
    $sql = "INSERT INTO movie(title,description,lengthMin,trailer_link,picture,imdb_link) VALUES('$title','$description','$length','$trailer','$pictureName','$imdb');";
    $query = mysqli_query ($conn,$sql);

    if(mysqli_affected_rows ($conn) < 1){
        header ("Location: index.php?error=errorQuery&submit=insert");
        exit();
    }

    header ("Location: index.php?error=success&submit=insert");
    exit();

}
