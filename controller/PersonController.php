<?php

namespace Controller;

use Model\Connect;
use Model\Service;

class PersonController
{

    // Méthode pour afficher la liste des acteurs
    public function listActors()
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Préparation et exécution de la requête SQL pour récupérer les informations sur les acteurs
        $requestActors = $pdo->query("
                SELECT person.idPerson, actor.idActor, person.firstname, person.surname, person.sex, person.birthdate, person.picture
                FROM actor
                INNER JOIN person ON actor.idPerson = person.idPerson
                ORDER BY surname
            ");

        // Inclusion du fichier de vue pour afficher la liste des acteurs
        require "view/actors/listActors.php";
    }

    // Méthode pour afficher la liste des réalisateurs
    public function listDirectors()
    {
        // Établissement d'une connexion à la base de données en utilisant la méthode statique toLogIn() de la classe Connect
        $pdo = Connect::toLogIn();

        // Préparation et exécution de la requête SQL pour récupérer les informations sur les réalisateurs
        $requestDirectors = $pdo->query("
            SELECT person.idPerson, director.idDirector, person.firstname, person.surname, person.sex, person.birthdate, person.picture
            FROM director
            INNER JOIN person ON director.idPerson = person.idPerson
            ORDER BY surname
        ");

        // Inclusion du fichier de vue pour afficher la liste des réalisateurs
        require "view/directors/listDirectors.php";
    }

    public function personDetails($id): void
    {
        if (!Service::exists("person", $id)) {
            header("Location:index.php");
            exit;
        } else {

            $pdo = Connect::toLogIn();

            $requestPersonDetails = $pdo->prepare("
        SELECT person.idPerson, person.firstname, person.surname, person.sex, person.birthdate, person.picture, person.biography, actor.idActor, director.idDirector
        FROM person
        LEFT JOIN actor ON person.idPerson = actor.idPerson
        LEFT JOIN director ON person.idPerson = director.idPerson
        WHERE person.idPerson = :id
        ");
            $requestPersonDetails->execute(["id" => $id]);

            $requestActorsFilmography = $pdo->prepare("
        SELECT actor.idActor, movie.idMovie, movie.title, movie.releaseYear, movie.poster, person.firstname, person.surname, role.idRole, role.roleName
        FROM play
        INNER JOIN movie ON play.idMovie = movie.idMovie
        INNER JOIN role ON play.idRole = role.idRole
        INNER JOIN actor ON play.idActor = actor.idActor
        INNER JOIN person ON actor.idPerson = person.idPerson
        WHERE person.idPerson = :id
        ORDER BY releaseYear DESC
        ");
            $requestActorsFilmography->execute(["id" => $id]);

            $requestDirectorsFilmography = $pdo->prepare("
        SELECT director.idDirector, movie.idMovie, movie.title, movie.releaseYear, movie.poster, person.firstname, person.surname
        FROM director
        INNER JOIN person ON director.idPerson = person.idPerson
        INNER JOIN movie ON director.idDirector = movie.idDirector
        WHERE person.idPerson = :id
        ORDER BY movie.releaseYear DESC
        ");
            $requestDirectorsFilmography->execute(["id" => $id]);

            require "view/persons/personDetails.php";
        }
    }

    public function addPerson(): void
    {
        $pdo = Connect::toLogIn();
        if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis

            // Récupération et filtrage des données du formulaire
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biography = filter_input(INPUT_POST, "biography", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $job = filter_input(INPUT_POST, "job", FILTER_SANITIZE_NUMBER_INT);

            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $type = $_FILES['file']['type'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                // Tableau des extensions qu'on autorise
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'webp'];
                $maxSize = 10000000;

                if (in_array($extension, $allowedExtensions) && $size <= $maxSize && $error == 0) {

                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . '.' . $extension;

                    move_uploaded_file($tmpName, "./public/img/persons/" . $file);

                    // Conversion en webp
                    // Création de mon image en doublon
                    $pictureSource = imagecreatefromstring(file_get_contents("./public/img/persons/" . $file));
                    // Récupération du chemin de l'image
                    $webpPath = "./public/img/persons/" . $uniqueName . ".webp";
                    // Conversion en format webp
                    imagewebp($pictureSource, $webpPath);
                    // Suppression de l'ancienne image
                    unlink("./public/img/persons/" . $file);
                } else {
                    echo "Wrong extension or file size too large or error !";
                }
            }

            $picture = isset($webpPath) ? $webpPath : "./public/img/persons/default.webp";

            $requestAddPerson = $pdo->prepare("
                        INSERT INTO person (firstname, surname, sex, birthdate, picture, biography)
                        VALUES (:firstname, :surname, :sex, :birthdate, :picture, :biography)
                        ");

            // $webpPath doit être ajouté dans l'execute.
            $requestAddPerson->execute(["firstname" => $firstname, "surname" => $surname, "sex" => $sex, "birthdate" => $birthdate, "picture" => $picture, "biography" => $biography]);

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
            $_SESSION['message'] = "<div class='alert'>Person added successfully !</div>";
            exit;
        }

        require "view/persons/addPerson.php";
    }

    public function editPerson($id)
    {

        if (!Service::exists("person", $id)) {
            header("Location:index.php?");
            exit;
        } else {

            $pdo = Connect::toLogIn();
            $requestPerson = $pdo->prepare("
            SELECT person.idPerson, person.firstname, person.surname, person.sex, person.birthdate, person.biography, person.picture
            FROM person
            LEFT JOIN actor ON person.idPerson = actor.idPerson
            LEFT JOIN director ON person.idPerson = director.idPerson
            WHERE person.idPerson = :id        
            ");
            $requestPerson->execute(["id" => $id]);

            if (isset($_POST['submit'])) {

                $newFirstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newSurname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newSex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newBirthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newBiography = filter_input(INPUT_POST, "biography", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];
                    $type = $_FILES['file']['type'];

                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));

                    // Tableau des extensions qu'on autorise
                    $allowedExtensions = ['jpg', 'png', 'jpeg', 'webp'];
                    $maxSize = 100000000;

                    if (in_array($extension, $allowedExtensions) && $size <= $maxSize && $error == 0) {

                        $uniqueName = uniqid('', true);
                        $file = $uniqueName . '.' . $extension;

                        $requestPicture = $pdo->prepare("
                        SELECT person.picture
                        FROM person
                        WHERE person.idPerson = :id
                        ");
                        $requestPicture->execute(["id" => $id]);

                        // Permet de récupérer l'image du poster du film et de la supprimer en passant par la variable et le tableau "poster", autrement on pourrait faire une variable pour récupérer directement le tableau
                        $linkPicture = $requestPicture->fetch();

                        if (!$linkPicture !== "./public/img/persons/default.webp") {
                            unlink($linkPicture['picture']);
                        }

                        // On récupère l'image de notre formulaire via la superglobale file, on prend le chemin et on crée l'image
                        $pictureSource = imagecreatefromstring(file_get_contents($tmpName));
                        // Récupération du chemin cible de l'image
                        $webpPath = "./public/img/persons/" . $uniqueName . ".webp";
                        // Conversion en format webp (on prend l'image et on la colle dans le dossier de destination)
                        imagewebp($pictureSource, $webpPath);


                        $requestNewPicture = $pdo->prepare("
                        UPDATE person
                        SET picture = :picture
                        WHERE person.idPerson = :id
                        ");

                        $requestNewPicture->execute([
                            "picture" => $webpPath,
                            "id" => $id
                        ]);
                    } else {
                        echo "Wrong extension or file size too large or error !";
                    }
                }

                $requestEditPerson = $pdo->prepare("
                UPDATE person
                SET firstname = :firstname, surname = :surname, sex = :sex, birthdate = :birthdate, biography = :biography
                WHERE idPerson = :id
                ");
                $requestEditPerson->execute(["firstname" => $newFirstname, "surname" => $newSurname, "sex" => $newSex, "birthdate" => $newBirthdate, "biography" => $newBiography, "id" => $id]);

                header("Location:index.php?action=personDetails&id=$id");
                $_SESSION['message'] = "<div class='alert'>Person edited successfully !</div>";
                exit;
            }

            require "view/persons/editPerson.php";
        }
    }

    public function delActor($id)
    {

        $pdo = Connect::toLogIn();

        $requestDelCasting = $pdo->prepare("
        DELETE FROM play
        WHERE idActor = :id
        ");
        $requestDelCasting->execute(["id" => $id]);

        $requestDelActor = $pdo->prepare("
        DELETE FROM actor
        WHERE idActor = :id
        ");
        $requestDelActor->execute(["id" => $id]);

        header("Location:index.php?action=listActors");
        $_SESSION['message'] = "<div class='alert'>Actor deleted successfully !</div>";
        exit;
    }

    public function delDirector($id)
    {

        $pdo = Connect::toLogIn();

        $requestDelMovieDirector = $pdo->prepare("
        UPDATE movie
        SET idDirector = NULL
        WHERE idDirector = :id
        ");
        $requestDelMovieDirector->execute(["id" => $id]);

        $requestDelDirector = $pdo->prepare("
        DELETE FROM director
        WHERE idDirector = :id
        ");
        $requestDelDirector->execute(["id" => $id]);

        header("Location:index.php?action=listDirectors");
        $_SESSION['message'] = "<div class='alert'>Director deleted successfully !</div>";
        exit;
    }
}
