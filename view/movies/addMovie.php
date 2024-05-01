<?php ob_start();
?>

<section class="addMovie section" id="addMovie">

    <div class="addMovie__container container">

        <form action="index.php?action=addMovie" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="title">Title : *</label>
                <input type="text" id="title" name="title" placeholder="Enter movie title" required>
            </div>

            <div class="form__group">
                <label for="releaseYear">Release Year : *</label>
                <input type="text" id="releaseYear" name="releaseYear" placeholder="Enter release year" required>
            </div>

            <div class="form__group">
                <label for="duration">Duration (in minutes) : *</label>
                <input type="number" id="duration" name="duration" placeholder="Enter duration" required>
            </div>

            <div class="form__group">
                <label for="note">Note : *</label>
                <input type="number" id="note" step="0.1" min="1" max="5" name="note" placeholder="Enter a note (1-5)" required>
            </div>

            <div class="form__group">
                <label for="file">Poster :</label>
                <input type="file" name="file">
            </div>

            <div class="form__group">
                <label for="idDirector">Director :</label>
                <select id="idDirector" name="idDirector">
                    <?php
                    foreach ($requestDirectors->fetchAll() as $director) {
                    ?>
                        <option value="<?= $director["idDirector"] ?>"><?= $director["firstname"] . " " . $director["surname"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form__group-grid">
                <label class="themeLabel" for="theme">Theme(s) : *<br></label>
                <div class="checkbox-container">
                    <?php
                    foreach ($requestThemes->fetchAll() as $theme) {
                    ?>
                        <div class="checkbox-grid">
                            <input type="checkbox" id="<?= $theme["idTheme"] ?>" name="theme[]" value="<?= $theme["idTheme"] ?> ">
                            <label for="<?= $theme["idTheme"] ?>" value="<?= $theme["idTheme"] ?>"><?= $theme["typeName"] . "<br>" ?></label>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="form__group">
                <label for="synopsis">Synopsis :</label>
                <textarea id="synopsis" name="synopsis" rows="4" cols="45" placeholder="Enter a synopsis"></textarea>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Add movie"><span>Add Movie</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a movie";
$metaDescription = "Here is the form where you can add a movie to the database";
$secondary_title = "Add a movie";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>