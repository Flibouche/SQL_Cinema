<?php

namespace Controller;

use Model\Connect;

class MovieController
{
    public function listMovies()
    {

        $pdo = Connect::toLogIn();
        $requestMovies = $pdo->query("
        SELECT movie.idMovie, movie.title, movie.releaseYear, movie.duration, movie.note, movie.synopsis, movie.poster
        FROM movie
        ORDER BY releaseYear
        ");

        require "view/movies/listMovies.php";
    }

    public function moviesDetails($id)
    {

        $pdo = Connect::toLogIn();
        $requestMoviesDetails = $pdo->prepare("
        SELECT movie.idMovie, movie.title, movie.releaseYear, movie.duration, movie.note, movie.synopsis, movie.poster
        FROM movie
        WHERE movie.idMovie = :id
        ");
        $requestMoviesDetails->execute(["id" => $id]);

        $requestMoviesCasting = $pdo->prepare("
        SELECT actor.idActor, movie.idMovie, role.idRole, role.roleName, movie.title, person.firstname, person.surname, person.sex
        FROM play
        INNER JOIN movie ON play.idMovie = movie.idMovie
        INNER JOIN actor ON play.idActor = actor.idActor
        INNER JOIN role ON play.idRole = role.idRole
        INNER JOIN person ON actor.idPerson = person.idPerson
        WHERE play.idMovie = :id
        ");
        $requestMoviesCasting->execute(["id" => $id]);

        require "view/movies/moviesDetails.php";
    }

    public function addMovie(): void
    {
        $pdo = Connect::toLogIn();

        $requestDirectors = $pdo->query("
        SELECT director.idDirector, person.firstname, person.surname
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        ORDER BY surname
        ");

        $requestThemes = $pdo->query("
        SELECT theme.idTheme, theme.typeName
        FROM theme
        ORDER BY typeName
        ");

        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $releaseYear = filter_input(INPUT_POST, "releaseyear", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $poster = filter_input(INPUT_POST, "poster", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $director = filter_input(INPUT_POST, "director", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $theme = filter_input(INPUT_POST, "theme", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $requestAddMovie = $pdo->prepare("
            INSERT INTO movie (title, releaseYear, duration, note, poster)
            VALUES (:title, :releaseyear, :duration, :note, :poster)
            ");

            $requestAddMovie->execute(["title" => $title, "releaseYear" => $releaseYear, "duration" => $duration, "note" => $note, "poster" => $poster]);

            $movieId = $pdo->lastInsertId();

            $requestAddDirectorToMovie= $pdo->prepare("
            INSERT INTO movie (idDirector)
            VALUES (:idDirector, :idMovie)            
            ");
            $requestAddDirectorToMovie->execute(["idDirector" => $director, "idMovie" => $movieId]);

            // Redirection vers la page 'index.php?action=addMovie' après le traitement du formulaire
            header("Location:index.php?action=addMovie");
        }

        require "view/movies/addMovie.php";
    }
}
