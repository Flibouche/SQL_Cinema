<?php ob_start();
?>

<h1>Add a person</h1>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label class="">
            Person's firstname :
            <input class="" type="text" name="firstname">
        </label>
    </div>

    <div>
        <label for="">
            Person's surname :
            <input type="text" name="surname">
        </label>
    </div>

    <div>
        <label class="">
            Sex :
            <select name="sex" id="sex__select" placeholder="Please choose a sex">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </label>
    </div>

    <div>
        <label for="">
            Birthdate :
            <input type="date" id="" name="birthdate">
        </label>
    </div>

    <div>
        <label for="">
            Upload a picture :
            <input type="file" name="file">
        </label>
    </div>

    <div>
        <fieldset>
            <legend>Select a job :</legend>

            <div>
                <input type="radio" id="actor" name="job" value="actor" checked />
                <label for="actor">Actor</label>
            </div>

            <div>
                <input type="radio" id="director" name="job" value="director" />
                <label for="director">Director</label>
            </div>

            <div>
                <input type="radio" id="both" name="job" value="both" />
                <label for="both">Both</label>
            </div>

        </fieldset>
    </div>

    <div>
        <input class="" type="submit" name="submit" value="Add person">
    </div>

</form>


<?php

$title = "Add a person";
$secondary_title = "Add a person";
$content = ob_get_clean();
require "view/template.php";
