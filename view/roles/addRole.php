<?php ob_start();
?>

<h1>Add a role</h1>
<form action="" method="post">

    <label class="">
        Role name :
        <input class="" type="text" name="role">
    </label>

    <div>
        <input class="" type="submit" name="submit" value="Add role">
    </div>

</form>

<?php

$title = "Add a role";
$secondary_title = "Add a role";
$content = ob_get_clean();
require "view/template.php";
