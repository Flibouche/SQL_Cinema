<?php ob_start();
$actors = $requestActors->fetchAll();
?>

<section class="listActors section" id="listActors">
    <p>There's <?= $requestActors->rowCount() ?> actors</p>
    <div class="listActors__container container">

        <?php
        foreach ($actors as $actor) {
        ?>
            <figure class="actor__card-listActors">
                <a href="index.php?action=personsDetails&id=<?= $actor["idPerson"] ?>"><img src="<?= $actor["picture"] ?>" alt=""><span><?= $actor["firstname"] . " " . $actor["surname"] ?></span></a>
            </figure>
        <?php
        }

        ?>

    </div>

    <button class="main__button list__button"><a href="index.php?action=addPerson">Add a person</a></button>

</section>

<?php

$title = "Actor's list";
$secondary_title = "Actor's list";
$content = ob_get_clean();
require "view/template.php";
