<?php ob_start();
$directorsDetails = $requestDirectorsDetails->fetchAll();
?>

<h1>Details of : </h1>

<?php
foreach($directorsDetails as $directorDetails) {
    echo $directorDetails["firstname"]." ".$directorDetails["surname"]." ".$directorDetails["sex"]." ".$directorDetails["birthdate"]."<br>";
}

?>

<?php

$title = "Director's details";
$secondary_title = "Director's details";
$content = ob_get_clean();
require "view/template.php";
