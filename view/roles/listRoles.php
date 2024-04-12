<?php ob_start();
$roles = $requestRoles->fetchAll();
?>

<h1>Roles's List</h1>

<p>There's <?= $requestRoles->rowCount() ?> roles</p>

<?php
foreach ($roles as $role) {
?>
    <a href="index.php?action=rolesDetails&id=<?= $role["idRole"] ?>"><?= $role["roleName"] . "<br>" ?></a>
<?php
}

?>

<br>
<a href="index.php?action=addRole">Add a role</a>

<?php

$title = "Roles's List";
$secondary_title = "Roles's List";
$content = ob_get_clean();
require "view/template.php";