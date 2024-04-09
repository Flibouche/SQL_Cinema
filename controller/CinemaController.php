<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public function listMovies() {

        $pdo = Connect::toLogIn();
        $requestMovies = $pdo->query("
        SELECT *
        FROM movie
        ORDER BY releaseYear
        ");

        require "view/movies/listMovies.php";
    }

    public function listActors() {

        $pdo = Connect::toLogIn();
        $requestActors = $pdo->query("
        SELECT person.firstname, person.surname
        FROM actor
        INNER JOIN person ON actor.idPerson = person.idPerson
        ORDER BY surname
        ");

        require "view/actors/listActors.php";
    }

    public function listDirectors() {

        $pdo = Connect::toLogIn();
        $requestDirectors = $pdo->query("
        SELECT person.firstname, person.surname
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        ORDER BY surname
        ");

        require "view/directors/listDirectors.php";
    }

    public function listRoles() {

        $pdo = Connect::toLogIn();
        $requestRoles = $pdo->query("
        SELECT roleName
        FROM role
        ORDER BY roleName
        ");

        require "view/roles/listRoles.php";
    }

    public function listThemes() {

        $pdo = Connect::toLogIn();
        $requestThemes = $pdo->query("
        SELECT typeName
        FROM theme
        ORDER BY typeName
        ");

        require "view/themes/listThemes.php";
    }

}