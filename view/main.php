<?php ob_start();
?>

<section class="main section" id="main">
    <div class="main__container container grid">

        <h1>CineDune</h1>
        <img src="public/img/mainPlanet.gif" alt="Logo of CineDune">
        <h2>Welcome to CineDune</h2>
        <p>Are you lost in this tumult of information when you just wanted to know the cast of the movie you just watched ?<br> No problem, CineDune gets straight to the point !<br> And as a bonus, you can contribute to the site yourself !</p>

        <div class="swiper mySwiper container">
            <h2>Movies</h2>
            <div class="swiper-wrapper">
                <?php
                foreach ($requestMoviesMain->fetchAll() as $movie) {
                ?>
                    <div class="swiper-slide">
                        <a href="index.php?action=moviesDetails&id=<?= $movie["idMovie"] ?>"><img src="<?= $movie["poster"] ?>" alt=""></a>
                        <div class="movie-card__swiper">
                            <p><?= $movie["title"] . " (" . $movie["releaseYear"] . ")" ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="actors__main">
            <h2>Actors</h2>
            <div class="actor__card">
                <?php
                foreach ($requestActorsMain->fetchAll() as $actor) {
                ?>
                    <img src="<?= $actor["picture"] ?>">
                    <a href="index.php?action=actorsDetails&id=<?= $actor["idActor"] ?>"><?= $actor["firstname"] . " " . $actor["surname"] . "<br>" ?></a>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="directors__main">
            <h2>Directors</h2>
            <div class="director__card">
                <?php
                foreach ($requestDirectorsMain->fetchAll() as $director) {
                ?>
                    <img src="<?= $director["picture"] ?>">
                    <a href="index.php?action=directorsDetails&id=<?= $director["idDirector"] ?>"><?= $director["firstname"] . " " . $director["surname"] . "<br>" ?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php

$title = "Main";
$secondary_title = "Main";
$content = ob_get_clean();
require "template.php";
