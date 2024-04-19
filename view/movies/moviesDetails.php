<?php ob_start();
$movieDetails = $requestMoviesDetails->fetch();
$moviesCasting = $requestMoviesCasting->fetchAll();
?>

<h1>Details of : </h1>

<?php
echo $movieDetails["title"] . " " . $movieDetails["releaseYear"] . " " . $movieDetails["duration"] . " " . $movieDetails["note"] . " " . $movieDetails["synopsis"] . "<br>";

foreach ($requestMovieThemes->fetchAll() as $themes) {
    echo "Theme(s) : " . $themes["theme"] . "<br>";
}

foreach ($moviesCasting as $movieCasting) {
?>
    <a href="index.php?action=actorsDetails&id=<?= $movieCasting["idActor"] ?>"><?= $movieCasting["firstname"] . " " . $movieCasting["surname"] ?></a> as <?= $movieCasting["roleName"] ?>
    <a class="delBtn" href="index.php?action=delCasting&id=<?= $movieCasting["idActor"] ?>"><i class="fa-solid fa-xmark"></i></a><br>
<?php
}
?>



<br>
<a href="index.php?action=editMovie&id=<?= $movieDetails["idMovie"] ?>">Edit this movie</a>

<br>
<a href="index.php?action=addCasting&id=<?= $movieDetails["idMovie"] ?>">Add a casting</a>

<br>
<a href="index.php?action=editCasting&id=<?= $movieDetails["idMovie"] ?>">Edit this casting</a>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<a onclick="checker()" href="index.php?action=delMovie&id=<?= $movieDetails["idMovie"] ?>">Delete this movie</a>

<script>function checker() {
    var result = confirm('Are you sure ?');
    if (result == false) {
        event.preventDefault();
    }
}</script>

<?php

$title = "Movie's details";
$secondary_title = "Movie's details";
$content = ob_get_clean();
require "view/template.php";
