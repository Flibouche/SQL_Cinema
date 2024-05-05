<?php
ob_start();
?>

<section class="profile section" id="register" aria-label="User Profile">
    <div class="profile__container container grid">

        <?php
        if (isset($_SESSION["user"])) {
            $infosSession = $_SESSION["user"];
        }
        ?>

        <p>Pseudo : <?= $infosSession["pseudo"] ?></p>
        <p>Email : <?= $infosSession["email"] ?></p>
        <p>Profile picture :</p>
        <img src="<?= $infosSession["profilePicture"] ?>" alt="Profile Picture" aria-label="Profile Picture" loading="lazy" />

        <button class="main__button btn" aria-label="Delete Account Button">
            <a href="index.php?action=delAccount&id=<?= $infosSession["idUser"] ?>">Delete Account</a>
        </button>

    </div>
</section>

<?php

$title = "Profile";
$metaDescription = "Here is your personal profile page! Welcome home " . $infosSession["pseudo"] . "!";
$secondary_title = "Profile";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>