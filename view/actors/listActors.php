<?php ob_start();
$actors = $requestActors->fetchAll();
?>

<h1>Actors's list</h1>

<p>There's <?= $requestActors->rowCount() ?> actors</p>

<?php
foreach ($actors as $actor) {
?>
    <a href="index.php?action=personsDetails&id=<?= $actor["idPerson"] ?>"><?= $actor["firstname"] . " " . $actor["surname"] . "<br>" ?></a>
<?php
}

?>

<br>
<a href="index.php?action=addPerson">Add a person</a>

<?php

$title = "Actor's list";
$secondary_title = "Actor's list";
$content = ob_get_clean();
require "view/template.php";
