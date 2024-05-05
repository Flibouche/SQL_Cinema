<?php
ob_start();
$themeDetails = $requestThemeDetails->fetchAll();
$themeID = $requestThemeID->fetch();
?>

<section class="modal hidden" aria-label="Delete Theme Confirmation">
    <div class="flex">
        <button class="btn-close" aria-label="Close Modal">
            <p>X</p>
        </button>
    </div>

    <div>
        <h3>Are you sure you want to delete this theme ?</h3>
    </div>

    <button class="main__button btn" aria-label="Delete this theme"><a href="index.php?action=delTheme&id=<?= $themeID["idTheme"] ?>" type="submit" name="submit">Delete theme</a></button>
    <button class="main__button btn-close2" aria-label="Don't delete this theme"><span>Nevermind</span></button>

</section>

<div class="overlay hidden"></div>

<section class="themeDetails section" id="themeDetails">
    <div class="themeDetails__container container">

        <div class="theme__header-themeDetails">
            <h3>Details of : <?= $themeID["typeName"] ?></h3>
            <a href="index.php?action=editTheme&id=<?= $themeID["idTheme"] ?>" aria-label="Edit Theme">
                <i class="fa-solid fa-pencil"></i>
            </a>
        </div>

        <?php
        // Je vérifie s'il y a au moins un film
        if (!empty($themeDetails)) {
        ?>
            <div class="theme__movie-themeDetails">
                <?php
                foreach ($themeDetails as $themeDetails) {
                ?>
                    <figure class="theme__moviecard-themeDetails" title="<?= $themeDetails["title"] ?>">
                        <div class="moviecard__header-themeDetails">
                            <a href="index.php?action=movieDetails&id=<?= $themeDetails["idMovie"] ?>" aria-label="Details of <?= $themeDetails["title"] ?>"><img src="<?= $themeDetails["poster"] ?>" alt="Poster of <?= $themeDetails["title"] ?>" loading="lazy" /></a>
                        </div>

                        <div class="moviecard__description-themeDetails">
                            <div class="moviecard__descriptionMovie-themeDetails">
                                <a href="index.php?action=movieDetails&id=<?= $themeDetails["idMovie"] ?>"><?= $themeDetails["title"] ?></a>
                            </div>

                            <div class="moviecard__descriptionYear-themeDetails">
                                <a href="index.php?action=movieDetails&id=<?= $themeDetails["idMovie"] ?>"><?= $themeDetails["releaseYear"] ?></a>
                            </div>
                        </div>
                    </figure>
            <?php
                }
            } else {
                echo "No movie found in this category.";
            }
            ?>

            </div>

            <button class="main__button list__button"><a id="delete-button" class="btn-openModal" aria-label="Delete Theme">Delete theme</a></button>

    </div>
</section>

<?php

$title = $themeID["typeName"];
$secondary_title = $themeID["typeName"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>