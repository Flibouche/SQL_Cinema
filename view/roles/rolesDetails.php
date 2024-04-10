<?php ob_start();
$rolesDetails = $requestRolesDetails->fetchAll();
?>

<h1>Details of : </h1>

<?php
foreach ($rolesDetails as $roleDetails) {
?>
    <a href="index.php?action=moviesDetails&id=<?= $roleDetails["idMovie"] ?>"><?= $roleDetails["title"] ?></a> played by <a href="index.php?action=actorsDetails&id=<?= $roleDetails["idActor"] ?>"><?= $roleDetails["firstname"] . " " . $roleDetails["surname"] . "<br>" ?>
<?php
}
?>

<?php

$title = "List of role by movies and actors";
$secondary_title = "List of role by movies and actors";
$content = ob_get_clean();
require "view/template.php";
