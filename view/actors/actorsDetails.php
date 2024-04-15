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
<a href="index.php?action=editPerson">Edit this person</a>


<?php

$title = "Actor's details";
$secondary_title = "Actor's details";
$content = ob_get_clean();
require "view/template.php";
