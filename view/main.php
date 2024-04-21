<?php ob_start();
?>

<section class="main section" id="main">
    <div class="main__background">

    </div>

    <div class="main__container container">

        <div class="main__home">
            <img class="main__gif" src="public/img/mainPlanet.gif" alt="Logo of CineDune">
            <h1 class="main__title"><?= $secondary_title = "CineDune" ?></h1>
            <h2>Welcome to CineDune</h2>
            <p>Are you lost in this tumult of information when you just wanted to know the cast of the movie you just watched ?<br> No problem, CineDune gets straight to the point !<br> And as a bonus, you can contribute to the site yourself !</p>
        </div>

        <div class="carouse__container">
            <div class="title-background__main">
                <h2>Movies</h2>
                <hr />
            </div>
            <div class="carousel-box">
                <div class="carousel">

                    <?php
                    foreach ($requestMoviesMain->fetchAll() as $movie) {
                    ?>
                        <div class="carousel-item">
                            <a href="index.php?action=moviesDetails&id=<?= $movie["idMovie"] ?>"><img src="<?= $movie["poster"] ?>" alt=""></a>
                            <div>
                                <p><?= $movie["title"] . " (" . $movie["releaseYear"] . ")" ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="indicators" indicators></div>
            </div>
        </div>


        <div class="swiper mySwiper">
            <div class="title-background__main">
                <h2>Movies</h2>
                <hr />
            </div>
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

        <section id="actors" class="actors section">
            <div class="title-background__main">
                <h2>Actors</h2>
                <hr />
            </div>
            <div class="actors__container container">

                <?php
                foreach ($requestActorsMain->fetchAll() as $actor) {
                ?>
                    <div class="actor__card">
                        <div class="actor__card-header">
                            <img src="<?= $actor["picture"] ?>">
                            <a href="index.php?action=actorsDetails&id=<?= $actor["idActor"] ?>"><?= $actor["firstname"] . " " . $actor["surname"] . "<br>" ?></a>
                        <?php
                    }
                        ?>
                        </div>
                    </div>
            </div>
        </section>


        <div class="directors__main">
            <div class="title-background__main">
                <h2>Directors</h2>
                <hr />
            </div>
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
$content = ob_get_clean();
require "template.php";
