<?php
ob_start();
?>

<section class="login section" id="register">
    <div class="login__container container grid">

        <h1>Se connecter</h1>
        <form action="index.php?action=login" method="POST">

            <label for="email">Email</label>
            <input type="email" name="email" id="email"><br>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password"><br>

            <input type="submit" name="submit" value="Se connecter">

        </form>

    </div>
</section>

<?php

$title = "Login";
$secondary_title = "Login";
$content = ob_get_clean();
require "view/template.php";