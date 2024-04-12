<?php

namespace Controller;

use Model\Connect;

class PersonController
{

    public function personsDetails(): void
    {

        require "view/persons/personsDetails.php";
    }

    public function addPerson($id): void
    {
        $pdo = Connect::toLogIn();
        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis

            // Récupération et filtrage des données du formulaire
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $picture = filter_input(INPUT_POST, "picture", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $job = filter_input(INPUT_POST, "job", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $requestAddPerson = $pdo->prepare("
                        INSERT INTO person (firstname, surname, sex, birthdate, picture)
                        VALUES (:firstname, :surname, :sex, :birthdate, :picture)
                        ");

            $requestAddPerson->execute(["firstname" => $firstname, "surname" => $surname, "sex" => $sex, "birthdate" => $birthdate, "picture" => $picture]);

            $personId = $pdo->lastInsertId();

            if ($job === 'actor') {
                $stmtAoR = $pdo->prepare("
                INSERT INTO actor (idPerson)
                VALUES (:idPerson)
                ");
                $stmtAoR->execute(["idPerson" => $personId]);
            } elseif ($job === 'director') {
                $stmtAoR = $pdo->prepare("
                INSERT INTO director (idPerson)
                VALUES (:idPerson)
                ");
                $stmtAoR->execute(["idPerson" => $personId]);
            } else {
                $stmt1 = $pdo->prepare("
                INSERT INTO actor (idPerson)
                VALUES (:idPerson)                
                ");
                $stmt1->execute(["idPerson" => $personId]);

                $stmt2 = $pdo->prepare("
                INSERT INTO director (idPerson)
                VALUES (:idPerson)                
                ");
                $stmt2->execute(["idPerson" => $personId]);
            }

            // Redirection vers la page 'index.php?action=addPerson' après le traitement du formulaire
            header("Location:index.php?action=addPerson");
        }

        require "view/persons/addPerson.php";
    }
}
