<?php ob_start();
$directorDetails = $requestDirectorsDetails->fetch();
$directorsFilmography = $requestDirectorsFilmography->fetchAll();
?>

<h1>Details of : </h1>

<?php
echo $directorDetails["firstname"] . " " . $directorDetails["surname"] . " " . $directorDetails["sex"] . " " . $directorDetails["birthdate"] . "<br>";

foreach ($directorsFilmography as $directorFilmography) {
?>
    <a href="index.php?action=moviesDetails&id=<?= $directorFilmography["idMovie"] ?>"><?= $directorFilmography["title"] . " (" . $directorFilmography["releaseYear"] . ")" . "<br>" ?></a>
<?php
}
?>



<br>
<a href="index.php?action=editPerson&id=<?= $directorDetails['idPerson']?>">Edit this person</a>

<?php

$title = "Director's details";
$secondary_title = "Director's details";
$content = ob_get_clean();
require "view/template.php";
