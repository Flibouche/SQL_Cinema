<?php
ob_start();
?>

<section class="register section" id="register">
    <div class="register__container container grid">

        <h1>S'inscrire</h1>
        <form action="index.php?action=register" method="POST">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo"><br>

            <label for="email">Mail</label>
            <input type="email" name="email" id="email"><br>

            <label for="pass1">Mot de passe</label>
            <input type="password" name="pass1" id="pass1"><br>

            <label for="pass2">Confirmation du mot de passe</label>
            <input type="password" name="pass2" id="pass2"><br>

            <input type="submit" name="submit" value="S'enregister">

    </div>
</section>

<?php

$title = "Register";
$secondary_title = "Register";
$content = ob_get_clean();
require "view/template.php";