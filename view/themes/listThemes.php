<?php
ob_start();
$themes = $requestThemes->fetchAll();
?>
<section class="listThemes section" id="listRoles">
    <div class="listThemes__container container">

        <?php
        foreach ($themes as $theme) {
        ?>
            <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>" title="<?= $theme["typeName"] ?>"><?= $theme["typeName"] . "<br>" ?></a>
        <?php
        }

        ?>
    </div>

    <button class="main__button list__button"><a href="index.php?action=addTheme">Add a theme</a></button>

</section>

<?php

$title = "Themes's List (" . $requestThemes->rowCount() . ")";
$secondary_title = "Themes's List (" . $requestThemes->rowCount() . ")";
$content = ob_get_clean();
require "view/template.php";
?>