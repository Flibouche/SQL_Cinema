<?php

namespace Controller;

use Model\Connect;

class CinemaController
{

    // ------------------- MOVIES -------------------

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
        SELECT actor.idActor, movie.idMovie, role.idRole, movie.title, person.firstname, person.surname, person.sex
        FROM play
        INNER JOIN movie ON play.idMovie = movie.idMovie
        INNER JOIN actor ON play.idActor = actor.idActor
        INNER JOIN person ON actor.idPerson = person.idPerson
        WHERE play.idMovie = :id
        ");
        $requestMoviesCasting->execute(["id" => $id]);

        require "view/movies/moviesDetails.php";
    }

    // ------------------- ACTORS -------------------

    public function listActors()
    {

        $pdo = Connect::toLogIn();
        $requestActors = $pdo->query("
        SELECT actor.idActor, person.idPerson, person.firstname, person.surname, person.sex, person.birthdate
        FROM actor
        INNER JOIN person ON actor.idPerson = person.idPerson
        ORDER BY surname
        ");

        require "view/actors/listActors.php";
    }

    public function actorsDetails($id)
    {

        $pdo = Connect::toLogIn();
        $requestActorsDetails = $pdo->prepare("
        SELECT actor.idActor, person.idPerson, person.firstname, person.surname, person.sex, person.birthdate
        FROM actor
        INNER JOIN person ON actor.idPerson = person.idPerson
        WHERE actor.idActor = :id
        ");
        $requestActorsDetails->execute(["id" => $id]);
        $requestActorsFilmography = $pdo->prepare("
        SELECT actor.idActor, movie.idMovie, movie.title, movie.releaseYear, person.firstname, person.surname, role.roleName
        FROM play
        INNER JOIN movie ON play.idMovie = movie.idMovie
        INNER JOIN role ON play.idRole = role.idRole
        INNER JOIN actor ON play.idActor = actor.idActor
        INNER JOIN person ON actor.idPerson = person.idPerson
        WHERE actor.idActor = :id
        ORDER BY releaseYear DESC
        ");
        $requestActorsFilmography->execute(["id" => $id]);

        require "view/actors/actorsDetails.php";
    }

    // ------------------- DIRECTORS -------------------

    public function listDirectors()
    {

        $pdo = Connect::toLogIn();
        $requestDirectors = $pdo->query("
        SELECT director.idDirector, person.firstname, person.surname, person.sex, person.birthdate
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        ORDER BY surname
        ");

        require "view/directors/listDirectors.php";
    }

    public function directorsDetails($id)
    {

        $pdo = Connect::toLogIn();
        $requestDirectorsDetails = $pdo->prepare("
        SELECT director.idDirector, person.idPerson, person.firstname, person.surname, person.sex, person.birthdate
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        WHERE director.idDirector = :id
        ");
        $requestDirectorsDetails->execute(["id" => $id]);
        $requestDirectorsFilmography = $pdo->prepare("
        SELECT director.idDirector, movie.idMovie, person.firstname, person.surname, movie.title, movie.releaseYear
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        INNER JOIN movie ON director.idDirector = movie.idDirector
        WHERE director.idDirector = :id
        ORDER BY movie.releaseYear DESC
        ");
        $requestDirectorsFilmography->execute(["id" => $id]);

        require "view/directors/directorsDetails.php";
    }

    // ------------------- ROLES -------------------

    public function listRoles()
    {

        $pdo = Connect::toLogIn();
        $requestRoles = $pdo->query("
        SELECT role.idRole, role.roleName
        FROM role
        ORDER BY roleName
        ");

        require "view/roles/listRoles.php";
    }

    // ------------------- THEMES -------------------

    public function listThemes()
    {

        $pdo = Connect::toLogIn();
        $requestThemes = $pdo->query("
        SELECT theme.idTheme, theme.typeName
        FROM theme
        ORDER BY typeName
        ");

        require "view/themes/listThemes.php";
    }
}
