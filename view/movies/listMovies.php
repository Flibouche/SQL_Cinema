<?php ob_start();
$movies = $requestMovies->fetchAll();
?>

<section class="listMovies section" id="listMovies">
    <p>There's <?= $requestMovies->rowCount() ?> movies</p>
    <div class="listMovies__container container">

        <?php
        foreach ($movies as $movie) {
        ?>
            <figure class="movie__card-listMovies">

                <div class="card__header-listMovies">
                    <a href="index.php?action=moviesDetails&id=<?= $movie["idMovie"] ?>"><img src="<?= $movie["poster"] ?>" alt=""></a>
                </div>

                <div class="card__description-listMovies">
                    <a href="index.php?action=moviesDetails&id=<?= $movie["idMovie"] ?>"><span><?= $movie["title"] ?></span></a>
                    <p><?= $movie["releaseYear"] ?></p>
                </div>

            </figure>
        <?php
        }

        ?>
    </div>

    <button class="main__button list__button"><a href="index.php?action=addMovie">Add a movie</a></button>

</section>

<?php

$title = "Movies' List";
$secondary_title = "Movies' List";
$content = ob_get_clean();
require "view/template.php";
