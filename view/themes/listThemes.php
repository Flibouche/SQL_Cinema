<?php ob_start();
$themes= $requeteThemes->fetchAll();
?>

<h1>Liste des themes</h1>

<p>Il y a <?= $requeteThemes->rowCount() ?> themes</p>

<?php
foreach($themes as $theme) {
    echo $theme["typeName"]."<br>";
}

?>


<?php

$title = "Liste des themes";
$secondary_title = "Liste des themes";
$content = ob_get_clean();
require "view/template.php";