<?php ob_start();
$movies = $requestMovies->fetchAll();
?>

<h1>Movies's List</h1>

<p>There's <?= $requestMovies->rowCount() ?> movies</p>

<?php
foreach($movies as $movie) {
    echo $movie["title"]." ".$movie["releaseYear"]."<br>";
}

?>


<?php

$title = "Movies's List";
$secondary_title = "Movies's List";
$content = ob_get_clean();
require "view/template.php";