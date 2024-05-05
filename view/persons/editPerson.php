<?php ob_start();
$personDetails = $requestPerson->fetch();
?>

<section class="editPerson section" id="editPerson">

    <div class="editPerson__container container">

        <form action="index.php?action=editPerson&id=<?= $personDetails['idPerson'] ?>" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="firstname" aria-label="Person's firstname">Person's firstname : *</label>
                <input id="firstname" type="text" name="firstname" value="<?= $personDetails['firstname'] ?>" required>
            </div>

            <div class="form__group">
                <label for="surname" aria-label="Person's surname">Person's surname : *</label>
                <input id="surname" type="text" name="surname" value="<?= $personDetails['surname'] ?>" required>
            </div>

            <div class="form__group">
                <label for="sex" aria-label="Sex">Sex : *</label>
                <select id="sex" name="sex" placeholder="Please choose a sex" value="<?= $personDetails['sex'] ?>" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="form__group">
                <label for="birthdate" aria-label="Birthdate">Birthdate : *</label>
                <input id="birthdate" type="date" name="birthdate" value="<?= $personDetails['birthdate'] ?>" required>
            </div>

            <div class="form__group">
                <label for="file" aria-label="Upload a picture">Picture upload :</label>
                <input type="file" name="file">
                <img class="editPerson-picture" src="<?= $personDetails['picture'] ?>" alt="Picture of <?= $personDetails["firstname"] . " " . $personDetails["surname"] ?>" loading="lazy" />
            </div>

            <div class="form__group">
                <label for="biography" aria-label="Biography">Biography :</label>
                <textarea id="biography" name="biography" rows="4" cols="50"><?= $personDetails['biography'] ?></textarea>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Edit person" aria-label="Edit Person"><span>Edit Person</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit the person : " . $personDetails["firstname"] . " " . $personDetails["surname"];
$metaDescription = "Here is the form where you can edit the informations of the person '" . $personDetails["firstname"] . " " . $personDetails["surname"] . "'";
$secondary_title = "Edit the person : " . $personDetails["firstname"] . " " . $personDetails["surname"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>