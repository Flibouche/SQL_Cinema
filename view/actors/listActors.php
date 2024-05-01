<?php ob_start();
$actors = $requestActors->fetchAll();
?>

<section class="listActors section" id="listActors">
    <div class="listActors__container container">

        <?php
        foreach ($actors as $actor) {
        ?>
            <figure class="actor__card-listActors" title="<?= $actor["firstname"] . " " . $actor["surname"] ?>">
                <div class="card__header-listActors">
                    <a href="index.php?action=personDetails&id=<?= $actor["idPerson"] ?>"><img src="<?= $actor["picture"] ?>" alt="Picture of <?= $actor["firstname"] . " " . $actor["surname"] ?>"></a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=personDetails&id=<?= $actor["idPerson"] ?>">
                            <p class="text-hover">Born in <?= $actor["birthdate"] ?></p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listActors">
                    <a href="index.php?action=personDetails&id=<?= $actor["idPerson"] ?>"><span><?= $actor["firstname"] . " " . $actor["surname"] ?></span></a>
                </div>

            </figure>
        <?php
        }

        ?>

    </div>

    <button class="main__button list__button"><a href="index.php?action=addPerson">Add a person</a></button>

</section>

<?php

$title = "Actor's list (" . $requestActors->rowCount() . ")";
$secondary_title = "Actor's list (" . $requestActors->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>