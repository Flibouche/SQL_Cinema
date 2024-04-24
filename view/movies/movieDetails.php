<?php ob_start();
$movieDetails = $requestmovieDetails->fetch();
$moviesCasting = $requestMoviesCasting->fetchAll();
?>

<section class="movieDetails section" id="listMovies">
    <div class="movieDetails__container container">

        <div class="movie__info-movieDetails">
            <div class="movie__poster-movieDetails">
                <img src="<?= $movieDetails["poster"] ?>" alt="Movie poster's of <?= $movieDetails["title"] ?>">
            </div>
            <div class="movie__edit-movieDetails">

                <a href="index.php?action=editMovie&id=<?= $movieDetails["idMovie"] ?>">
                    <i class="fa-solid fa-pencil"></i>
                </a>

                <a href="index.php?action=addCasting&id=<?= $movieDetails["idMovie"] ?>">
                    <i class="fa-solid fa-people-group"></i>
                </a>

                <a href="index.php?action=editCasting&id=<?= $movieDetails["idMovie"] ?>">
                    <i class="fa-solid fa-user-pen"></i>
                </a>



            </div>
        </div>

        <div class="movie__description-movieDetails">
            <h3>Synopsis</h3>
            <p><?= $movieDetails["synopsis"] ?></p>
        </div>

        <?php
        echo $movieDetails["title"] . " " . $movieDetails["releaseYear"] . " " . $movieDetails["duration"] . " " . $movieDetails["note"] . " " . $movieDetails["synopsis"] . "<br>";

        foreach ($requestMovieThemes->fetchAll() as $themes) {
            echo "Theme(s) : " . $themes["theme"] . "<br>";
        }

        foreach ($moviesCasting as $movieCasting) {
        ?>
            <a href=" index.php?action=personDetails&id=<?= $movieCasting["idPerson"] ?>"><?= $movieCasting["firstname"] . " " . $movieCasting["surname"] ?></a> as <?= $movieCasting["roleName"] ?>
            <a class="delBtn" href="index.php?action=delCasting&id=<?= $movieCasting["idActor"] ?>"><i class="fa-solid fa-xmark"></i></a><br>
        <?php
        }
        ?>


    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <button class="main__button list__button"><a onclick="checker()" href="index.php?action=delMovie&id=<?= $movieDetails["idMovie"] ?>">Delete this movie</a></button>

</section>

<script>
    function checker() {
        var result = confirm('Are you sure ?');
        if (result == false) {
            event.preventDefault();
        }
    }
</script>

<?php

$title = "Movie's details";
$secondary_title = $movieDetails["title"] . " (" . $movieDetails["releaseYear"] . ")";
$content = ob_get_clean();
require "view/template.php";
