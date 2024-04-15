<?php ob_start();
$editThemeName = $requestThemeID->fetch();
?>

<h1>Edit this theme : <?= $editThemeName["typeName"] ?></h1>
<form action="" method="post">

    <label class="">
        Rename this theme :
        <input class="" type="text" name="typeName" value="<?= $editThemeName['typeName']?>">
    </label>

    <input class="" type="submit" name="submit" value="Rename">

</form>





<?php

$title = "Edit a theme";
$secondary_title = "Edit a theme";
$content = ob_get_clean();
require "view/template.php";
