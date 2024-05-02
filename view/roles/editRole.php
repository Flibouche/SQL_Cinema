<?php ob_start();
$editRoleName = $requestRoleID->fetch();
?>

<section class="editMovie section" id="editMovie">

    <div class="editMovie__container container">

        <form action="index.php?action=editRole&id=<?= $editRoleName['idRole'] ?>" method="POST">

            <div class="form__group">
                <label for="roleName">Rename this role : *</label>
                <input id="roleName" type="text" name="roleName" value="<?= $editRoleName['roleName'] ?>" required>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Rename"><span>Rename</span></button>

        </form>

    </div>

</section>

<?php

$title = "Edit this role : " . $editRoleName["roleName"];
$metaDescription = "Here is the form where you can edit the informations of the role '" . $editRoleName["roleName"] . "'";
$secondary_title = "Edit this role : " . $editRoleName["roleName"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>