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

        require "view/movies/addMovie.php";
    }
}