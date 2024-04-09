<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requeteFilms = $pdo->query("
        SELECT *
        FROM movie
        ORDER BY releaseYear
        ");

        require "view/films/listFilms.php";
    }

    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requeteActeurs = $pdo->query("
        SELECT person.firstname, person.surname
        FROM actor
        INNER JOIN person ON actor.idPerson = person.idPerson
        ORDER BY surname
        ");

        require "view/acteurs/listActeurs.php";
    }

    public function listDirectors() {

        $pdo = Connect::seConnecter();
        $requeteDirectors = $pdo->query("
        SELECT person.firstname, person.surname
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        ORDER BY surname
        ");

        require "view/directors/listDirectors.php";
    }

    public function listRoles() {

        $pdo = Connect::seConnecter();
        $requeteRoles = $pdo->query("
        SELECT roleName
        FROM role
        ORDER BY roleName
        ");

        require "view/roles/listRoles.php";
    }

    public function listThemes() {

        $pdo = Connect::seConnecter();
        $requeteThemes = $pdo->query("
        SELECT typeName
        FROM theme
        ORDER BY typeName
        ");

        require "view/themes/listThemes.php";
    }

}