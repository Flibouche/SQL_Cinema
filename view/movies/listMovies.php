<?php ob_start();
$movies = $requestMovies->fetchAll();
?>

<section class="listMovies section" id="listMovies">

    <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search for a movie.." title="Type in a name">

    <div class="listMovies__container container">


        <?php
        foreach ($movies as $movie) {
        ?>
            <figure class="movie__card-listMovies" title="<?= $movie["title"] . " (" . $movie["releaseYear"] . ")" ?>">

                <div id="test" class="card__header-listMovies">
                    <a class="test2" href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>"><img src="<?= $movie["poster"] ?>" alt="Poster of <?= $movie["title"] ?>"></a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>">
                            <p class="text-hover">By : <?= $movie["firstname"] . " " . $movie["surname"] ?></p>
                            <p class="text-hover"><?= $movie["note"] ?>/5</p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listMovies">
                    <a href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>"><span><?= $movie["title"] ?></span></a>
                    <a href="index.php?action=movieDetails&id=<?= $movie["idMovie"] ?>"><p><?= $movie["releaseYear"] ?></p></a>
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

<script>
    // Tuto W3Schools
    // Fonction pour filtrer les films en fonction de leur titre
    function myFunction() {
        // Récupère la valeur saisie dans l'input de recherche
        var input, filter, container, figure, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        container = document.getElementsByClassName("listMovies__container")[0];
        figure = container.getElementsByTagName("figure");

        // Parcourt chaque figure (chaque film) dans la liste
        for (i = 0; i < figure.length; i++) {
            title = figure[i].getElementsByTagName("span")[0];
            // Si le titre du film correspond à la recherche, affiche le film, sinon le cache
            if (title) {
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    figure[i].style.display = "";
                } else {
                    figure[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php

$title = "Movies' List (" . $requestMovies->rowCount() . ")";
$metaDescription = "Here is the list of the different movie(s). There are currently " . $requestMovies->rowCount() . " movie(s) in our database.";
$secondary_title = "Movies' List (" . $requestMovies->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>