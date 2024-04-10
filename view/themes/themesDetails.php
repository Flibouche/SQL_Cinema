<?php ob_start();
$themesDetails = $requestThemesDetails->fetchAll();
?>

<h1>Details of : </h1>

<?php
foreach ($themesDetails as $themeDetails) {
?>
    <a href="index.php?action=moviesDetails&id=<?= $themeDetails["idMovie"] ?>"><?= $themeDetails["title"] . "<br>" ?></a>
<?php
}
?>

<?php

$title = "List of movies by theme";
$secondary_title = "List of movies by theme";
$content = ob_get_clean();
require "view/template.php";
