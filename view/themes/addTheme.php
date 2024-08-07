<?php ob_start();
?>

<section class="addTheme section" id="addTheme">

    <div class="addTheme__container container">

        <form action="index.php?action=addTheme" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="theme">Movie theme name : *</label>
                <input id="theme" type="text" name="theme" placeholder="Enter name" required aria-label="Enter the name of the movie theme">
            </div>

            <div class="form__group">
                <label for="file">Upload an illustration for this theme :</label>
                <input type="file" name="file" aria-label="Upload an illustration for this theme">
            </div>

            <button class="main__button form" type="submit" name="submit" value="Add theme" aria-label="Add Theme"><span>Add Theme</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a theme";
$secondary_title = "Add a theme";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>