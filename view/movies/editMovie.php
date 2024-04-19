<?php ob_start();
$movieDetails = $requestMovie->fetch();
?>

<h1>Edit this movie</h1>

<form action="" method="post" enctype="multipart/form-data">

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
            <input type="number" name="duration" value="<?= $movieDetails['duration'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Note :
            <input type="number" step="0.1" name="note" value="<?= $movieDetails['note'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Poster upload :
            <input type="file" name="file">
            <img src="<?= $movieDetails['poster'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Synopsis :
            <textarea name="synopsis" rows="4" cols="50"><?= $movieDetails['synopsis'] ?></textarea>
        </label>
    </div>

    <div>
        <label for="">
            Director :
            <select name="idDirector" id="">
                <?php
                foreach ($requestDirectors->fetchAll() as $director) {
                    $selected = ($director["idDirector"] == $movieDetails["idDirector"]) ? "selected" : "";
                ?>
                    <option value="<?= $director["idDirector"] ?>" <?= $selected ?>><?= $director["firstname"] . " " . $director["surname"] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
    </div>

    <div>
        <label for="">
            Theme(s) : <br>
            <?php
            foreach ($requestThemes->fetchAll() as $theme) {
                $check = (in_array($theme["idTheme"], $themesMovie)) ? "checked" : "";
            ?>
                <input type="checkbox" id="" name="theme[]" value="<?= $theme['idTheme'] ?>" <?= $check ?> />
                <label for="" value="<?= $theme["idTheme"] ?>"><?= $theme["typeName"] . "<br>" ?></label>
            <?php
            }
            ?>
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
