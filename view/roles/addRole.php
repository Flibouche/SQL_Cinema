<?php ob_start();
?>

<section class="addRole section" id="addRole">

    <div class="addRole__container container">

        <form action="index.php?action=addRole" method="POST">

            <div class="form__group">
                <label for="role">Role name : *</label>
                <input id="role" type="text" name="role" placeholder="Enter name" required>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Add role"><span>Add role</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a role";
$metaDescription = "Here is the form where you can add a role to the database.";
$secondary_title = "Add a role";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>