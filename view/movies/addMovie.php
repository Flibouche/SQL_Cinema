<?php ob_start();
?>

<h1>Add a movie</h1>

<form action="" method="post">

    <div>
        <label for="">
            Title :
            <input type="text" name="title">
        </label>
    </div>

    <div>
        <label for="">
            Release Year :
            <input type="text" id="" name="releaseYear">
        </label>
    </div>

    <div>
        <label for="">
            Duration (in minutes):
            <input type="text" name="duration">
        </label>
    </div>

    <div>
        <label for="">
            Note :
            <input type="text" name="note">
        </label>
    </div>

    <div>
        <label for="">
            Poster text :
            <input type="text" name="poster">
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
            Director :
            <select name="idDirector" id="">
                <?php
                foreach ($requestDirectors->fetchAll() as $director) {
                ?>
                    <option value="<?= $director["idDirector"] ?>"><?= $director["firstname"] . " " . $director["surname"] ?></option>
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
            ?>
                <input type="checkbox" id="" name="theme[]" value="<?= $theme["idTheme"] ?> " />
                <label for="" value="<?= $theme["idTheme"] ?>"><?= $theme["typeName"] . "<br>" ?></label>
            <?php
            }
            ?>

        </label>
    </div>

    <div>
        <label for="">
            Synopsis :
            <textarea name="synopsis" rows="4" cols="50"></textarea>
        </label>
    </div>

    <div>
        <input class="" type="submit" name="submit" value="Add movie">
    </div>

</form>



<?php

$title = "Add a movie";
$secondary_title = "Add a movie";
$content = ob_get_clean();
require "view/template.php";