<?php ob_start();
$directors = $requestDirectors->fetchAll();
?>

<h1>Directors's List</h1>

<p>There's <?= $requestDirectors->rowCount() ?> directors</p>

<?php
foreach ($directors as $director) {
?>
    <a href="index.php?action=personsDetails&id=<?= $director["idPerson"] ?>"><?= $director["firstname"] . " " . $director["surname"] . "<br>" ?></a>
<?php
}

?>

<br>
<a href="index.php?action=addPerson">Add a person</a>

<?php

$title = "Directors's List";
$secondary_title = "Directors's List";
$content = ob_get_clean();
require "view/template.php";
