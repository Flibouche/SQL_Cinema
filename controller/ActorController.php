<?php

namespace Controller;

use Model\Connect; // Importation de la classe Connect depuis le namespace Model

class ActorController
{
    // Méthode pour afficher la liste des acteurs
    public function listActors()
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Préparation et exécution de la requête SQL pour récupérer les informations sur les acteurs
        $requestActors = $pdo->query("
            SELECT person.idPerson, actor.idActor, person.firstname, person.surname, person.sex, person.birthdate
            FROM actor
            INNER JOIN person ON actor.idPerson = person.idPerson
            ORDER BY surname
        ");

        // Inclusion du fichier de vue pour afficher la liste des acteurs
        require "view/actors/listActors.php";
    }

    // Méthode pour afficher les détails d'un acteur
    public function actorsDetails($id)
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Préparation et exécution de la requête SQL pour récupérer les détails d'un acteur spécifique
        $requestActorsDetails = $pdo->prepare("
            SELECT person.idPerson, actor.idActor, person.firstname, person.surname, person.sex, person.birthdate, person.picture
            FROM actor
            INNER JOIN person ON actor.idPerson = person.idPerson
            WHERE actor.idActor = :id
        ");
        $requestActorsDetails->execute(["id" => $id]);
        
        // Préparation et exécution de la requête SQL pour récupérer la filmographie d'un acteur spécifique
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

        // Inclusion du fichier de vue pour afficher les détails de l'acteur ainsi que sa filmographie
        require "view/actors/actorsDetails.php";
    }
}
