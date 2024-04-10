<?php ob_start();
?>

<h1>CineDune</h1>
<img src="public/img/mainPlanet.gif" alt="Logo of CineDune">
<h2>Welcome to CineDune</h2>
<p>Are you lost in this tumult of information when you just wanted to know the cast of the movie you just watched ?<br> No problem, CineDune gets straight to the point !<br> And as a bonus, you can contribute to the site yourself !</p>

<h2>Actors</h2>
<?php
foreach ($requestActorsMain->fetchAll() as $actor) {
?>
    <a href="index.php?action=actorsDetails&id=<?= $actor["idActor"] ?>"><?= $actor["firstname"] . " " . $actor["surname"] . "<br>" ?></a>
    <img src="<?= $actor["picture"]?>">
<?php
}
?>

<h2>Directors</h2>
<?php
foreach ($requestDirectorsMain->fetchAll() as $director) {
?>
    <a href="index.php?action=directorsDetails&id=<?= $director["idDirector"] ?>"><?= $director["firstname"] . " " . $director["surname"] . "<br>" ?></a>
    <img src="<?= $director["picture"]?>">
<?php
}
?>


<?php

$title = "Main";
$secondary_title = "Main";
$content = ob_get_clean();
require "template.php";
