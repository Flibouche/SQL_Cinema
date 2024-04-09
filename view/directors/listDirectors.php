<?php ob_start();
$directors = $requestDirectors->fetchAll();
?>

<h1>Directors's List</h1>

<p>There's <?= $requestDirectors->rowCount() ?> directors</p>

<?php
foreach($directors as $director) {
    echo $director["firstname"]." ".$director["surname"]."<br>";
}

?>


<?php

$title = "Directors's List";
$secondary_title = "Directors's List";
$content = ob_get_clean();
require "view/template.php";