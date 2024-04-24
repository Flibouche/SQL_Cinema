<?php ob_start();
$roles = $requestRoles->fetchAll();
?>

<section class="listRoles section" id="listRoles">
    <p>There's <?= $requestRoles->rowCount() ?> roles</p>
    <div class="listRoles__container container">

        <?php
        foreach ($roles as $role) {
        ?>
            <a href="index.php?action=rolesDetails&id=<?= $role["idRole"] ?>"><?= $role["roleName"] . "<br>" ?></a>
        <?php
        }

        ?>

    </div>

    <button class="main__button list__button"><a href="index.php?action=addRole">Add a role</a></button>
    
</section>

<?php

$title = "Roles' List";
$secondary_title = "Roles' List";
$content = ob_get_clean();
require "view/template.php";
