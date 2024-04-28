<?php ob_start();
$personDetails = $requestPersonDetails->fetch();
?>

<section class="modal hidden">
    <div class="flex">
        <button class="btn-close">
            <p>X</p>
        </button>
    </div>
    <div>
        <?php if (!empty($personDetails["idDirector"]) && $personDetails["idDirector"]) { ?>
            <h3>Are you sure you want to delete this director ?</h3>
            <button class="main__button btn"><a href="index.php?action=delDirector&id=<?= $personDetails['idDirector'] ?>">Yes</a></button>
            <button class="main__button btn-close2"><span>Nevermind</span></button>
        <?php } ?>
        <?php if (!empty($personDetails["idActor"])) { ?>
            <h3>Are you sure you want to delete this actor ?</h3>
            <button class="main__button btn"><a href="index.php?action=delActor&id=<?= $personDetails['idActor'] ?>">Yes</a></button>
            <button class="main__button btn-close2"><span>Nevermind</span></button>
        <?php } ?>
    </div>

</section>

<div class="overlay hidden"></div>

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
                <a id="delete-button" class="btn-openModal">
                    <i class="fa-solid fa-user-xmark"></i>
                </a>
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
                <h3>Biography :</h3>
                <p><?= $personDetails["biography"] ?></p>
            </div>
            <div class="read-btn">
                <i id="read-more-btn" class="fa-solid fa-arrow-down"></i>
                <i id="read-less-btn" class="fa-solid fa-arrow-up"></i>
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
                        <figure class="person__filmographycard-personDetails" title="<?= $filmography["title"] ?>">
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
                ?>
            </div>

        <?php
        }

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
                ?>
            </div>

        <?php
        }
        ?>

    </div>
</section>


<?php

$title = $personDetails["firstname"] . " " . $personDetails["surname"];
$secondary_title = $personDetails["firstname"] . " " . $personDetails["surname"];
$content = ob_get_clean();
require "view/template.php";
