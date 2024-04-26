<?php ob_start();
$roles = $requestRoles->fetchAll();
?>

<section class="listRoles section" id="listRoles">
    <div class="listRoles__container container">

        <?php
        foreach ($roles as $role) {
        ?>
            <a href="index.php?action=roleDetails&id=<?= $role["idRole"] ?>"><?= $role["roleName"] . "<br>" ?></a>
        <?php
        }

        ?>

    </div>

    <button class="main__button list__button"><a href="index.php?action=addRole">Add a role</a></button>

</section>

<?php

$title = "Roles' List (" . $requestRoles->rowCount() . ")";
$secondary_title = "Roles' List (" . $requestRoles->rowCount() . ")";
$content = ob_get_clean();
require "view/template.php";