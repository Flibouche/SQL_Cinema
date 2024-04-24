<?php

namespace Controller;

use Model\Connect; // Importation de la classe Connect depuis le namespace Model
use Model\Service;

class ThemeController
{
    // Méthode pour afficher la liste des thèmes
    public function listThemes(): void
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Exécution de la requête SQL pour récupérer les informations sur les thèmes
        $requestThemes = $pdo->query("
            SELECT theme.idTheme, theme.typeName
            FROM theme
            ORDER BY typeName
        ");

        // Inclusion du fichier de vue pour afficher la liste des thèmes
        require "view/themes/listThemes.php";
    }

    // Méthode pour afficher les détails d'un thème
    public function themeDetails(int $id): void
    {

        if (!Service::exists("theme", $id)) {
            header("Location:index.php?action=listThemes");
            exit;
        } else {

            // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
            $pdo = Connect::toLogIn();

            // Exécution de la requête SQL pour récupérer les détails d'un thème spécifique
            $requestthemeDetails = $pdo->prepare("
            SELECT theme.idTheme, theme.typeName, movie.idMovie, movie.title
            FROM movie_theme
            INNER JOIN theme ON movie_theme.idTheme = theme.idTheme
            INNER JOIN movie ON movie_theme.idMovie = movie.idMovie
            WHERE theme.idTheme = :id
        ");
            $requestthemeDetails->execute(["id" => $id]);

            // Exécution de la requête SQL pour récupérer l'ID du thème spécifique
            $requestThemeID = $pdo->prepare("
            SELECT theme.idTheme
            FROM theme
            WHERE theme.idTheme = :id
        ");
            $requestThemeID->execute(["id" => $id]);

            // Inclusion du fichier de vue pour afficher les détails du thème
            require "view/themes/themeDetails.php";
        }
    }

    // Méthode pour ajouter un nouveau thème
    public function addTheme(): void
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
            // Récupération et filtrage des données du formulaire
            $theme = filter_input(INPUT_POST, "theme", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Récupère et filtre le nom du thème

            // Exécution de la requête SQL pour ajouter le nouveau thème à la base de données
            $requestAddTheme = $pdo->prepare("
                INSERT INTO theme (typeName)
                VALUES (:theme)
            ");
            $requestAddTheme->execute(["theme" => $theme]);

            // Redirection vers la page 'index.php?action=addTheme' après le traitement du formulaire
            header("Location:index.php?action=addTheme");
        }

        // Inclusion du fichier de vue pour afficher le formulaire d'ajout de thème
        require "view/themes/addTheme.php";
    }

    // Méthode pour modifier un thème existant
    public function editTheme($id): void
    {

        if (!Service::exists("theme", $id)) {
            header("Location:index.php?action=listThemes");
            exit;
        } else {

            // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
            $pdo = Connect::toLogIn();

            // Exécution de la requête SQL pour récupérer les informations du thème à modifier
            $requestThemeID = $pdo->prepare("
            SELECT theme.idTheme, theme.typeName
            FROM theme
            WHERE idTheme = :id
        ");
            $requestThemeID->execute(["id" => $id]);

            if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
                // Récupération et filtrage des données du formulaire
                $newTypeName = filter_input(INPUT_POST, "typeName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Exécution de la requête SQL pour modifier le nom du thème dans la base de données
                $requestEditTheme = $pdo->prepare("
                UPDATE theme
                SET typeName = :typeName
                WHERE idTheme = :id
            ");
                $requestEditTheme->execute(["typeName" => $newTypeName, "id" => $id]);

                // Redirection vers la page 'index.php?action=listThemes' après la modification du thème
                header("Location:index.php?action=listThemes");
            }

            // Inclusion du fichier de vue pour afficher le formulaire de modification de thème
            require "view/themes/editTheme.php";
        }
    }

    // Méthode pour supprimer un thème
    public function delTheme($id): void
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Exécution de la requête SQL pour supprimer le thème de la base de données
        $requestDelTheme = $pdo->prepare("
            DELETE FROM theme
            WHERE idTheme = :id
        ");
        $requestDelTheme->execute(["id" => $id]);

        // Redirection vers la page 'index.php?action=listThemes' après la suppression du thème
        header("Location:index.php?action=listThemes");
    }
}
