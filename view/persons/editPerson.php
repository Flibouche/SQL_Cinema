<?php ob_start();
$personDetails = $requestPerson->fetch();
?>

<h1>Edit this person</h1>

<form action="" method="post">

    <div>
        <label class="">
            Person's firstname :
            <input class="" type="text" name="firstname" value="<?= $personDetails['firstname'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Person's surname :
            <input type="text" name="surname" value="<?= $personDetails['surname'] ?>">
        </label>
    </div>

    <div>
        <label class="">
            Sex :
            <select name="sex" id="sex__select" placeholder="Please choose a sex" value="<?= $personDetails['sex'] ?>">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </label>
    </div>

    <div>
        <label for="">
            Birthdate :
            <input type="date" id="" name="birthdate" value="<?= $personDetails['birthdate'] ?>" />
        </label>
    </div>

    <div>
        <label for="">
            Picture text :
            <input type="text" name="picture" value="<?= $personDetails['picture'] ?>">
        </label>
    </div>

    <div>
        <label for="">
            Picture upload :
            <input type="file" name="file">
        </label>
    </div>

    <div>
        <input class="" type="submit" name="submit" value="Edit person">
    </div>

</form>

<?php

$title = "Edit a person";
$secondary_title = "Edit a person";
$content = ob_get_clean();
require "view/template.php";