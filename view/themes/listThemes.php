<?php ob_start();
$themes = $requestThemes->fetchAll();
?>

<h1>Themes's List</h1>

<p>There's <?= $requestThemes->rowCount() ?> themes</p>

<?php
foreach($themes as $theme) {
    echo $theme["typeName"]."<br>";
}

?>


<?php

$title = "Themes's List";
$secondary_title = "Themes's List";
$content = ob_get_clean();
require "view/template.php";