<?php ob_start();
?>

<h1>Main</h1>

<?php

$title = "Main";
$secondary_title = "Main";
$content = ob_get_clean();
require "view/template.php";