<?php ob_start();
?>

<section class="addPerson section" id="addPerson">

    <div class="addPerson__container container">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form__group">
                <label class="firstname">Person's firstname : *</label>
                <input class="" type="text" name="firstname" placeholder="Enter firstname" required>
            </div>

            <div class="form__group">
                <label for="surname">Person's surname : *</label>
                <input type="text" name="surname" placeholder="Enter surname" required>
            </div>

            <div class="form__group">
                <label class="sex">Sex : *</label>
                <select name="sex" id="sex__select" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="form__group">
                <label for="birthdate">Birthdate : *</label>
                <input type="date" id="" name="birthdate" required>
            </div>

            <div class="form__group">
                <label for="file">Upload a picture :</label>
                <input type="file" name="file">
            </div>

            <div class="form__group">
                <label for="job">Select a job : *</label>
                <fieldset required>

                    <div>
                        <input type="radio" id="actor" name="job" value="actor" checked required/>
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

            <button class="main__button form" type="submit" name="submit" value="Add person"><span>Add Person</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a person";
$secondary_title = "Add a person";
$content = ob_get_clean();
require "view/template.php";
