<?php
ob_start();
$themes = $requestThemes->fetchAll();
?>
<section class="listThemes section" id="listRoles">
    <div class="listThemes__container container">

        <?php
        foreach ($themes as $theme) {
        ?>
            <figure class="theme__card-listThemes" title="<?= $theme["typeName"] ?>">
                <div class="card__header-listThemes">
                    <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>"><img src="<?= $theme["illustration"] ?>" alt="Illustration of the theme <?= $theme["typeName"] ?>"></a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>">
                            <p class="text-hover">Test</p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listThemes">
                    <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>"><?= $theme["typeName"] ?></a>
                </div>

            </figure>
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
$hideBgImage = false;
require "view/template.php";
?>