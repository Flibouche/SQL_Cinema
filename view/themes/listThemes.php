<?php ob_start();
$themes = $requestThemes->fetchAll();
?>

<h1>Themes's List</h1>

<p>There's <?= $requestThemes->rowCount() ?> themes</p>

<?php
foreach ($themes as $theme) {
?>
    <a href="index.php?action=themesDetails&id=<?= $theme["idTheme"] ?>"><?= $theme["typeName"] . "<br>" ?></a>
<?php
}

?>

<?php

$title = "Themes's List";
$secondary_title = "Themes's List";
$content = ob_get_clean();
require "view/template.php";
