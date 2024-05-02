<?php ob_start();
$movieDetails = $requestMovie->fetch();
?>

<section class="editMovie section" id="editMovie">

    <div class="editMovie__container container">

        <form action="index.php?action=editMovie&id=<?= $movieDetails['idMovie'] ?>" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="title">Title : *</label>
                <input type="text" id="title" name="title" value="<?= $movieDetails['title'] ?>">
            </div>

            <div class="form__group">
                <label for="releaseYear">Release Year : *</label>
                <input type="text" id="releaseYear" name="releaseYear" value="<?= $movieDetails['releaseYear'] ?>">
            </div>

            <div class="form__group">
                <label for="duration">Duration (in minutes): *</label>
                <input type="number" id="duration" name="duration" value="<?= $movieDetails['duration'] ?>">
            </div>

            <div class="form__group">
                <label for="note">Note : *</label>
                <input type="number" id="note" step="0.1" name="note" value="<?= $movieDetails['note'] ?>">
            </div>

            <div class="form__group">
                <label for="file">Poster upload :</label>
                <input type="file" name="file">
                <img class="editMovie-poster" src="<?= $movieDetails['poster'] ?>" alt="Poster of <?= $movieDetails["title"] ?>">
            </div>

            <div class="form__group">
                <label for="synopsis">Synopsis :</label>
                <textarea id="synopsis" name="synopsis" rows="4" cols="50"><?= $movieDetails['synopsis'] ?></textarea>
            </div>

            <div class="form__group">
                <label for="idDirector">Director : *</label>
                <select id="idDirector" name="idDirector">
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
                            <input type="checkbox" id="<?= $theme['idTheme'] ?>" name="theme[]" value="<?= $theme['idTheme'] ?>" <?= $check ?> />
                            <label for="<?= $theme['idTheme'] ?>" value="<?= $theme["idTheme"] ?>"><?= $theme["typeName"] ?></label>
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
$metaDescription = "Here is the form where you can edit the informations of the movie '" . $movieDetails["title"] . "'";
$secondary_title = "Edit the movie : " . $movieDetails["title"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>