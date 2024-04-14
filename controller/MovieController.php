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
            $releaseYear = filter_input(INPUT_POST, "releaseYear", FILTER_VALIDATE_INT);
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $poster = filter_input(INPUT_POST, "poster", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $director = filter_input(INPUT_POST, "idDirector", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $themes = filter_input(INPUT_POST, "idTheme", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $requestAddMovie = $pdo->prepare("
            INSERT INTO movie (title, releaseYear, duration, note, synopsis, poster, idDirector)
            VALUES (:title, :releaseYear, :duration, :note, :synopsis, :poster, :idDirector)
            ");

            $requestAddMovie->execute(["title" => $title, "releaseYear" => $releaseYear, "duration" => $duration, "note" => $note, "synopsis" => $synopsis, "poster" => $poster, "idDirector" => $director]);
            
            $movieId = $pdo->lastInsertId();
            
            $requestAddMovieTheme = $pdo->prepare("
            INSERT INTO movie_theme (idMovie, idTheme)
            VALUES(:idMovie, :idTheme)
            ");

            // foreach ($themes as $theme) {
                $requestAddMovieTheme->execute(["idMovie" => $movieId, "idTheme" => $themes]);
            // }
            
            // Redirection vers la page 'index.php?action=addMovie' après le traitement du formulaire
            header("Location:index.php?action=addMovie");
        }

        require "view/movies/addMovie.php";
    }
}
