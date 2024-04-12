<?php ob_start();
$directors = $requestDirectors->fetchAll();
?>

<h1>Directors's List</h1>

<p>There's <?= $requestDirectors->rowCount() ?> directors</p>

<?php
foreach ($directors as $director) {
?>
    <a href="index.php?action=directorsDetails&id=<?= $director["idDirector"] ?>"><?= $director["firstname"] . " " . $director["surname"] . "<br>" ?></a>
<?php
}

?>

<br>
<a href="index.php?action=addDirector">Add a director</a>

<?php

$title = "Directors's List";
$secondary_title = "Directors's List";
$content = ob_get_clean();
require "view/template.php";
