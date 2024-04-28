<?php ob_start();
$editRoleName = $requestRoleID->fetch();
?>

<section class="editMovie section" id="editMovie">

    <div class="editMovie__container container">

        <form action="" method="post">

        <div class="form__group">
            <label class="roleName">Rename this role : *</label>
            <input type="text" name="roleName" required>
        </div>

            <button class="main__button form" type="submit" name="submit" value="Rename"><span>Rename</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit this role : " . $editRoleName["roleName"];
$secondary_title = "Edit this role : " . $editRoleName["roleName"];
$content = ob_get_clean();
require "view/template.php";