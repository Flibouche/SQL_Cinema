<?php ob_start();
$movieDetails = $requestMoviesDetails->fetch();
?>

<h1>Details of : </h1>

<?php
    echo $movieDetails["title"]." ".$movieDetails["releaseYear"]." ".$movieDetails["duration"]." ".$movieDetails["note"]." ".$movieDetails["synopsis"]."<br>";
?>

<?php

$title = "Movie's details";
$secondary_title = "Movie's details";
$content = ob_get_clean();
require "view/template.php";
