<?php ob_start();
$themeDetails = $requestThemeDetails->fetchAll();
$themeID = $requestThemeID->fetch();
?>

<section class="themeDetails section" id="themeDetails">
    <div class="themeDetails__container container">

        <div class="theme__header-themeDetails">
            <h3>Details of : <?= $themeID["typeName"] ?></h3>
            <a href="index.php?action=editTheme&id=<?= $themeID["idTheme"] ?>">
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
                    <figure class="theme__moviecard-themeDetails">
                        <div class="moviecard__header-themeDetails">
                            <a href="index.php?action=movieDetails&id=<?= $themeDetails["idMovie"] ?>"><img src="<?= $themeDetails["poster"] ?>" alt="Poster of <?= $themeDetails["title"] ?>"></a>
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

            <button class="main__button list__button"><a href="index.php?action=delTheme&id=<?= $themeID["idTheme"] ?>" type="submit" name="submit">Delete theme</a></button>

    </div>
</section>

<?php

$title = $themeID["typeName"];
$secondary_title = $themeID["typeName"];
$content = ob_get_clean();
require "view/template.php";
