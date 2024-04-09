<?php ob_start();
$roles= $requeteRoles->fetchAll();
?>

<h1>Liste des roles</h1>

<p>Il y a <?= $requeteRoles->rowCount() ?> roles</p>

<?php
foreach($roles as $role) {
    echo $role["roleName"]."<br>";
}

?>


<?php

$title = "Liste des roles";
$secondary_title = "Liste des roles";
$content = ob_get_clean();
require "view/template.php";