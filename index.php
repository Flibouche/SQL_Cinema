<?php

// Utilisation de l'espace de noms et inclusion des contrôleurs
use Controller\MainController;
use Controller\MovieController;
use Controller\PersonController;
use Controller\ActorController;
use Controller\DirectorController;
use Controller\RoleController;
use Controller\ThemeController;

// Autoloading des classes pour charger automatiquement les fichiers de classe
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// Création des instances des différents contrôleurs
$ctrlMain = new MainController();
$ctrlMovie = new MovieController();
$ctrlPerson = new PersonController();
$ctrlActor = new ActorController();
$ctrlDirector = new DirectorController();
$ctrlRole = new RoleController();
$ctrlTheme = new ThemeController();


// Récupération de l'ID et de l'action à partir des paramètres GET
$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type"])) ? $_GET["type"] : null;

// Exécution des actions en fonction de l'action spécifiée dans les paramètres GET
if(isset($_GET["action"])){
    switch ($_GET["action"]) {

        case "listMovies" : $ctrlMovie->listMovies(); break; // Affichage de la liste des films
        case "moviesDetails" : $ctrlMovie->moviesDetails($id); break; // Affichage des détails d'un film avec l'ID spécifié
        case "addMovie" : $ctrlMovie->addMovie(); break;

        case "personsDetails" : $ctrlPerson->personsDetails($id); break;
        case "addPerson" : $ctrlPerson->addPerson($id); break;

        case "listActors" : $ctrlActor->listActors(); break; // Affichage de la liste des acteurs
        case "actorsDetails" : $ctrlActor->actorsDetails($id); break; // Affichage des détails d'un acteur avec l'ID spécifié

        case "listDirectors" : $ctrlDirector->listDirectors(); break; // Affichage de la liste des réalisateurs
        case "directorsDetails" : $ctrlDirector->directorsDetails($id); break; // Affichage des détails d'un réalisateur avec l'ID spécifié

        case "listRoles" : $ctrlRole->listRoles(); break; // Affichage de la liste des rôles
        case "rolesDetails" : $ctrlRole->rolesDetails($id); break; // Affichage des détails d'un rôle avec l'ID spécifié
        case "addRole" : $ctrlRole->addRole(); break;

        case "listThemes" : $ctrlTheme->listThemes(); break; // Affichage de la liste des thèmes
        case "themesDetails" : $ctrlTheme->themesDetails($id); break; // Affichage des détails d'un thème avec l'ID spécifié
        case "addTheme" : $ctrlTheme->addTheme(); break;

    }
} else {
    $ctrlMain->main();
}