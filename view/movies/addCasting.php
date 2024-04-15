<?php ob_start();
?>

<h1>Add a casting</h1>

<form action="" method="post">

</form>


<?php

$title = "Add a casting";
$secondary_title = "Add a casting";
$content = ob_get_clean();
require "view/template.php";
