<?php ob_start();
$personDetails = $requestPersonDetails->fetch();
?>

<section class="personDetails section" id="listPersons">
    <div class="personDetails__container container">

        <div class="person__header-personDetails">
            <div class="person__picture-personDetails">
                <img src="<?= $personDetails["picture"] ?>" alt="Picture of <?= $personDetails["firstname"] . " " . $personDetails["surname"] ?>">
            </div>

            <div class="person__edit-personDetails">
                <a href="index.php?action=editPerson&id=<?= $personDetails['idPerson'] ?>">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <?php if (!empty($personDetails["idDirector"])) {
                ?>
                    <a href="index.php?action=delDirector&id=<?= $personDetails['idDirector'] ?>">
                        <i class="fa-solid fa-user-xmark"> D</i>
                    </a>
                <?php } ?>
                <?php if (!empty($personDetails["idActor"])) {
                ?>
                    <a href="index.php?action=delActor&id=<?= $personDetails['idActor'] ?>">
                        <i class="fa-solid fa-user-xmark"> A</i>
                    </a>
                <?php } ?>
            </div>

        </div>

        <div class="person__information-personDetails">
            <h3><?= $personDetails["firstname"] . " " . $personDetails["surname"] ?></h3>

            <p>Birthdate : <?= $personDetails["birthdate"] ?></p>

            <p>Genre : <?= $personDetails["sex"] ?></p>

        </div>

        <hr>

        <div class="person__description-personDetails">

            <div id="description">
                <h3>Description :</h3>
            </div>

        </div>

        <hr>

        <?php
        if (!empty($personDetails["idDirector"])) {
        ?>
            <h3 class="person__filmographyh3-personDetails">Director's filmography :</h3>
                    <div class="person__filmography-personDetails">
                        <?php
                        $directorFilmography = $requestDirectorsFilmography->fetchAll();
                        if (empty($directorFilmography)) {
                            echo "No filmography found for this director.";
                        } else {
                            foreach ($directorFilmography as $filmography) {
                        ?>
                                <figure class="person__filmographycard-personDetails">
                                    <div class="filmographycard__header-personDetails">
                                        <a href="index.php?action=movieDetails&id=<?= $filmography["idMovie"] ?>"><img src="<?= $filmography["poster"] ?>" alt=""></a>
                                    </div>

                                    <div class="filmographycard__description-personDetails">
                                        <a href="index.php?action=movieDetails&id=<?= $filmography["idMovie"] ?>"><?= $filmography["title"] . " (" . $filmography["releaseYear"] . ")" ?></a>
                                    </div>

                                </figure>
                    <?php
                            }
                        }
                    }
                    ?>
                    </div>

                    <?php
                    if (!empty($personDetails["idActor"])) {
                    ?>
                        <h3 class="person__filmographyh3-personDetails">Actor's filmography :</h3>
                                <div class="person__filmography-personDetails">
                                    <?php
                                    $actorFilmography = $requestActorsFilmography->fetchAll();
                                    if (empty($actorFilmography)) {
                                        echo "No filmography found for this director.";
                                    } else {
                                        foreach ($actorFilmography as $filmography) {
                                    ?>
                                            <figure class="person__filmographycard-personDetails">
                                                <div class="filmographycard__header-personDetails">
                                                    <a href="index.php?action=movieDetails&id=<?= $filmography["idMovie"] ?>"><img src="<?= $filmography["poster"] ?>" alt=""></a>
                                                </div>

                                                <div class="filmographycard__description-personDetails">
                                                    <a href="index.php?action=movieDetails&id=<?= $filmography["idMovie"] ?>"><?= $filmography["title"] . " (" . $filmography["releaseYear"] . ")" ?></a>
                                                    <p>as <?= $filmography["roleName"] ?></p>
                                                </div>
                                            </figure>
                                <?php
                                        }
                                    }
                                }
                                ?>
                                </div>
    </div>

</section>

<?php

$title = "Person's details";
$secondary_title = $personDetails["firstname"]. " ". $personDetails["surname"];
$content = ob_get_clean();
require "view/template.php";
