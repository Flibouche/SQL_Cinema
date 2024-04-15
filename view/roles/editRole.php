<?php ob_start();
$editRoleName = $requestRoleID->fetch();
?>

<h1>Edit this role : <?= $editRoleName["roleName"]?></h1>
<form action="" method="post">

    <label class="">
        Rename this role :
        <input class="" type="text" name="roleName">
    </label>

    <input class="" type="submit" name="submit" value="Rename">

</form>





<?php

$title = "Edit a role";
$secondary_title = "Edit a role";
$content = ob_get_clean();
require "view/template.php";
