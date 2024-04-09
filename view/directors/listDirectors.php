<?php ob_start();
$directors= $requeteDirectors->fetchAll();
?>

<h1>Liste des directors</h1>

<p>Il y a <?= $requeteDirectors->rowCount() ?> directors</p>

<?php
foreach($directors as $director) {
    echo $director["firstname"]." ".$director["surname"]."<br>";
}

?>


<?php

$title = "Liste des directors";
$secondary_title = "Liste des directors";
$content = ob_get_clean();
require "view/template.php";