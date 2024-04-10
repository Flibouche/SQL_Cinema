<?php

namespace Controller;

use Model\Connect;

class MainController
{

    // ------------------- MAIN -------------------

    public function main()
    {
        $pdo = Connect::toLogIn();
        $requestActorsMain = $pdo->query("
        SELECT actor.idActor, person.firstname, person.surname, person.picture
        FROM actor
        INNER JOIN person ON actor.idPerson = person.idPerson
        ORDER BY RAND()
        LIMIT 4
        ");

        $requestDirectorsMain = $pdo->query("
        SELECT director.idDirector, person.firstname, person.surname, person.picture
        FROM director
        INNER JOIN person on director.idPerson = person.idPerson
        ORDER BY RAND()
        LIMIT 4
        ");

        require "view/main.php";
    }

}
