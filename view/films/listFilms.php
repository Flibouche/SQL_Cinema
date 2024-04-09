<?php ob_start();
$films= $requeteFilms->fetchAll();
?>

<h1>Liste des films</h1>

<p>Il y a <?= $requeteFilms->rowCount() ?> films</p>

<?php
foreach($films as $film) {
    echo $film["title"]." ".$film["releaseYear"]."<br>";
}

?>


<?php

$title = "Liste des films";
$secondary_title = "Liste des films";
$content = ob_get_clean();
require "view/template.php";