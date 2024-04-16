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

            $requestAddMovie = $pdo->prepare("
            INSERT INTO movie (title, releaseYear, duration, note, synopsis, poster, idDirector)
            VALUES (:title, :releaseYear, :duration, :note, :synopsis, :poster, :idDirector)
            ");

            $requestAddMovie->execute([
                "title" => $title,
                "releaseYear" => $releaseYear,
                "duration" => $duration,
                "note" => $note,
                "synopsis" => $synopsis,
                "poster" => $poster,
                "idDirector" => $director
            ]);

            $movieId = $pdo->lastInsertId();

            foreach ($_POST['theme'] as $theme) {

                $theme = filter_var($theme, FILTER_VALIDATE_INT);

                $requestAddMovieTheme = $pdo->prepare("
                INSERT INTO movie_theme (idMovie, idTheme)
                VALUES(:idMovie, :idTheme)
                ");

                $requestAddMovieTheme->execute([
                    "idMovie" => $movieId,
                    "idTheme" => $theme
                ]);
            }

            // Redirection vers la page 'index.php?action=addMovie' après le traitement du formulaire
            header("Location:index.php?action=listMovies");
        }

        require "view/movies/addMovie.php";
    }

    public function editMovie($id)
    {

        $pdo = Connect::toLogIn();
        $requestMovie = $pdo->prepare("
        SELECT movie.idMovie, movie.title, movie.releaseYear, movie.duration, movie.note, movie.synopsis, movie.poster
        FROM movie
        WHERE movie.idMovie = :id
        ");
        $requestMovie->execute(["id" => $id]);

        if (isset($_POST['submit'])) {

            $newTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newReleaseYear = filter_input(INPUT_POST, "releaseYear", FILTER_VALIDATE_INT);
            $newDuration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $newNote = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $newSynopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $requestEditMovie = $pdo->prepare("
            UPDATE movie
            SET title = :title, releaseYear = :releaseYear, duration = :duration, note = :note, synopsis = :synopsis
            WHERE idMovie = :id
            ");
            $requestEditMovie->execute([
                "title" => $newTitle,
                "releaseYear" => $newReleaseYear,
                "duration" => $newDuration,
                "note" => $newNote,
                "synopsis" => $newSynopsis,
                "id" => $id
            ]);

            header("Location:index.php?action=editMovie&id=$id");
        }

        require "view/movies/editMovie.php";
    }

    public function addCasting($id)
    {

        $pdo = Connect::toLogIn();

        $requestCasting = $pdo->query("
        SELECT play.idMovie, play.idActor, play.idRole
        FROM play
        ");

        $requestMovies = $pdo->prepare("
        SELECT movie.idMovie, movie.title
        FROM movie
        WHERE movie.idMovie = :id
        ");
        $requestMovies->execute(["id" => $id]);

        $requestActors = $pdo->query("
        SELECT actor.idActor, person.firstname, person.surname
        FROM actor
        INNER JOIN person ON actor.idPerson = person.idPerson
        ORDER BY person.surname
        ");

        $requestRoles = $pdo->query("
        SELECT role.idRole, role.roleName
        FROM role
        ORDER BY role.roleName
        ");

        if (isset($_POST['submit'])) {

            $movie = filter_var($_POST['idMovie'], FILTER_VALIDATE_INT);
            $actor = filter_var($_POST['idActor'], FILTER_VALIDATE_INT);
            $role = filter_var($_POST['idRole'], FILTER_VALIDATE_INT);

            $requestAddCasting = $pdo->prepare("
            INSERT INTO play (idMovie, idActor, idRole)
            VALUES (:idMovie, :idActor, :idRole)
            ");

            $requestAddCasting->execute(["idMovie" => $movie, "idActor" => $actor, "idRole" => $role]);

            header("Location:index.php?action=addCasting&id=$id");
        }

        require "view/movies/addCasting.php";
    }
}
