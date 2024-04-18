<?php ob_start();
$actorDetails = $requestActorsDetails->fetch();
$actorsFilmography = $requestActorsFilmography->fetchAll();
?>

<h1>Details of : </h1>

<?php
echo $actorDetails["firstname"] . " " . $actorDetails["surname"] . " " . $actorDetails["sex"] . " " . $actorDetails["birthdate"] . "<br>";

foreach ($actorsFilmography as $actorFilmography) {
?>
    <a href="index.php?action=moviesDetails&id=<?= $actorFilmography["idMovie"] ?>"><?= $actorFilmography["title"] . " (" . $actorFilmography["releaseYear"] . ")" ?></a> as <?= $actorFilmography["roleName"] . "<br>" ?>
<?php
}
?>


<br>
<a href="index.php?action=editPerson&id=<?= $actorDetails['idPerson'] ?>">Edit this person</a>

<br>
<br>
<br>
<br>
<br>
<br>
<a href="index.php?action=delActor&id=<?= $actorDetails['idActor'] ?>">Delete this actor</a>


<?php

$title = "Actor's details";
$secondary_title = "Actor's details";
$content = ob_get_clean();
require "view/template.php";
