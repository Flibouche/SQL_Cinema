<?php ob_start();
$movieDetails = $requestMovieDetails->fetch();
$moviesCasting = $requestMoviesCasting->fetchAll();
?>

<?php
if ($session->isAdmin()) { ?>
    <section class="modal hidden">
        <div class="flex">
            <button class="btn-close" aria-label="Close modal">
                <p>X</p>
            </button>
        </div>

        <div>
            <h3 aria-label="Confirmation message">Are you sure you want to delete this movie ?</h3>
        </div>

        <button class="main__button btn" aria-label="Delete this movie"><a href="index.php?action=delMovie&id=<?= $movieDetails["idMovie"] ?>">Yes</a></button>
        <button class="main__button btn-close2" aria-label="Don't delete this movie"><span>Nevermind</span></button>
    </section>

    <div class="overlay hidden"></div>
<?php } ?>

<section class="movieDetails section" id="listMovies">

    <div class="movieDetails__container container">

        <div class="movie__header-movieDetails">
            <div class="movie__poster-movieDetails">
                <img src="<?= $movieDetails["poster"] ?>" alt="Movie poster's of <?= $movieDetails["title"] ?>" aria-label="Movie poster" loading="lazy" />
            </div>
            <?php if ($session->isAdmin()) { ?>
                <div class="movie__edit-movieDetails">
                    <a href="index.php?action=editMovie&id=<?= $movieDetails["idMovie"] ?>">
                        <i class="fa-solid fa-pencil" aria-label="Edit movie"></i>
                    </a>

                    <a href="index.php?action=addCasting&id=<?= $movieDetails["idMovie"] ?>">
                        <i class="fa-solid fa-user-plus" aria-label="Add casting"></i>
                    </a>

                    <a id="delete-button" class="btn-openModal">
                        <i class="fa-solid fa-delete-left" aria-label="Delete movie"></i>
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="movie__information-movieDetails">
            <h3 aria-label="Details of <?= $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")" ?>"><?= $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")" ?></h3>

            <?php
            if (!$movieDetails["idPerson"] == null) {
            ?>
                <p>By : <a href="index.php?action=personDetails&id=<?= $movieDetails["idPerson"] ?>"><?= $movieDetails["firstname"] . " " . $movieDetails["surname"] ?></a></p>
            <?php
            } else {
            ?>
                <p>This movie does not have a director yet</p>
            <?php
            }
            ?>
            <div class="movie__themes-movieDetails">
                <?php
                foreach ($requestMovieThemes->fetchAll() as $themes) { ?>
                    <p>Theme(s) : <?= $themes["theme"] ?> </p>
                <?php
                }
                ?>
            </div>

            <p>Duration : <?= $movieDetails["duration"] . " minutes" ?></p>

            <p>Note : <?= $movieDetails["note"] ?></p>

        </div>

        <hr>

        <div class="movie__description-movieDetails">

            <?php
            if (!$movieDetails["synopsis"] == null) {
            ?>
                <div id="description" class="movie__synopsis-movieDetails">
                    <h3>Synopsis :</h3>
                    <p><?= $movieDetails["synopsis"] ?></p>
                </div>
                <div class="read-btn">
                    <i id="read-more-btn" class="fa-solid fa-arrow-down"></i>
                    <i id="read-less-btn" class="fa-solid fa-arrow-up"></i>
                </div>
            <?php
            } else {
            ?>
                <h3>Synopsis :</h3>
                <p>This movie does not have a synopsis yet</p>
            <?php
            }
            ?>

        </div>

        <hr>

        <h3 id="movie__castingh3-movieDetails">Casting :</h3>
        <div class="movie__casting-movieDetails">
            <?php
            if (!$moviesCasting == null) {
                foreach ($moviesCasting as $movieCasting) {
            ?>
                    <figure class="movie__castingcard-movieDetails" title="<?= $movieCasting["firstname"] . " " . $movieCasting["surname"] ?>">
                        <div class="castingcard__header-movieDetails">
                            <a href="index.php?action=personDetails&id=<?= $movieCasting["idPerson"] ?>"><img src="<?= $movieCasting["picture"] ?>" alt="<?= "Picture of " . $movieCasting["firstname"] . " " . $movieCasting["surname"] ?>" loading="lazy" /></a>
                        </div>
                        <div class="castingcard__description-movieDetails">
                            <a href="index.php?action=personDetails&id=<?= $movieCasting["idPerson"] ?>" aria-label="Details of <?= $movieCasting["firstname"] . " " . $movieCasting["surname"] ?>"><?= $movieCasting["firstname"] . " " . $movieCasting["surname"] ?></a>
                            <a href="index.php?action=roleDetails&id=<?= $movieCasting["idRole"] ?>">
                                <p title="<?= $movieCasting["roleName"] ?>">as <?= $movieCasting["roleName"] ?></p>
                            </a>
                        </div>
                        <?php if ($session->isAdmin()) { ?>
                            <div class="castingcard__edit-movieDetails">
                                <a class="delete-casting" href="index.php?action=delCasting&id=<?= $movieCasting["idActor"] ?>&idMovie=<?= $movieCasting["idMovie"] ?>">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </figure>
                <?php
                }
            } else {
                ?>
                <p>This movie does not have a casting yet</p>
            <?php
            }
            ?>

        </div>

    </div>

</section>

<?php

$title = $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")";
$metaDescription = "Discover the world of " . $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . "). Learn more about his director, themes, duration, note, synopsis and the cast.";
$secondary_title = $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>