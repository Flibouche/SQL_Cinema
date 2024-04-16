<?php ob_start();
$movie = $requestMovies->fetch();
?>

<h1>Add a casting</h1>

<form action="" method="post">

    <div>
        <label for="">
            Movie :
            <select name="idMovie" id="">
                <option value="<?= $movie["idMovie"] ?>" ><?= $movie["title"] ?></option>
            </select>
        </label>
    </div>

    <div>
        <label for="">
            Actors :
            <select name="idActor" id="">
                <?php
                foreach ($requestActors->fetchAll() as $actor) {
                ?>
                    <option value="<?= $actor["idActor"] ?>"><?= $actor["firstname"] . " " . $actor["surname"] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
    </div>

    <div>
        <label for="">
            Role :
            <select name="idRole" id="">
                <?php
                foreach ($requestRoles->fetchAll() as $role) {
                ?>
                    <option value="<?= $role["idRole"] ?>"><?= $role["roleName"] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
    </div>

    <div>
        <input class="" type="submit" name="submit" value="Add casting">
    </div>


</form>


<?php

$title = "Add a casting";
$secondary_title = "Add a casting";
$content = ob_get_clean();
require "view/template.php";
