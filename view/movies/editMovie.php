<?php ob_start();
$movieDetails = $requestMovie->fetch();
?>

<section class="editMovie section" id="editMovie">

    <div class="editMovie__container container">

        <form action="index.php?action=editMovie&id=<?= $movieDetails['idMovie'] ?>" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="title" aria-label="Enter movie title">Title : *</label>
                <input type="text" id="title" name="title" value="<?= $movieDetails['title'] ?>">
            </div>

            <div class="form__group">
                <label for="releaseYear" aria-label="Enter release year">Release Year : *</label>
                <input type="text" id="releaseYear" name="releaseYear" value="<?= $movieDetails['releaseYear'] ?>">
            </div>

            <div class="form__group">
                <label for="duration" aria-label="Enter duration in minutes">Duration (in minutes): *</label>
                <input type="number" id="duration" name="duration" value="<?= $movieDetails['duration'] ?>">
            </div>

            <div class="form__group">
                <label for="note" aria-label="Enter a note between 1 and 5">Note : *</label>
                <input type="number" id="note" step="0.1" name="note" value="<?= $movieDetails['note'] ?>">
            </div>

            <div class="form__group">
                <label for="file" aria-label="Upload movie poster">Poster upload :</label>
                <input type="file" name="file">
                <img class="editMovie-poster" src="<?= $movieDetails['poster'] ?>" alt="Poster of <?= $movieDetails["title"] ?>" loading="lazy" />
            </div>

            <div class="form__group">
                <label for="synopsis" aria-label="Enter movie synopsis">Synopsis :</label>
                <textarea id="synopsis" name="synopsis" rows="4" cols="50"><?= $movieDetails['synopsis'] ?></textarea>
            </div>

            <div class="form__group">
                <label for="idDirector" aria-label="Select movie director">Director : *</label>
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
                <label class="themeLabel" for="theme" aria-label="Select movie themes">Theme(s) : *</label>
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

            <button class="main__button form" type="submit" name="submit" value="Edit movie" aria-label="Edit movie"><span>Edit Movie</span></button>

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