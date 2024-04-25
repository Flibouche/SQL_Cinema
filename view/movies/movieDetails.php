<?php ob_start();
$movieDetails = $requestmovieDetails->fetch();
$moviesCasting = $requestMoviesCasting->fetchAll();
?>

<section class="movieDetails section" id="listMovies">
    <div class="movieDetails__container container">

        <div class="movie__header-movieDetails">
            <div class="movie__poster-movieDetails">
                <img src="<?= $movieDetails["poster"] ?>" alt="Movie poster's of <?= $movieDetails["title"] ?>">
            </div>

            <div class="movie__edit-movieDetails">
                <a href="index.php?action=editMovie&id=<?= $movieDetails["idMovie"] ?>">
                    <i class="fa-solid fa-pencil"></i>
                </a>

                <a href="index.php?action=addCasting&id=<?= $movieDetails["idMovie"] ?>">
                    <i class="fa-solid fa-user-plus"></i>
                </a>

                <a id="delete-button" href="index.php?action=delMovie&id=<?= $movieDetails["idMovie"] ?>">
                    <i class="fa-solid fa-delete-left"></i>
                </a>
            </div>

        </div>

        <div class="movie__information-movieDetails">
            <h3><?= $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")" ?></h3>

            <div class="movie__themes-movieDetails">
                <?php
                foreach ($requestMovieThemes->fetchAll() as $themes) {
                    echo "Theme(s) : " . $themes["theme"] . "<br>";
                }
                ?>
            </div>

            <p>Duration : <?= $movieDetails["duration"] . " minutes" ?></p>

            <p>Note : <?= $movieDetails["note"] ?></p>

        </div>

        <hr>

        <div class="movie__description-movieDetails">

            <div id="synopsis" class="movie__synopsis-movieDetails">
                <h3>Synopsis :</h3>
                <p><?= $movieDetails["synopsis"] ?></p>
            </div>
            <div class="read-btn">
                <i id="read-more-btn" class="fa-solid fa-arrow-down"></i>
                <i id="read-less-btn" class="fa-solid fa-arrow-up"></i>
            </div>

        </div>

        <hr>

        <h3 id="movie__castingh3-movieDetails">Casting :</h3>
        <div class="movie__casting-movieDetails">
            <?php
            foreach ($moviesCasting as $movieCasting) {
            ?>
                <figure class="movie__castingcard-movieDetails">
                    <div class="castingcard__header-movieDetails">
                        <a href=href="index.php?action=personDetails&id=<?= $movieCasting["idPerson"] ?>"><img src="<?= $movieCasting["picture"] ?>" alt=""></a>
                    </div>

                    <div class="castingcard__description-movieDetails">
                        <a href="index.php?action=personDetails&id=<?= $movieCasting["idPerson"] ?>"><?= $movieCasting["firstname"] . " " . $movieCasting["surname"] ?></a>
                        <p>as <?= $movieCasting["roleName"] ?></p>
                    </div>

                    <div class="castingcard__edit-movieDetails">
                        <a onclick="checker()" class="delBtn" href="index.php?action=delCasting&id=<?= $movieCasting["idActor"] ?>"><i class="fa-solid fa-user-xmark"></i></a>
                    </div>

                </figure>
            <?php
            }
            ?>

        </div>

    </div>

    </div>

</section>




<?php

$title = "Movie's details";
$secondary_title = $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")";
$content = ob_get_clean();
require "view/template.php";
