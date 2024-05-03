<?php

namespace Controller;

use Model\Connect; // Importation de la classe Connect depuis le namespace Model
use Service\Session;

class MainController
{

    // Méthode principale pour gérer la page d'accueil
    public function main()
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();
        $session = new Session();

        // Récupération d'un échantillon aléatoire de 10 films pour afficher sur la page d'accueil
        $requestMoviesMain = $pdo->query("
            SELECT movie.idMovie, movie.title, movie.releaseYear, movie.poster
            FROM movie
            ORDER BY RAND()
            LIMIT 10
        ");

        // Récupération d'un échantillon aléatoire de 4 acteurs pour afficher sur la page d'accueil
        $requestActorsMain = $pdo->query("
            SELECT actor.idActor, person.idPerson, person.firstname, person.surname, person.picture
            FROM actor
            INNER JOIN person ON actor.idPerson = person.idPerson
            ORDER BY RAND()
            LIMIT 4
        ");

        // Récupération d'un échantillon aléatoire de 4 réalisateurs pour afficher sur la page d'accueil
        $requestDirectorsMain = $pdo->query("
            SELECT director.idDirector, person.idPerson, person.firstname, person.surname, person.picture
            FROM director
            INNER JOIN person ON director.idPerson = person.idPerson
            ORDER BY RAND()
            LIMIT 4
        ");

        // Inclusion du fichier de vue pour afficher la page d'accueil avec les données récupérées
        require "view/main.php";
    }
}
