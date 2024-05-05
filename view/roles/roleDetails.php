<?php ob_start();
$roleDetails = $requestRoleDetails->fetchAll();
$roleID = $requestRoleID->fetch();
?>

<?php
if ($session->isAdmin()) { ?>
    <section class="modal hidden" aria-label="Delete Role Confirmation">
        <div class="flex">
            <button class="btn-close" aria-label="Close modal">
                <p>X</p>
            </button>
        </div>

        <div>
            <h3>Are you sure you want to delete this role ?</h3>
        </div>

        <button class="main__button btn" aria-label="Delete this role"><a href="index.php?action=delRole&id=<?= $roleID["idRole"] ?>" type="submit" name="submit">Delete role</a></button>
        <button class="main__button btn-close2" aria-label="Don't delete this role"><span>Nevermind</span></button>

    </section>

    <div class="overlay hidden" aria-hidden="true"></div>
<?php } ?>

<section class="roleDetails section" id="listRoles" aria-label="Role Details">
    <div class="roleDetails__container container">

        <div class="role__header-roleDetails">
            <h3>Details of : <?= $roleID["roleName"] ?></h3>
            <?php
            if ($session->isAdmin()) { ?>
                <a href="index.php?action=editRole&id=<?= $roleID["idRole"] ?>" aria-label="Edit role"><i class="fa-solid fa-pencil"></i></a>
            <?php } ?>
        </div>

        <?php
        // Je vérifie s'il y a au moins un rôle
        if (!empty($roleDetails)) {
        ?>
            <div class="role__casting-roleDetails">
                <?php
                foreach ($roleDetails as $roleDetail) {
                ?>
                    <figure class="role__castingcard-roleDetails" title="<?= $roleDetail["firstname"] . " " . $roleDetail["surname"] ?>">
                        <div class="castingcard__header-roleDetails">
                            <a href="index.php?action=personDetails&id=<?= $roleDetail["idPerson"] ?>"><img src="<?= $roleDetail["picture"] ?>" alt="Picture of <?= $roleDetail["firstname"] . " " . $roleDetail["surname"] ?>" loading="lazy" /></a>
                        </div>

                        <div class="castingcard__description-roleDetails">
                            <p>In the movie :</p>
                            <div class="castingcard__descriptionMovie-roleDetails" title="<?= $roleDetail["title"] ?>">
                                <a href="index.php?action=movieDetails&id=<?= $roleDetail["idMovie"] ?>" aria-label="View movie details"><?= $roleDetail["title"] ?></a>
                            </div>
                            <div class="castingcard__descriptionPerson-roleDetails">
                                by <a href="index.php?action=personDetails&id=<?= $roleDetail["idPerson"] ?>" aria-label="View actor details"><?= $roleDetail["firstname"] . " " . $roleDetail["surname"] ?></a>
                            </div>
                        </div>
                    </figure>
            <?php
                }
            } else {
                echo "No actor attributed to this role.";
            }
            ?>

            </div>

            <?php
            if ($session->isAdmin()) { ?>
                <button class="main__button list__button"><a id="delete-button" class="btn-openModal" aria-label="Delete role">Delete role</a></button>
            <?php } ?>

    </div>
    
</section>

<?php

$title = $roleID["roleName"];
$metaDescription = "Discover the different actor(s) who play the role of " . $roleID["roleName"] . ". Learn more about this role by clicking on an actor.";
$secondary_title = $roleID["roleName"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>