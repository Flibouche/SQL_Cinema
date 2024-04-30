<?php

namespace Controller;

use Model\Connect;
use Service\Session;

class SecurityController
{
    public function register()
    {
        $pdo = Connect::toLogIn();
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($pseudo && $email && $pass1 & $pass2) {
            $requete = $pdo->prepare("
        SELECT *
        FROM user
        WHERE email = :email
        ");
            $requete->execute(["email" => $email]);
            $user = $requete->fetch();

            // Si l'utilisateur existe
            if ($user) {
                header("Location:index.php?action=register");
                exit;
            } else {
                // Insertion de l'utilisateur en BDD
                if ($pass1 == $pass2 && strlen($pass1) >= 5) {
                    $insertUser = $pdo->prepare("
                INSERT INTO user (pseudo, email, password)
                VALUES (:pseudo, :email, :password)
                ");
                    $insertUser->execute([
                        "pseudo" => $pseudo,
                        "email" => $email,
                        "password" => password_hash($pass1, PASSWORD_DEFAULT)
                    ]);
                    header("Location:index.php?action=login");
                    exit;
                } else {
                    // Message "Les mots de passe ne sont pas identiques ou mot de passe trop court !!"
                }
            }
        } else {
            // Problème de saisie dans les champs de formulaire
        }

        require "view/security/register.php";
    }

    public function login()
    {
        $session = new Session();
        $pdo = Connect::toLogIn();
        // Filtrer les champs (faille XSS)
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Si les filtres sont valides
        if ($email && $password) {
            $requete = $pdo->prepare("
                            SELECT *
                            FROM user
                            WHERE email = :email
                            ");
            $requete->execute(["email" => $email]);
            $user = $requete->fetch();
            // Si l'utilisateur existe
            if ($user) {
                $hash = $user["password"];
                if (password_verify($password, $hash)) {
                    $session->setUser($user);
                    header("Location:index.php");
                    exit;
                } else {
                    header("Location:index.php?action=login");
                    exit;
                    // Message utilisateur inconnu ou mot de passe incorrect
                }
            } else {
                // Message utilisateur inconnu ou mot de passe incorrect
                header("Location:index.php?action=login");
                exit;
            }
            header("Location:index.php?action=login");
            exit;
        }

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
}
