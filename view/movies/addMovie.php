<?php ob_start();
?>

<h1>Add a movie</h1>





<?php

$title = "Add a movie";
$secondary_title = "Add a movie";
$content = ob_get_clean();
require "view/template.php";