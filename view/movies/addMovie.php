<?php ob_start();
?>

<h1>Add a movie</h1>

<form action="">

    <div>
        <label for="">
            Title :
            <input type="text" name="title">
        </label>
    </div>

    <div>
        <label for="">
            Release Year :
            <input type="date" id="" name="releaseyear">
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
            Theme(s) :

            <input type="checkbox" id="" name="" checked />
            <label for="">Theme1</label>

            <input type="checkbox" id="" name="">
            <label for="">Theme2</label>

            <input type="checkbox" id="" name="">
            <label for="">Theme3</label>

            <input type="checkbox" id="" name="">
            <label for="">Theme4</label>

        </label>
    </div>

    <div>
        <label for="">
            Synopsis :
            <textarea>
            </textarea>
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
