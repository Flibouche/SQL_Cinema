<?php ob_start();
?>

<section class="addRole section" id="addRole">

    <div class="addRole__container container">

        <form action="" method="post">

            <div class="form__group">
                <label class="role">Role name : *</label>
                <input class="" type="text" name="role" placeholder="Enter name" required>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Add role"><span>Add role</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a role";
$secondary_title = "Add a role";
$content = ob_get_clean();
require "view/template.php";