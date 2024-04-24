<?php ob_start();
$roleDetails = $requestroleDetails->fetchAll();
$roleID = $requestRoleID->fetch();
?>

<h1>Details of : </h1>

<?php
foreach ($roleDetails as $roleDetails) {
?>
    <a href="index.php?action=movieDetails&id=<?= $roleDetails["idMovie"] ?>"><?= $roleDetails["title"] ?></a> played by <a href="index.php?action=personDetails&id=<?= $roleDetails["idPerson"] ?>"><?= $roleDetails["firstname"] . " " . $roleDetails["surname"] . "<br>" ?>
    <?php
}
    ?>



    <br>
    <?php
    // Vérifiez s'il y a au moins un role
    if (!empty($roleDetails)) {
        // Lien "Edit this role" pointant vers le premier role de la liste
    ?>
        <a href="index.php?action=editRole&id=<?= $roleDetails["idRole"] ?>">Edit this role</a>
    <?php
    } else {
        // Gérer le cas où il n'y a aucun role
        echo "No role found.";
    }
    ?>

    <br>
    <a href="index.php?action=delRole&id=<?= $roleID["idRole"] ?>" type="submit" name="submit">Delete role</a>

    <?php

    $title = "List of role by movies and actors";
    $secondary_title = "List of role by movies and actors";
    $content = ob_get_clean();
    require "view/template.php";
