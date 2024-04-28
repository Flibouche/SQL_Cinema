<?php ob_start();
$personDetails = $requestPerson->fetch();
?>

<section class="editPerson section" id="editPerson">

    <div class="editPerson__container container">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form__group">
                <label class="firstname">Person's firstname : *</label>
                <input class="" type="text" name="firstname" value="<?= $personDetails['firstname'] ?>" required>
            </div>

            <div class="form__group">
                <label for="surname">Person's surname : *</label>
                <input type="text" name="surname" value="<?= $personDetails['surname'] ?>" required>
            </div>

            <div class="form__group">
                <label class="sex">Sex : *</label>
                <select name="sex" id="sex__select" placeholder="Please choose a sex" value="<?= $personDetails['sex'] ?>" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="form__group">
                <label for="birthdate">Birthdate : *</label>
                <input type="date" id="" name="birthdate" value="<?= $personDetails['birthdate'] ?>" required>
            </div>

            <div class="form__group">
                <label for="file">Picture upload :</label>
                <input type="file" name="file">
                <img class="editPerson-picture" src="<?= $personDetails['picture'] ?>" alt="Person's picture">
            </div>

            <div class="form__group">
                <label for="biography">Biography :</label>
                <textarea name="biography" rows="4" cols="50"><?= $personDetails['biography'] ?></textarea>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Edit person"><span>Edit Person</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit the person : " . $personDetails["firstname"] . " " . $personDetails["surname"];
$secondary_title = "Edit the person : " . $personDetails["firstname"] . " " . $personDetails["surname"];
$content = ob_get_clean();
require "view/template.php";
