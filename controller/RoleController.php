<?php

namespace Controller;

use Model\Connect; // Importation de la classe Connect depuis le namespace Model
use Model\Service;

class RoleController
{
    // Méthode pour afficher la liste des rôles
    public function listRoles()
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Exécution de la requête SQL pour récupérer les informations sur les rôles
        $requestRoles = $pdo->query("
            SELECT role.idRole, role.roleName
            FROM role
            ORDER BY roleName
        ");

        // Inclusion du fichier de vue pour afficher la liste des rôles
        require "view/roles/listRoles.php";
    }

    // Méthode pour afficher les détails d'un rôle
    public function roleDetails($id)
    {

        if (!Service::exists("role", $id)) {
            header("Location:index.php?action=listRoles");
            exit;
        } else {

            // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
            $pdo = Connect::toLogIn();

            // Exécution de la requête SQL pour récupérer les détails d'un rôle spécifique
            $requestRoleDetails = $pdo->prepare("
            SELECT person.idPerson, role.idRole, actor.idActor, movie.idMovie, movie.title, movie.releaseYear, person.firstname, person.surname, person.picture, role.roleName
            FROM play
            INNER JOIN movie ON play.idMovie = movie.idMovie
            INNER JOIN role ON play.idRole = role.idRole
            INNER JOIN actor ON play.idActor = actor.idActor
            INNER JOIN person ON actor.idPerson = person.idPerson
            WHERE role.idRole = :id
        ");
            $requestRoleDetails->execute(["id" => $id]);

            // Exécution de la requête SQL pour récupérer l'ID du rôle spécifique
            $requestRoleID = $pdo->prepare("
            SELECT role.idRole, role.roleName
            FROM role
            WHERE role.idRole = :id
        ");
            $requestRoleID->execute(["id" => $id]);

            // Inclusion du fichier de vue pour afficher les détails du rôle
            require "view/roles/roleDetails.php";
        }
    }

    // Méthode pour ajouter un nouveau rôle
    public function addRole(): void
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
            // Récupération et filtrage des données du formulaire
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Récupère et filtre le nom du rôle

            // Exécution de la requête SQL pour ajouter le nouveau rôle à la base de données
            $requestAddRole = $pdo->prepare("
                INSERT INTO role (roleName)
                VALUES (:role)
            ");
            $requestAddRole->execute(["role" => $role]);

            // Redirection vers la page 'index.php?action=addRole' après le traitement du formulaire
            header("Location:index.php?action=addRole");
            exit;
        }

        // Inclusion du fichier de vue pour afficher le formulaire d'ajout de rôle
        require "view/roles/addRole.php";
    }

    // Méthode pour modifier un rôle existant
    public function editRole($id)
    {

        if (!Service::exists("role", $id)) {
            header("Location:index.php?action=listRoles");
            exit;
        } else {

            // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
            $pdo = Connect::toLogIn();

            // Exécution de la requête SQL pour récupérer les informations du rôle à modifier
            $requestRoleID = $pdo->prepare("
            SELECT role.idRole, role.roleName
            FROM role
            WHERE idRole = :id
        ");
            $requestRoleID->execute(["id" => $id]);

            if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
                // Récupération et filtrage des données du formulaire
                $newRoleName = filter_input(INPUT_POST, "roleName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Exécution de la requête SQL pour modifier le nom du rôle dans la base de données
                $requestEditRole = $pdo->prepare("
                UPDATE role
                SET roleName = :roleName
                WHERE idRole = :id
            ");
                $requestEditRole->execute(["roleName" => $newRoleName, "id" => $id]);

                // Redirection vers la page 'index.php?action=listRoles' après la modification du rôle
                header("Location:index.php?action=listRoles");
                exit;
            }

            // Inclusion du fichier de vue pour afficher le formulaire de modification de rôle
            require "view/roles/editRole.php";
        }
    }

    // Méthode pour supprimer un rôle
    public function delRole($id)
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Exécution de la requête SQL pour supprimer le rôle de la base de données
        $requestDelRole = $pdo->prepare("
            DELETE FROM role
            WHERE idRole = :id
        ");
        $requestDelRole->execute(["id" => $id]);

        // Redirection vers la page 'index.php?action=listRoles' après la suppression du rôle
        header("Location: index.php?action=listRoles");
        exit;
    }
}
?>