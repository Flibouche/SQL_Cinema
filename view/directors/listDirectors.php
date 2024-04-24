<?php ob_start();
$directors = $requestDirectors->fetchAll();
?>

<section class="listDirectors section" id="listDirectors">
    <p>There's <?= $requestDirectors->rowCount() ?> directors</p>
    <div class="listDirectors__container container">

        <?php
        foreach ($directors as $director) {
        ?>
            <figure class="director__card-listDirectors">
                <a href="index.php?action=personsDetails&id=<?= $director["idPerson"] ?>"><img src="<?= $director["picture"] ?>" alt=""><span><?= $director["firstname"] . " " . $director["surname"] . "<br>" ?></span></a>
            </figure>
        <?php
        }

        ?>
    </div>

    <button class="main__button list__button"><a href="index.php?action=addPerson">Add a person</a></button>

</section>

<?php

$title = "Directors's List ";
$secondary_title = "Directors's List";
$content = ob_get_clean();
require "view/template.php";
