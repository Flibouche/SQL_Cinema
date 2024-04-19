<?php ob_start();
$movies = $requestMovies->fetchAll();
?>

<h1>Movies' List</h1>

<p>There's <?= $requestMovies->rowCount() ?> movies</p>

<?php
foreach($movies as $movie) {
?>
    <a href="index.php?action=moviesDetails&id=<?= $movie["idMovie"] ?>"><?= $movie["title"] . " " . $movie["releaseYear"] . "<br>" ?></a>
<?php
}

?>

<br>
<a href="index.php?action=addMovie">Add a movie</a>

<?php

$title = "Movies' List";
$secondary_title = "Movies' List";
$content = ob_get_clean();
require "view/template.php";