<?php

namespace Controller;

use Model\Connect;
use Service\Session;

class SecurityController
{
    public function register()
    {

        $pdo = Connect::toLogIn();

        // Récupération et nettoyage des données du formulaire
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Vérification de la validité des données du formulaire
        if ($pseudo && $email && $pass1 & $pass2) {
            // Vérification si l'email existe déjà dans la base de données
            $requete = $pdo->prepare("
                SELECT *
                FROM user
                WHERE email = :email
            ");
            $requete->execute(["email" => $email]);
            $user = $requete->fetch();

            // Si l'utilisateur existe déjà dans la base de données
            if ($user) {
                // Redirection vers la page d'inscription avec un message d'erreur
                header("Location:index.php?action=register");
                exit;
            } else {
                // Si l'utilisateur n'existe pas encore dans la base de données
                // Insertion de l'utilisateur en base de données si les conditions sont remplies
                if ($pass1 == $pass2 && strlen($pass1) >= 5) {
                    // Préparation de la requête d'insertion
                    $insertUser = $pdo->prepare("
                    INSERT INTO user (pseudo, email, password, role)
                    VALUES (:pseudo, :email, :password, :role)
                    ");
                    // Exécution de la requête d'insertion en fournissant les valeurs
                    $insertUser->execute([
                        "pseudo" => $pseudo,
                        "email" => $email,
                        // Hashage du mot de passe avant son insertion en base de données pour des raisons de sécurité
                        "password" => password_hash($pass1, PASSWORD_DEFAULT), // La constante PASSWORD_DEFAULT est utilisée pour spécifier l'algorithme de hachage recommandé actuellement (actuellement bcrypt)
                        "role" => "ROLE_USER"
                    ]);
                    // Redirection vers la page de connexion après l'inscription
                    header("Location:index.php?action=login");
                    exit; // Arrêt de l'exécution du script après la redirection
                } else {
                    // Redirection vers la page d'inscription avec un message d'erreur si les mots de passe ne correspondent pas ou sont trop courts
                }
            }
        } else {
            // Redirection vers la page d'inscription avec un message d'erreur si des champs du formulaire ne sont pas remplis
        }

        // Affichage du formulaire d'inscription
        require "view/security/register.php";
    }


    public function login()
    {
        // Initialisation de la session
        $session = new Session();

        $pdo = Connect::toLogIn();

        // Filtrage des champs du formulaire pour éviter les attaques XSS
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Vérification si les filtres sont valides
        if ($email && $password) {
            // Requête pour récupérer l'utilisateur correspondant à l'email
            $requete = $pdo->prepare("
                SELECT *
                FROM user
                WHERE email = :email
            ");
            $requete->execute(["email" => $email]);
            $user = $requete->fetch();

            // Si l'utilisateur existe
            if ($user) {
                // Récupération du hash du mot de passe de l'utilisateur
                $hash = $user["password"];
                // Vérification si le mot de passe fourni correspond au hash stocké dans la base de données
                if (password_verify($password, $hash)) {
                    // Si la vérification du mot de passe est réussie, l'utilisateur est connecté et sa session est enregistrée
                    $session->setUser($user);
                    // Redirection vers la page d'accueil après connexion
                    header("Location:index.php");
                    exit;
                } else {
                    // Redirection vers la page de connexion avec un message d'erreur si le mot de passe est incorrect
                    header("Location:index.php?action=login");
                    exit;
                    // Message indiquant que l'utilisateur est inconnu ou que le mot de passe est incorrect
                }
            } else {
                // Redirection vers la page de connexion avec un message d'erreur si l'utilisateur est inconnu
                header("Location:index.php?action=login");
                exit;
                // Message indiquant que l'utilisateur est inconnu ou que le mot de passe est incorrect
            }
        }

        // Affichage du formulaire de connexion
        require "view/security/login.php";
    }


    public function profile()
    {

        require "view/security/profile.php";
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location:index.php");
        exit;
    }

    public function delAccount($id)
    {

        $pdo = Connect::toLogIn();

        $requestDelAccount = $pdo->prepare("
        DELETE FROM user
        WHERE idUser = :id;
        ");
        $requestDelAccount->execute(["id" => $id]);

        unset($_SESSION["user"]);

        header("Location:index.php");
        $_SESSION['message'] = "<div class='alert'>Your account has been deleted successfully !</div>";
        exit;
    }
}
