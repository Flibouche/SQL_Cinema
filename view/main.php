<?php ob_start();
?>

<section class="main section" id="main">
    <div class="main__background"></div>

    <div class="main__container container">

        <div class="main__home">
            <img class="main__gif" src="public/img/mainPlanet-resize.gif" alt="Logo of CineDune">
            <h1 class="main__title"><?= $secondary_title = "CinEDunE" ?></h1>
        </div>

        <div class="main__description">
            <h3>Welcome to <span class="main__span">CineDune<span></h3>
            <p>Are you lost in this tumult of information when you just wanted to know the cast of the movie you just watched ?<br> No problem, CineDune gets straight to the point !<br> And as a bonus, you can contribute to the site yourself !</p>
        </div>
    </div>
</section>

<div class="main__separator">
    <hr />
</div>

<section class="slider section" id="carousel">
    <div class="carousel__container container">
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
                        <!-- <div>
                            <p><?= $movie["title"] . " (" . $movie["releaseYear"] . ")" ?></p>
                        </div> -->
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="carousel__background">
                <svg width="953" height="70" viewBox="0 0 953 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M953 16.3685L946.911 14.0891C940.558 11.9438 928.381 7.38517 915.409 8.32372C902.703 9.26227 889.467 15.4299 876.76 17.0388C863.789 18.6478 851.611 15.4299 838.64 11.2735C825.933 6.98293 812.697 1.61977 799.991 0.681221C787.019 -0.123253 774.842 3.3628 762.4 10.0667C749.958 16.7707 737.781 26.6925 724.809 28.0333C712.103 29.3741 698.867 22.1338 686.16 19.4523C673.189 16.7707 661.011 18.6478 648.04 16.1003C635.333 13.6869 622.097 6.98293 609.391 9.26227C596.419 11.4075 584.242 22.6702 571.8 23.4746C559.358 24.4132 547.181 15.0277 534.209 11.4075C521.503 7.92148 508.267 10.0667 495.56 8.99411C482.589 7.92148 470.411 3.3628 457.44 2.96056C444.733 2.55833 431.497 6.04438 418.791 7.92148C405.819 9.66451 393.642 9.66451 381.2 12.6142C368.758 15.4299 356.581 21.3294 343.609 19.9886C330.903 18.6478 317.667 10.0667 304.96 4.97175C291.989 -0.123253 279.811 -2.00036 266.84 2.69241C254.133 7.38517 240.897 18.6478 228.191 20.7931C215.219 23.0724 203.042 16.3685 190.6 11.6757C178.158 6.98293 165.981 4.30135 153.009 8.59188C140.303 12.7483 127.067 24.0109 114.36 24.8154C101.389 25.754 89.2114 16.3685 76.2399 13.2846C63.5333 10.0667 50.2972 13.2846 37.5906 13.2846C24.6192 13.2846 12.4419 10.0667 6.08856 8.59188L0 6.98293V70H6.08856C12.4419 70 24.6192 70 37.5906 70C50.2972 70 63.5333 70 76.2399 70C89.2114 70 101.389 70 114.36 70C127.067 70 140.303 70 153.009 70C165.981 70 178.158 70 190.6 70C203.042 70 215.219 70 228.191 70C240.897 70 254.133 70 266.84 70C279.811 70 291.989 70 304.96 70C317.667 70 330.903 70 343.609 70C356.581 70 368.758 70 381.2 70C393.642 70 405.819 70 418.791 70C431.497 70 444.733 70 457.44 70C470.411 70 482.589 70 495.56 70C508.267 70 521.503 70 534.209 70C547.181 70 559.358 70 571.8 70C584.242 70 596.419 70 609.391 70C622.097 70 635.333 70 648.04 70C661.011 70 673.189 70 686.16 70C698.867 70 712.103 70 724.809 70C737.781 70 749.958 70 762.4 70C774.842 70 787.019 70 799.991 70C812.697 70 825.933 70 838.64 70C851.611 70 863.789 70 876.76 70C889.467 70 902.703 70 915.409 70C928.381 70 940.558 70 946.911 70H953V16.3685Z" fill="url(#paint0_linear_128_356)" fill-opacity="0.5" />
                    <defs>
                        <linearGradient id="paint0_linear_128_356" x1="476.493" y1="-4.24431e-06" x2="476.547" y2="70" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#A2520D" />
                            <stop offset="1" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        <button class="main__buttons"><a href="index.php?action=listMovies">See All Movies</a></button>
    </div>
</section>

<div class="main__separator">
    <hr />
</div>

