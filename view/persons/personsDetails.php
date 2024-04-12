<?php ob_start();
?>

<h1>Details of : </h1>


<?php

$title = "Person's details";
$secondary_title = "Person's details";
$content = ob_get_clean();
require "view/template.php";
