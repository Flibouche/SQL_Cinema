<?php ob_start();
$actorsDetails = $requestActorsDetails->fetchAll();
?>

<h1>Details of : </h1>

<?php
foreach($actorsDetails as $actorDetails) {
    echo $actorDetails["firstname"]." ".$actorDetails["surname"]." ".$actorDetails["sex"]." ".$actorDetails["birthdate"]."<br>";
}

?>

<?php

$title = "Actor's details";
$secondary_title = "Actor's details";
$content = ob_get_clean();
require "view/template.php";
