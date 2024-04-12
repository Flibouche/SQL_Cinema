<?php

namespace Controller;

use Model\Connect;

class ThemeController
{
    public function listThemes(): void
    {

        $pdo = Connect::toLogIn();
        $requestThemes = $pdo->query("
        SELECT theme.idTheme, theme.typeName
        FROM theme
        ORDER BY typeName
        ");

        require "view/themes/listThemes.php";
    }

    public function themesDetails(int $id): void
    {

        $pdo = Connect::toLogIn();
        $requestThemesDetails = $pdo->prepare("
        SELECT theme.idTheme, theme.typeName, movie.idMovie, movie.title
        FROM movie_theme
        INNER JOIN theme ON movie_theme.idTheme = theme.idTheme
        INNER JOIN movie ON movie_theme.idMovie = movie.idMovie
        WHERE theme.idTheme = :id
        ");
        $requestThemesDetails->execute(["id" => $id]);

        require "view/themes/themesDetails.php";
    }

    public function addTheme(): void
    {
        $pdo = Connect::toLogIn();
        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis

            // Récupération et filtrage des données du formulaire
            $theme = filter_input(INPUT_POST, "theme", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Récupère et filtre le nom du thème

            $requestAddTheme = $pdo->prepare("
                        INSERT INTO theme (typeName)
                        VALUES (:theme)
                        ");

            $requestAddTheme->execute(["theme" => $theme]);

            // Redirection vers la page 'index.php?action=addTheme' après le traitement du formulaire
            header("Location:index.php?action=addTheme");
        }

        require "view/themes/addTheme.php";
    }
}
