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
        ORDER BY releaseYear DESC
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

        $requestMovieThemes = $pdo->prepare("
        SELECT GROUP_CONCAT(theme.typeName SEPARATOR ', ') AS theme
        FROM movie_theme
        INNER JOIN theme ON movie_theme.idTheme = theme.idTheme
        INNER JOIN movie ON movie_theme.idMovie = movie.idMovie
        WHERE movie.idMovie = :id
        ");
        $requestMovieThemes->execute(["id" => $id]);

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
            $director = filter_input(INPUT_POST, "idDirector", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $type = $_FILES['file']['type'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                // Tableau des extensions qu'on autorise
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'webp'];
                $maxSize = 100000;

                if (in_array($extension, $allowedExtensions) && $size <= $maxSize && $error == 0) {

                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . '.' . $extension;

                    move_uploaded_file($tmpName, "./public/img/movies/" . $file);
                } else {
                    echo "Wrong extension or file size too large or error !";
                }
            }

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
                "poster" => "public/img/movies/" . $file,
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

            // Redirection vers la page 'index.php?action=listMovies' après le traitement du formulaire
            header("Location:index.php?action=listMovies");
        }

        require "view/movies/addMovie.php";
    }

    public function editMovie($id)
    {

        $pdo = Connect::toLogIn();
        $requestMovie = $pdo->prepare("
        SELECT movie.idMovie, movie.title, movie.releaseYear, movie.duration, movie.note, movie.synopsis, movie.poster, movie.idDirector
        FROM movie
        WHERE movie.idMovie = :id
        ");
        $requestMovie->execute(["id" => $id]);

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

        $requestMovieThemes = $pdo->prepare("
        SELECT theme.idTheme
        FROM movie_theme
        INNER JOIN theme ON movie_theme.idTheme = theme.idTheme
        INNER JOIN movie ON movie_theme.idMovie = movie.idMovie
        WHERE movie.idMovie = :id
        ");
        $requestMovieThemes->execute(["id" => $id]);

        $themes = $requestMovieThemes->fetchAll();
        $themesMovie = [];
        foreach ($themes as $t) {
            $themesMovie[] = $t["idTheme"];
        }

        if (isset($_POST['submit'])) {

            $newTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newReleaseYear = filter_input(INPUT_POST, "releaseYear", FILTER_VALIDATE_INT);
            $newDuration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $newNote = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $newSynopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newDirector = filter_input(INPUT_POST, "idDirector", FILTER_SANITIZE_NUMBER_INT);

            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $type = $_FILES['file']['type'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                // Tableau des extensions qu'on autorise
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'webp'];
                $maxSize = 1000000;

                if (in_array($extension, $allowedExtensions) && $size <= $maxSize && $error == 0) {

                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . '.' . $extension;

                    $requestPoster = $pdo->prepare("
                    SELECT movie.poster
                    FROM movie
                    WHERE movie.idMovie = :id
                    ");
                    $requestPoster->execute(["id" => $id]);

                    // Permet de récupérer l'image du poster du film et de la supprimer en passant par la variable et le tableau "poster", autrement on pourrait faire une variable pour récupérer directement le tableau
                    $linkPoster = $requestPoster->fetch();
                    
                    if ($linkPoster) {
                        unlink($linkPoster['poster']);
                    }

                    move_uploaded_file($tmpName, "./public/img/movies/" . $file);
                    $requestNewPoster = $pdo->prepare("
                    UPDATE movie
                    SET poster = :poster
                    WHERE idMovie = :id
                    ");

                    $requestNewPoster->execute([
                        "poster" => "public/img/movies/" . $file,
                        "id" => $id
                    ]);
                } else {
                    echo "Wrong extension or file size too large or error !";
                }
            }

            $requestEditMovie = $pdo->prepare("
            UPDATE movie
            SET title = :title, releaseYear = :releaseYear, duration = :duration, note = :note, synopsis = :synopsis, idDirector = :idDirector
            WHERE idMovie = :id
            ");
            $requestEditMovie->execute([
                "title" => $newTitle,
                "releaseYear" => $newReleaseYear,
                "duration" => $newDuration,
                "note" => $newNote,
                "synopsis" => $newSynopsis,
                "idDirector" => $newDirector,
                "id" => $id
            ]);

            $theme = filter_input(INPUT_POST, "idTheme", FILTER_VALIDATE_INT);

            $requestPurgeMovieTheme = $pdo->prepare("
            DELETE FROM movie_theme
            WHERE idMovie = :idMovie
            ");

            $requestPurgeMovieTheme->execute([
                "idMovie" => $id
            ]);

            foreach ($_POST['theme'] as $theme) {

                $requestEditMovieTheme = $pdo->prepare("
                INSERT INTO movie_theme (idMovie, idTheme)
                VALUES(:idMovie, :idTheme)
                ");

                $requestEditMovieTheme->execute([
                    "idMovie" => $id,
                    "idTheme" => $theme
                ]);
            }

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

            header("Location:index.php?action=moviesDetails&id=$id");
        }

        require "view/movies/addCasting.php";
    }

    public function delCasting($id)
    {

        $pdo = Connect::toLogIn();

        $requestMovie = $pdo->prepare("
        SELECT play.idMovie
        FROM play
        WHERE idActor = :id
        ");
        $requestMovie->execute(["id" => $id]);
        $idMovie = $requestMovie->fetchColumn();

        $requestDelCasting = $pdo->prepare("
            DELETE FROM play
            WHERE play.idActor = :id
        ");
        $requestDelCasting->execute(["id" => $id]);

        header("Location:index.php?action=moviesDetails&id=$idMovie");
    }

    public function delMovie($id)
    {

        $pdo = Connect::toLogIn();

        $requestDelMovieTheme = $pdo->prepare("
        DELETE FROM movie_theme
        WHERE idMovie = :id;
        ");
        $requestDelMovieTheme->execute(["id" => $id]);

        $requestDelCasting = $pdo->prepare("
        DELETE FROM play
        WHERE idMovie = :id;
        ");
        $requestDelCasting->execute(["id" => $id]);

        $requestDelMovie = $pdo->prepare("
        DELETE FROM movie
        WHERE idMovie = :id;
        ");
        $requestDelMovie->execute(["id" => $id]);

        header("Location:index.php?action=listMovies");
    }
}
