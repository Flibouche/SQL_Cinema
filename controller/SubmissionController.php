<?php

namespace Controller;

use Model\Connect; // Importation de la classe Connect depuis le namespace Model

class SubmissionController
{
    // Méthode pour afficher la liste des soumissions
    public function listSubmissions()
    {

        // Inclusion du fichier de vue pour afficher la liste des soumissions
        require "view/listSubmissions.php";
    }
}
