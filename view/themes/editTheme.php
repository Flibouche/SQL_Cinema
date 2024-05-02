<?php ob_start();
$editThemeName = $requestThemeID->fetch();
?>

<section class="editTheme section" id="editTheme">

    <div class="editTheme__container container">

        <form action="index.php?action=editTheme&id=<?= $editThemeName['idTheme'] ?>" method="POST" enctype="multipart/form-data">

            <div class="form__group">
                <label for="typeName">Rename this theme : *</label>
                <input id="typeName" type="text" name="typeName" value="<?= $editThemeName['typeName'] ?>">
            </div>

            <div class="form__group">
                <label for="file">Picture upload :</label>
                <input type="file" name="file">
                <img class="editTheme-picture" src="<?= $editThemeName['illustration'] ?>" alt="Picture of the theme : <?= $editThemeName["typeName"] ?>">
            </div>

            <button class="main__button form" type="submit" name="submit" value="Rename"><span>Rename</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit this theme : " . $editThemeName["typeName"];
$secondary_title = "Edit this theme : " . $editThemeName["typeName"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>