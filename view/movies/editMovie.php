<?php ob_start();
$movieDetails = $requestMovie->fetch();
?>

<h1>Edit this movie</h1>

<form action="" method="post">

    <div>
        <label for="">
            Title :
            <input type="text" name="title" value="<?= $movieDetails['title'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Release Year :
            <input type="text" id="" name="releaseYear" value="<?= $movieDetails['releaseYear'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Duration (in minutes):
            <input type="text" name="duration" value="<?= $movieDetails['duration'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Note :
            <input type="text" name="note" value="<?= $movieDetails['note'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Poster text :
            <input type="text" name="poster" value="<?= $movieDetails['poster'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Poster upload :
            <input type="file" name="file">
        </label>
    </div>

    <div>
        <label for="">
            Synopsis :
            <textarea name="synopsis" rows="4" cols="50"><?= $movieDetails['synopsis']?></textarea>
        </label>
    </div>

    <div>
        <input class="" type="submit" name="submit" value="Edit movie">
    </div>

</form>

<?php

$title = "Edit this movie";
$secondary_title = "Edit this movie";
$content = ob_get_clean();
require "view/template.php";
