<?php ob_start();
?>

<h1>Details of : </h1>

<?php
$person = $requestPersonsDetails->fetch();
echo $person["firstname"] . " " . $person["surname"] . " " . $person["sex"] . " " . $person["birthdate"] . "<br>";





if (!empty($person["idActor"])) {
    $actorFilmography = $requestActorsFilmography->fetchAll();
    if (!empty($actorFilmography)) {
        foreach ($actorFilmography as $filmography) {
?>
            <a href="index.php?action=moviesDetails&id=<?= $filmography["idMovie"] ?>"><?= $filmography["title"] . " (" . $filmography["releaseYear"] . ")" ?></a> as <?= $filmography["roleName"] . "<br>" ?>
        <?php
        }
    }
}

if (!empty($person["idDirector"])) {
    $directorFilmography = $requestDirectorsFilmography->fetchAll();
    foreach ($directorFilmography as $filmography) {
        ?>
        <a href="index.php?action=moviesDetails&id=<?= $filmography["idMovie"] ?>"><?= $filmography["title"] . " (" . $filmography["releaseYear"] . ")" ?></a><br>
<?php
    }
}

?>

<!-- <br>
<a href="index.php?action=editPerson&id=<?= $actorDetails['idPerson'] ?>">Edit this person</a> -->

<?php

$title = "Person's details";
$secondary_title = "Person's details";
$content = ob_get_clean();
require "view/template.php";
