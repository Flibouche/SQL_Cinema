<?php ob_start();
?>

<section class="addPerson section" id="addPerson">

    <div class="addPerson__container container">

        <form action="index.php?action=addPerson" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="firstname" aria-label="Person's firstname">Person's firstname : *</label>
                <input id="firstname" type="text" name="firstname" placeholder="Enter firstname" required>
            </div>

            <div class="form__group">
                <label for="surname" aria-label="Person's surname">Person's surname : *</label>
                <input id="surname" type="text" name="surname" placeholder="Enter surname" required>
            </div>

            <div class="form__group">
                <label for="sex" aria-label="Sex">Sex : *</label>
                <select id="sex" name="sex" id="sex__select" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="form__group">
                <label for="birthdate" aria-label="Birthdate">Birthdate : *</label>
                <input id="birthdate" type="date" name="birthdate" required>
            </div>

            <div class="form__group">
                <label for="file" aria-label="Upload a picture">Upload a picture :</label>
                <input type="file" name="file">
            </div>

            <div class="form__group">
                <label for="biography" aria-label="Biography">Biography :</label>
                <textarea id="biography" name="biography" rows="4" cols="45" placeholder="Enter a biography"></textarea>
            </div>

            <div class="form__group">
                <label for="job" aria-label="Select a job">Select a job : *</label>
                <fieldset required>

                    <div>
                        <input type="radio" id="actor" name="job" value="actor" checked required />
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

            <button class="main__button form" type="submit" name="submit" value="Add person" aria-label="Add person"><span>Add Person</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a person";
$metaDescription = "Here is the form where you can add a person to the database and decided which job the person has.";
$secondary_title = "Add a person";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>