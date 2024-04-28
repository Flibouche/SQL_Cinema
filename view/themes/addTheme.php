<?php ob_start();
?>

<section class="addTheme section" id="addTheme">

    <div class="addTheme__container container">

        <form action="" method="post">

            <div class="form__group">
                <label class="theme">Movie theme name : *</label>
                <input class="" type="text" name="theme" placeholder="Enter name" required>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Add theme"><span>Add Theme</span></button </form>

    </div>

</section>

<?php

$title = "Add a theme";
$secondary_title = "Add a theme";
$content = ob_get_clean();
require "view/template.php";