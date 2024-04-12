<?php

namespace Controller;

use Model\Connect;

class RoleController
{
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

    public function rolesDetails($id)
    {

        $pdo = Connect::toLogIn();
        $requestRolesDetails = $pdo->prepare("
        SELECT actor.idActor, movie.idMovie, movie.title, movie.releaseYear, person.firstname, person.surname, role.roleName
        FROM play
        INNER JOIN movie ON play.idMovie = movie.idMovie
        INNER JOIN role ON play.idRole = role.idRole
        INNER JOIN actor ON play.idActor = actor.idActor
        INNER JOIN person ON actor.idPerson = person.idPerson
        WHERE role.idRole = :id
        ");
        $requestRolesDetails->execute(["id" => $id]);

        require "view/roles/rolesDetails.php";
    }

    public function addRole(): void
    {

        $pdo = Connect::toLogIn();
        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis

            // Récupération et filtrage des données du formulaire
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Récupère et filtre le nom du thème

            $requestAddRole = $pdo->prepare("
                        INSERT INTO role (roleName)
                        VALUES (:role)
                        ");

            $requestAddRole->execute(["role" => $role]);

            // Redirection vers la page 'index.php?action=addRole' après le traitement du formulaire
            header("Location:index.php?action=addRole");
        }

        require "view/roles/addRole.php";
    }
}