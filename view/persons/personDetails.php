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
            <div class="person__filmography-personDetails">
                <h3>Director's filmography :<h3>
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
            </div>
            <?php
                    }
                }
            }
            ?>

            <?php
            if (!empty($personDetails["idActor"])) {
            ?>
                <div class="person__filmography-personDetails">
                    <h3>Actor's filmography :<h3>
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
    
                                </div>                            
                            </figure>
                </div>
                <?php
                        }
                    }
                }
        ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <a href="index.php?action=delActor&id=<?= $person['idActor'] ?>">Delete this actor</a>
    <?php

    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?action=delActor&id=<?= $person['idDirector'] ?>">Delete this director</a>
    <?php

    ?>

    <br>
    <a href="index.php?action=editPerson&id=<?= $person['idPerson'] ?>">Edit this person</a>

    </div>

</section>

<?php

$title = "Person's details";
$secondary_title = "Person's details";
$content = ob_get_clean();
require "view/template.php";