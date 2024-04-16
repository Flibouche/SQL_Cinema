<?php ob_start();
$themesDetails = $requestThemesDetails->fetchAll();
$themeID = $requestThemeID->fetch();
?>

<h1>Details of : </h1>

<?php
foreach ($themesDetails as $themeDetails) {
?>
    <a href="index.php?action=moviesDetails&id=<?= $themeDetails["idMovie"] ?>"><?= $themeDetails["title"] . "<br>" ?></a>
<?php
}
?>



<br>
<?php
// Vérifiez s'il y a au moins un thème
if (!empty($themesDetails)) {
    // Lien "Edit this theme" pointant vers le premier thème de la liste
?>
    <a href="index.php?action=editTheme&id=<?= $themesDetails[0]["idTheme"] ?>">Edit this theme</a>
<?php
} else {
    // Gérer le cas où il n'y a aucun thème
    echo "No movie found.";
}
?>

<br>
<a href="index.php?action=delTheme&id=<?= $themeID["idTheme"] ?>" type="submit" name="submit">Delete theme</a>

<?php

$title = "List of movies by theme";
$secondary_title = "List of movies by theme";
$content = ob_get_clean();
require "view/template.php";
