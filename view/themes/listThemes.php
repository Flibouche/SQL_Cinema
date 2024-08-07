<?php
ob_start();
$themes = $requestThemes->fetchAll();
?>
<section class="listThemes section" id="listRoles">

    <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search for a theme.." title="Type in a name" aria-label="Search for a theme by name">

    <div class="listThemes__container container">

        <?php
        foreach ($themes as $theme) {
        ?>
            <figure class="theme__card-listThemes" title="<?= $theme["typeName"] ?>">
                <div class="card__header-listThemes">
                    <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>" aria-label="Details of the theme <?= $theme["typeName"] ?>">
                        <img src="<?= $theme["illustration"] ?>" alt="Illustration of the theme <?= $theme["typeName"] ?>" loading="lazy" />
                    </a>
                </div>

                <div class="card__description-listThemes">
                    <a href="index.php?action=themeDetails&id=<?= $theme["idTheme"] ?>"><span><?= $theme["typeName"] ?></span></a>
                </div>

            </figure>
        <?php
        }

        ?>
    </div>

    <?php
    if ($session->isAdmin()) { ?>
        <button class="main__button list__button" aria-label="Add a theme"><a href="index.php?action=addTheme">Add a theme</a></button>
    <?php } ?>

</section>

<script>
    // Tuto W3Schools
    function myFunction() {
        var input, filter, container, figure, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        container = document.getElementsByClassName("listThemes__container")[0];
        figure = container.getElementsByTagName("figure");

        for (i = 0; i < figure.length; i++) {
            title = figure[i].getElementsByTagName("span")[0];
            if (title) {
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    figure[i].style.display = "";
                } else {
                    figure[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php

$title = "Themes's List (" . $requestThemes->rowCount() . ")";
$secondary_title = "Themes's List (" . $requestThemes->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>