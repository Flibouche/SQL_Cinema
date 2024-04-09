<?php ob_start();
$acteurs = $requeteActeurs->fetchAll();
?>

<h1>Liste des acteurs</h1>

<p>Il y a <?= $requeteActeurs->rowCount() ?> acteurs</p>

<?php
foreach ($acteurs as $acteur) {
?>
    <a href=""><?php echo $acteur["firstname"] . " " . $acteur["surname"] . "<br>" ?></a>
<?php
}

?>


<?php

$title = "Liste des acteurs";
$secondary_title = "Liste des acteurs";
$content = ob_get_clean();
require "view/template.php";
