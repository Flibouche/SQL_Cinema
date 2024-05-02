<?php ob_start();
$movie = $requestMovies->fetch();
?>

<section class="addCasting section" id="addCasting">

    <div class="addCasting__container container">

        <form action="index.php?action=addCasting&id=<?= $movie['idMovie'] ?>" method="POST">

            <div class="form__group">
                <label for="title"> Movie : *</label>
                <select id="title" name="idMovie" id="title">
                    <option value="<?= $movie["idMovie"] ?>" selected required><?= $movie["title"] ?></option>
                </select>
            </div>

            <div class="form__group">
                <label for="actor">Actor : *</label>
                <select id="actor" name="idActor" id="actor">
                    <?php
                    foreach ($requestActors->fetchAll() as $actor) {
                    ?>
                        <option value="<?= $actor["idActor"] ?>" required><?= $actor["firstname"] . " " . $actor["surname"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form__group">
                <label for="role">Role : *</label>
                <select id="role" name="idRole">
                    <?php
                    foreach ($requestRoles->fetchAll() as $role) {
                    ?>
                        <option value="<?= $role["idRole"] ?>" required><?= $role["roleName"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <button class="main__button form" type="submit" name="submit" value="Add casting"><span>Add to cast</span></button>

        </form>

    </div>

</section>

<?php

$title = "Add a casting to the movie : " . $movie["title"];
$metaDescription = "Here is the form where you can add an actor to the cast of the movie '" . $movie["title"] . "'";
$secondary_title = "Add a casting to the movie : " . $movie["title"];
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>