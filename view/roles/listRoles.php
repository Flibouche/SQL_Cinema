<?php ob_start();
$roles = $requestRoles->fetchAll();
?>

<section class="listRoles section" id="listRoles">

    <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search for a role.." title="Type in a name" aria-label="Search for a role">

    <div class="listRoles__container container">

        <?php
        foreach ($roles as $role) {
        ?>
            <a class="role_listRoles" href="index.php?action=roleDetails&id=<?= $role["idRole"] ?>" title="<?= $role["roleName"] ?>" aria-label="View details for role <?= $role["roleName"] ?>"><?= $role["roleName"] . "<br>" ?></a>
        <?php
        }

        ?>

    </div>

    <?php
    if ($session->isAdmin()) { ?>
        <button class="main__button list__button"><a href="index.php?action=addRole" aria-label="Add a role">Add a role</a></button>
    <?php } ?>

</section>

<script>
    // Tuto W3Schools
    function myFunction() {
        var input, filter, container, div, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        container = document.getElementsByClassName("listRoles__container")[0];
        links = container.getElementsByTagName("a");

        for (i = 0; i < links.length; i++) {
            title = links[i].textContent || links[i].innerText;
            if (title.toUpperCase().indexOf(filter) > -1) {
                links[i].style.display = "";
            } else {
                links[i].style.display = "none";
            }
        }
    }
</script>

<?php

$title = "Roles' List (" . $requestRoles->rowCount() . ")";
$metaDescription = "Here is the list of the different role(s). There are currently " . $requestRoles->rowCount() . " role(s) in our database.";
$secondary_title = "Roles' List (" . $requestRoles->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>