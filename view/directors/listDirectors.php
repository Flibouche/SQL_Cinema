<?php ob_start();
$directors = $requestDirectors->fetchAll();
?>

<section class="listDirectors section" id="listDirectors">
    <div class="listDirectors__container container">

        <?php
        foreach ($directors as $director) {
        ?>
            <figure class="director__card-listDirectors" title="<?= $director["firstname"] . " " . $director["surname"] ?>">
                <div class="card__header-listDirectors">
                    <a href="index.php?action=personDetails&id=<?= $director["idPerson"] ?>"><img src="<?= $director["picture"] ?>" alt="Picture of <?= $director["firstname"] . " " . $director["surname"] ?>"></a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=personDetails&id=<?= $director["idPerson"] ?>">
                            <p class="text-hover">Born in <?= $director["birthdate"] ?></p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listDirectors">
                    <a href="index.php?action=personDetails&id=<?= $director["idPerson"] ?>"><span><?= $director["firstname"] . " " . $director["surname"] ?></span></a>

                </div>

            </figure>
        <?php
        }

        ?>
    </div>

    <button class="main__button list__button"><a href="index.php?action=addPerson">Add a person</a></button>

</section>

<?php

$title = "Directors's List (" . $requestDirectors->rowCount() . ")";
$metaDescription = "Here is the list of the different director(s). There are currently " . $requestDirectors->rowCount() . " director(s) in our database.";
$secondary_title = "Directors's List (" . $requestDirectors->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>