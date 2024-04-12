<?php ob_start();
?>

<h1>Add a theme</h1>
<form action="" method="post">

    <label class="">
        Movie theme name :
        <input class="" type="text" name="theme">
    </label>

    <input class="" type="submit" name="submit" value="Add theme">

</form>





<?php

$title = "Add a theme";
$secondary_title = "Add a theme";
$content = ob_get_clean();
require "view/template.php";
