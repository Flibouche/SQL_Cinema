<?php ob_start();
?>

<h1>Add a theme</h1>
<form action="" method="post">
    <p>
        <label class="">
            Movie theme name :
            <input class="" type="text" name="theme">
        </label>
    </p>
    <p>
        <input class="" type="submit" name="submit" value="Add theme">
    </p>
</form>





<?php

$title = "Add a theme";
$secondary_title = "Add a theme";
$content = ob_get_clean();
require "view/template.php";