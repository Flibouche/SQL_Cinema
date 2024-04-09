<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type"])) ? $_GET["type"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {

        case "listMovies" : $ctrlCinema->listMovies(); break;
        case "listActors" : $ctrlCinema->listActors(); break;
        case "listDirectors" : $ctrlCinema->listDirectors(); break;
        case "listRoles" : $ctrlCinema->listRoles(); break;
        case "listThemes" : $ctrlCinema->listThemes(); break;
        case "actorsDetails" : $ctrlCinema->actorsDetails($id); break;
        case "moviesDetails" : $ctrlCinema->moviesDetails($id); break;
        case "directorsDetails" : $ctrlCinema->directorsDetails($id); break;
    }
}
