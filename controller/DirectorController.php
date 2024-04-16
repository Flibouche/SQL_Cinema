<?php

namespace Controller;

use Model\Connect;

class DirectorController
{
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
        SELECT person.idPerson, director.idDirector, person.firstname, person.surname, person.sex, person.birthdate
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
}