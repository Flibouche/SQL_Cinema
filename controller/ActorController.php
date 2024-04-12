<?php

namespace Controller;

use Model\Connect;

class ActorController
{
    public function listActors()
    {

        $pdo = Connect::toLogIn();
        $requestActors = $pdo->query("
        SELECT actor.idActor, person.firstname, person.surname, person.sex, person.birthdate
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
        SELECT actor.idActor, person.firstname, person.surname, person.sex, person.birthdate
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

    public function addActor(): void
    {

        require "view/actors/addActor.php";
    }
}