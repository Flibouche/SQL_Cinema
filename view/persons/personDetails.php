<?php ob_start();
?>

<h1>Details of : </h1>

<?php
$person = $requestpersonDetails->fetch();
echo $person["firstname"] . " " . $person["surname"] . " " . $person["sex"] . " " . $person["birthdate"] . "<br>";





if (!empty($person["idActor"])) {

    $actorFilmography = $requestActorsFilmography->fetchAll();

    if (empty($actorFilmography)) {
        echo "No filmography found for this actor !";
    } else {
?>
        <h3>Filmography as an actor:</h3>
        <?php
        foreach ($actorFilmography as $filmography) {
        ?>
            <a href="index.php?action=movieDetails&id=<?= $filmography["idMovie"] ?>"><?= $filmography["title"] . " (" . $filmography["releaseYear"] . ")" ?></a> as <?= $filmography["roleName"] . "<br>" ?>
    <?php
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
}

if (!empty($person["idDirector"])) {

    $directorFilmography = $requestDirectorsFilmography->fetchAll();

    if (empty($directorFilmography)) {
        echo "No filmography found for this director.";
    } else {
    ?>
        <h3>Filmography as a director</h3>
        <?php
        foreach ($directorFilmography as $filmography) {
        ?>
            <a href="index.php?action=movieDetails&id=<?= $filmography["idMovie"] ?>"><?= $filmography["title"] . " (" . $filmography["releaseYear"] . ")" ?></a><br>
    <?php
        }
    }
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?action=delActor&id=<?= $person['idDirector'] ?>">Delete this director</a>
<?php
}

?>

<br>
<a href="index.php?action=editPerson&id=<?= $person['idPerson'] ?>">Edit this person</a>

<?php

$title = "Person's details";
$secondary_title = "Person's details";
$content = ob_get_clean();
require "view/template.php";
