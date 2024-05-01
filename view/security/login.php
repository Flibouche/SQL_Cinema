<?php
ob_start();
?>

<section class="login section" id="register">
    <div class="login__container container grid">

        <form action="index.php?action=login" method="POST">

            <div class="form__group">
                <label for="email">Enter your email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form__group">
                <label for="password">Enter your password</label>
                <input type="password" name="password" id="password">
            </div class="form__group">
            
            <div>
                <input class="showPassword"type="checkbox" onclick="showPassword()"><span>Show Password</span>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Sign In"><span>Sign In</span></button>

        </form>

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

$title = "Sign In";
$metaDescription = "This is the login page of the site.";
$secondary_title = "Sign In";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>