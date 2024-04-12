<?php ob_start();
?>

<h1>Add a person</h1>

<form action="" method="post">
    <p>
        <label class="">
            Actor name :
            <input class="" type="text" name="actor">
        </label>
    <p>
        <input class="" type="submit" name="submit" value="Add actor">
    </p>
</form>



<?php

$title = "Add a person";
$secondary_title = "Add a person";
$content = ob_get_clean();
require "view/template.php";