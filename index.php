<?php

// Utilisation de l'espace de noms et inclusion des contrôleurs CinemaController et MainController
use Controller\CinemaController;
use Controller\MainController;

// Autoloading des classes pour charger automatiquement les fichiers de classe
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// Création d'une instance du contrôleur CinemaController
$ctrlCinema = new CinemaController();
// Création d'une instance du contrôleur MainController
$ctrlMain = new MainController();

// Récupération de l'ID et de l'action à partir des paramètres GET
$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type"])) ? $_GET["type"] : null;

// Exécution des actions en fonction de l'action spécifiée dans les paramètres GET
if(isset($_GET["action"])){
    switch ($_GET["action"]) {

        case "listMovies" : $ctrlCinema->listMovies(); break; // Affichage de la liste des films
        case "moviesDetails" : $ctrlCinema->moviesDetails($id); break; // Affichage des détails d'un film avec l'ID spécifié

        case "listActors" : $ctrlCinema->listActors(); break; // Affichage de la liste des acteurs
        case "actorsDetails" : $ctrlCinema->actorsDetails($id); break; // Affichage des détails d'un acteur avec l'ID spécifié

        case "listDirectors" : $ctrlCinema->listDirectors(); break; // Affichage de la liste des réalisateurs
        case "directorsDetails" : $ctrlCinema->directorsDetails($id); break; // Affichage des détails d'un réalisateur avec l'ID spécifié

        case "listRoles" : $ctrlCinema->listRoles(); break; // Affichage de la liste des rôles
        case "rolesDetails" : $ctrlCinema->rolesDetails($id); break; // Affichage des détails d'un rôle avec l'ID spécifié

        case "listThemes" : $ctrlCinema->listThemes(); break; // Affichage de la liste des thèmes
        case "themesDetails" : $ctrlCinema->themesDetails($id); break; // Affichage des détails d'un thème avec l'ID spécifié

    }
} else {
    $ctrlMain->main($id);
}