<?php ob_start();
$editThemeName = $requestThemeID->fetch();
?>

<section class="editTheme section" id="editTheme">

    <div class="editTheme__container container">

        <form action="" method="post">

            <div class="form__group">
                <label class="typeName">Rename this theme : *</label>
                <input class="" type="text" name="typeName" value="<?= $editThemeName['typeName'] ?>">
            </div>

            <button class="main__button form" type="submit" name="submit" value="Rename"><span>Rename</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit this theme : " . $editThemeName["typeName"];
$secondary_title = "Edit this theme : " . $editThemeName["typeName"];
$content = ob_get_clean();
require "view/template.php";