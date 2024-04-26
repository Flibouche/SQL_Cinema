<?php ob_start();
$roleDetails = $requestRoleDetails->fetchAll();
$roleID = $requestRoleID->fetch();
?>

<section class="roleDetails section" id="listRoles">
    <div class="roleDetails__container container">

    <div class="role__header-roleDetails">
        <h3>Details of : <?= $roleID["roleName"] ?></h3>
        <a href="index.php?action=editRole&id=<?= $roleID["idRole"] ?>">
            <i class="fa-solid fa-pencil"></i>
        </a>
    </div>

        <?php
        // Je vérifie s'il y a au moins un role
        if (!empty($roleDetails)) {
        ?>
            <div class="role__casting-roleDetails">
                <?php
                foreach ($roleDetails as $roleDetails) {
                ?>
                    <figure class="role__castingcard-roleDetails">
                        <div class="castingcard__header-roleDetails">
                            <a href="index.php?action=personDetails&id=<?= $roleDetails["idPerson"] ?>"><img src="<?= $roleDetails["picture"] ?>" alt="Picture of <?= $roleDetails["firstname"] . " " . $roleDetails["surname"] ?>"></a>
                            </a>
                        </div>

                        <div class="castingcard__description-roleDetails">
                            <p>In the movie :</p>
                            <div class="castingcard__descriptionMovie-roleDetails">
                                <a href="index.php?action=movieDetails&id=<?= $roleDetails["idMovie"] ?>"><?= $roleDetails["title"] ?></a>
                            </div>
                            <div class="castingcard__descriptionPerson-roleDetails">
                                by <a href="index.php?action=personDetails&id=<?= $roleDetails["idPerson"] ?>"><?= $roleDetails["firstname"] . " " . $roleDetails["surname"] ?>
                            </div>
                        </div>
                    </figure>
            <?php
                }
            } else {
                echo "No actor attribued to this role.";
            }
            ?>

            </div>

            <button class="main__button list__button"><a href="index.php?action=delRole&id=<?= $roleID["idRole"] ?>" type="submit" name="submit">Delete role</a></button>

    </div>
</section>

<?php

$title = $roleID["roleName"];
$secondary_title = $roleID["roleName"];
$content = ob_get_clean();
require "view/template.php";
