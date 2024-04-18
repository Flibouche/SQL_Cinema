<?php ob_start();
?>

<section class="submission section" id="submission">
    <div class="submission__container container grid">

        <br>
        <a href="index.php?action=addMovie">Add a movie</a>

        <br>
        <a href="index.php?action=addPerson">Add a person</a>

        <br>
        <a href="index.php?action=addRole">Add a role</a>

        <br>
        <a href="index.php?action=addTheme">Add a theme</a>


    </div>
</section>



<?php

$title = "Submission";
$secondary_title = "Submission";
$content = ob_get_clean();
require "template.php";
