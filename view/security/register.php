<?php
ob_start();
?>

<section class="register section" id="register" aria-label="User Registration">
    <div class="register__container container grid">

        <form action="index.php?action=register" method="POST">

            <div class="form__group">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" aria-label="Pseudo">
            </div>

            <div class="form__group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" aria-label="Email">
            </div>

            <div class="form__group">
                <label for="pass1">Password</label>
                <input type="password" name="pass1" id="password" aria-label="Password">
            </div>

            <div class="form__group">
                <label for="pass2">Confirm Password</label>
                <input type="password" name="pass2" id="password2" aria-label="Confirm Password">
            </div>

            <div>
                <input class="showPassword" type="checkbox" onclick="showPassword()"><span>Show Password</span>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Register" aria-label="Register Button">
                <span>Register</span>
            </button>

    </div>

</section>

<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<?php

$title = "Register";
$metaDescription = "Here is the registration page of the site.";
$secondary_title = "Register";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>