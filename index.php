<?php

session_start();

// Utilisation de l'espace de noms et inclusion des contrôleurs
use Controller\MainController;
use Controller\MovieController;
use Controller\PersonController;
use Controller\RoleController;
use Controller\ThemeController;
use Controller\SubmissionController;
use Controller\SecurityController;
use Service\Session;

// Autoloading des classes pour charger automatiquement les fichiers de classe
spl_autoload_register(function ($class_name) {
    include str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . '.php';
});

// Création des instances des différents contrôleurs
$ctrlMain = new MainController();
$ctrlMovie = new MovieController();
$ctrlPerson = new PersonController();
$ctrlRole = new RoleController();
$ctrlTheme = new ThemeController();
$ctrlSubmission = new SubmissionController();
$ctrlSecurity = new SecurityController();

$session = new Session();

// Récupération de l'ID et de l'action à partir des paramètres GET
$id = (isset($_GET["id"])) ? $_GET["id"] : null;
$idMovie = (isset($_GET["idMovie"])) ? $_GET["idMovie"] : null;
// $type = (isset($_GET["type"])) ? $_GET["type"] : null;

// Exécution des actions en fonction de l'action spécifiée dans les paramètres GET
if(isset($_GET["action"])){
    switch ($_GET["action"]) {

        case "listMovies" : $ctrlMovie->listMovies(); break; // Affichage de la liste des films
        case "movieDetails" : $ctrlMovie->movieDetails($id); break; // Affichage des détails d'un film avec l'ID spécifié
        case "addMovie" : $ctrlMovie->addMovie(); break; // Ajout d'un film
        case "editMovie" : $ctrlMovie->editMovie($id); break; // Modification d'un film
        case "addCasting" : $ctrlMovie->addCasting($id); break; // Ajout de casting à un film
        case "delCasting" : $ctrlMovie->delCasting($id, $idMovie); break; // Suppression de casting d'un film
        case "delMovie" : $ctrlMovie->delMovie($id); break; // Suppression d'un film

        case "listActors" : $ctrlPerson->listActors(); break; // Affichage de la liste des acteurs
        case "listDirectors" : $ctrlPerson->listDirectors(); break; // Affichage de la liste des réalisateurs
        case "personDetails" : $ctrlPerson->personDetails($id); break; // Affichage des détails d'une personne
        case "addPerson" : $ctrlPerson->addPerson($id); break; // Ajout d'une personne
        case "editPerson" : $ctrlPerson->editPerson($id); break; // Modification d'une personne
        case "delActor" : $ctrlPerson->delActor($id); break; // Suppression d'un acteur
        case "delDirector" : $ctrlPerson->delDirector($id); break; // Suppression d'un réalisateur

        case "listRoles" : $ctrlRole->listRoles(); break; // Affichage de la liste des rôles
        case "roleDetails" : $ctrlRole->roleDetails($id); break; // Affichage des détails d'un rôle
        case "addRole" : $ctrlRole->addRole(); break; // Ajout d'un rôle
        case "editRole" : $ctrlRole->editRole($id); break; // Modification d'un rôle
        case "delRole" : $ctrlRole->delRole($id); break; // Suppression d'un rôle

        case "listThemes" : $ctrlTheme->listThemes(); break; // Affichage de la liste des thèmes
        case "themeDetails" : $ctrlTheme->themeDetails($id); break; // Affichage des détails d'un thème
        case "addTheme" : $ctrlTheme->addTheme(); break; // Ajout d'un thème
        case "editTheme" : $ctrlTheme->editTheme($id); break; // Modification d'un thème
        case "delTheme" : $ctrlTheme->delTheme($id); break; // Suppression d'un thème

        case "register" : $ctrlSecurity->register(); break;
        case "login" : $ctrlSecurity->login(); break;
        case "profile" : $ctrlSecurity->profile(); break;
        case "logout" : $ctrlSecurity->logout(); break;

        case "listSubmissions" : $ctrlSubmission->listSubmissions(); break; // Affichage de la liste des soumissions

    }
} else {
    $ctrlMain->main(); // Action par défaut si aucune action spécifiée
}