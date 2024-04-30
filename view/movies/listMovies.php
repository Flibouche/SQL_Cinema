<?php ob_start();
$movies = $requestMovies->fetchAll();
?>

<section class="listMovies section" id="listMovies">
    <div class="listMovies__container container">


        <?php
        foreach ($movies as $movie) {
        ?>
            <figure class="movie__card-listMovies">

                <div class="card__header-listMovies">
                    <a href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>"><img src="<?= $movie["poster"] ?>" alt="Poster of <?= $movie["poster"] ?>" title="<?= $movie["title"] . " (" . $movie["releaseYear"] . ")" ?>"></a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>">
                            <p class="text-hover">By : <?= $movie["firstname"] . " " . $movie["surname"] ?></p>
                            <p class="text-hover"><?= $movie["note"] ?>/5</p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listMovies">
                    <a href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>"><span><?= $movie["title"] ?></span></a>
                    <p><?= $movie["releaseYear"] ?></p>
                </div>

            </figure>
        <?php
        }

        ?>
    </div>

    <?php
    if ($session->isAdmin()) { ?>
        <button class="main__button list__button"><a href="index.php?action=addMovie">Add a movie</a></button>
    <?php } ?>

</section>

<?php

$title = "Movies' List (" . $requestMovies->rowCount() . ")";
$secondary_title = "Movies' List (" . $requestMovies->rowCount() . ")";
$content = ob_get_clean();
require "view/template.php";
