<?php ob_start();
$movieDetails = $requestMovie->fetch();
?>

<section class="editMovie section" id="editMovie">

    <div class="editMovie__container container">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form__group">
                <label for="title">Title : *</label>
                <input type="text" name="title" value="<?= $movieDetails['title'] ?>">
            </div>

            <div class="form__group">
                <label for="releaseYear">Release Year : *</label>
                <input type="text" id="" name="releaseYear" value="<?= $movieDetails['releaseYear'] ?>">
            </div>

            <div class="form__group">
                <label for="duration">Duration (in minutes): *</label>
                <input type="number" name="duration" value="<?= $movieDetails['duration'] ?>">
            </div>

            <div class="form__group">
                <label for="note">Note : *</label>
                <input type="number" step="0.1" name="note" value="<?= $movieDetails['note'] ?>">
            </div>

            <div class="form__group">
                <label for="file">Poster upload :</label>
                <input type="file" name="file">
                <img class="editMovie-poster" src="<?= $movieDetails['poster'] ?>">
            </div>

            <div class="form__group">
                <label for="synopsis">Synopsis :</label>
                <textarea name="synopsis" rows="4" cols="50"><?= $movieDetails['synopsis'] ?></textarea>
            </div>

            <div class="form__group">
                <label for="idDirector">Director : *</label>
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
            </div>

            <div class="form__group">
                <label class="themeLabel" for="theme">Theme(s) : *</label>
                <div class="checkbox-container">
                    <?php
                    foreach ($requestThemes->fetchAll() as $theme) {
                        $check = (in_array($theme["idTheme"], $themesMovie)) ? "checked" : "";
                    ?>
                        <div class="checkbox-grid">
                            <input type="checkbox" id="" name="theme[]" value="<?= $theme['idTheme'] ?>" <?= $check ?> />
                            <label for="" value="<?= $theme["idTheme"] ?>"><?= $theme["typeName"] . "<br>" ?></label>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Edit movie"><span>Edit Movie</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit the movie : " . $movieDetails["title"];
$secondary_title = "Edit the movie : " . $movieDetails["title"];
$content = ob_get_clean();
require "view/template.php";
