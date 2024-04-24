<?php ob_start();
$themes = $requestThemes->fetchAll();
?>
<section class="listThemes section" id="listRoles">
    <div class="listThemes__container container">

        <?php
        foreach ($themes as $theme) {
        ?>
            <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>"><?= $theme["typeName"] . "<br>" ?></a>
        <?php
        }

        ?>
    </div>

    <a href="index.php?action=addTheme">Add a theme</a>

</section>

<?php

$title = "Themes's List";
$secondary_title = "Themes' List";
$content = ob_get_clean();
require "view/template.php";
