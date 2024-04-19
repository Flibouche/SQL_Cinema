<?php

namespace Controller;

use Model\Connect; // Importation de la classe Connect depuis le namespace Model

class DirectorController
{
    // Méthode pour afficher la liste des réalisateurs
    public function listDirectors()
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Préparation et exécution de la requête SQL pour récupérer les informations sur les réalisateurs
        $requestDirectors = $pdo->query("
            SELECT director.idDirector, person.firstname, person.surname, person.sex, person.birthdate
            FROM director
            INNER JOIN person ON director.idPerson = person.idPerson
            ORDER BY surname
        ");

        // Inclusion du fichier de vue pour afficher la liste des réalisateurs
        require "view/directors/listDirectors.php";
    }

    // Méthode pour afficher les détails d'un réalisateur
    public function directorsDetails($id)
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Préparation et exécution de la requête SQL pour récupérer les détails d'un réalisateur spécifique
        $requestDirectorsDetails = $pdo->prepare("
            SELECT person.idPerson, director.idDirector, person.firstname, person.surname, person.sex, person.birthdate
            FROM director
            INNER JOIN person ON director.idPerson = person.idPerson
            WHERE director.idDirector = :id
        ");
        $requestDirectorsDetails->execute(["id" => $id]);
        
        // Préparation et exécution de la requête SQL pour récupérer la filmographie d'un réalisateur spécifique
        $requestDirectorsFilmography = $pdo->prepare("
            SELECT director.idDirector, movie.idMovie, person.firstname, person.surname, movie.title, movie.releaseYear
            FROM director
            INNER JOIN person ON director.idPerson = person.idPerson
            INNER JOIN movie ON director.idDirector = movie.idDirector
            WHERE director.idDirector = :id
            ORDER BY movie.releaseYear DESC
        ");
        $requestDirectorsFilmography->execute(["id" => $id]);

        // Inclusion du fichier de vue pour afficher les détails du réalisateur ainsi que sa filmographie
        require "view/directors/directorsDetails.php";
    }
}