<section class="actors section" id="actors">
    <div class="actors__container container">
        <div class="title-background__main">
            <h2>Actors</h2>
            <hr />
        </div>
        <div class="actors__content">
            <?php
            foreach ($requestActorsMain->fetchAll() as $actor) {
            ?>
                <figure class="actor__card">
                    <img src="<?= $actor["picture"] ?>">
                    <figcaption class="actor__figcaption" href="index.php?action=actorsDetails&id=<?= $actor["idActor"] ?>"><?= $actor["firstname"] . " " . $actor["surname"] . "<br>" ?></figcaption>
                </figure>
            <?php
            }
            ?>
        </div>
        <div class="actors__background">
            <svg width="953" height="70" viewBox="0 0 953 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M953 16.3685L946.911 14.0891C940.558 11.9438 928.381 7.38517 915.409 8.32372C902.703 9.26227 889.467 15.4299 876.76 17.0388C863.789 18.6478 851.611 15.4299 838.64 11.2735C825.933 6.98293 812.697 1.61977 799.991 0.681221C787.019 -0.123253 774.842 3.3628 762.4 10.0667C749.958 16.7707 737.781 26.6925 724.809 28.0333C712.103 29.3741 698.867 22.1338 686.16 19.4523C673.189 16.7707 661.011 18.6478 648.04 16.1003C635.333 13.6869 622.097 6.98293 609.391 9.26227C596.419 11.4075 584.242 22.6702 571.8 23.4746C559.358 24.4132 547.181 15.0277 534.209 11.4075C521.503 7.92148 508.267 10.0667 495.56 8.99411C482.589 7.92148 470.411 3.3628 457.44 2.96056C444.733 2.55833 431.497 6.04438 418.791 7.92148C405.819 9.66451 393.642 9.66451 381.2 12.6142C368.758 15.4299 356.581 21.3294 343.609 19.9886C330.903 18.6478 317.667 10.0667 304.96 4.97175C291.989 -0.123253 279.811 -2.00036 266.84 2.69241C254.133 7.38517 240.897 18.6478 228.191 20.7931C215.219 23.0724 203.042 16.3685 190.6 11.6757C178.158 6.98293 165.981 4.30135 153.009 8.59188C140.303 12.7483 127.067 24.0109 114.36 24.8154C101.389 25.754 89.2114 16.3685 76.2399 13.2846C63.5333 10.0667 50.2972 13.2846 37.5906 13.2846C24.6192 13.2846 12.4419 10.0667 6.08856 8.59188L0 6.98293V70H6.08856C12.4419 70 24.6192 70 37.5906 70C50.2972 70 63.5333 70 76.2399 70C89.2114 70 101.389 70 114.36 70C127.067 70 140.303 70 153.009 70C165.981 70 178.158 70 190.6 70C203.042 70 215.219 70 228.191 70C240.897 70 254.133 70 266.84 70C279.811 70 291.989 70 304.96 70C317.667 70 330.903 70 343.609 70C356.581 70 368.758 70 381.2 70C393.642 70 405.819 70 418.791 70C431.497 70 444.733 70 457.44 70C470.411 70 482.589 70 495.56 70C508.267 70 521.503 70 534.209 70C547.181 70 559.358 70 571.8 70C584.242 70 596.419 70 609.391 70C622.097 70 635.333 70 648.04 70C661.011 70 673.189 70 686.16 70C698.867 70 712.103 70 724.809 70C737.781 70 749.958 70 762.4 70C774.842 70 787.019 70 799.991 70C812.697 70 825.933 70 838.64 70C851.611 70 863.789 70 876.76 70C889.467 70 902.703 70 915.409 70C928.381 70 940.558 70 946.911 70H953V16.3685Z" fill="url(#paint0_linear_128_356)" fill-opacity="0.5" />
                <defs>
                    <linearGradient id="paint0_linear_128_356" x1="476.493" y1="-4.24431e-06" x2="476.547" y2="70" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#A2520D" />
                        <stop offset="1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <button class="main__buttons"><a href="index.php?action=listActors">See All Actors</a></button>
    </div>
</section>

<div class="main__separator">
    <hr />
</div>

<section class="directors section" id="directors">
    <div class="directors__container container">
        <div class="title-background__main">
            <h2>Directors</h2>
            <hr />
        </div>
        <div class="directors__content">
            <?php
            foreach ($requestDirectorsMain->fetchAll() as $director) {
            ?>
                <div class="director__card">
                    <img src="<?= $director["picture"] ?>">
                    <a href="index.php?action=directorsDetails&id=<?= $director["idDirector"] ?>"><?= $director["firstname"] . " " . $director["surname"] . "<br>" ?></a>
                <?php
            }
                ?>
                </div>
        </div>
        <button class="main__buttons"><a href="index.php?action=listDirectors">See All Directors</a></button>
    </div>
</section>

<?php

$title = "Main";
$content = ob_get_clean();
require "template.php";
