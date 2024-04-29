<?php
ob_start();
?>

<section class="profile section" id="register">
    <div class="profile__container container grid">

        <?php
        if (isset($_SESSION["user"])) {
            $infosSession = $_SESSION["user"];
        }
        ?>

        <p>Pseudo : <?= $infosSession["pseudo"] ?></p>
        <p>Email : <?= $infosSession["email"] ?></p>

    </div>
</section>

<?php

$title = "Profile";
$secondary_title = "Profile";
$content = ob_get_clean();
require "view/template.php";
