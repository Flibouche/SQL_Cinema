<?php ob_start();
$actors = $requestActors->fetchAll();
?>

<section class="listActors section" id="listActors">

    <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search for an actor.." title="Type in a name">

    <div class="listActors__container container">

        <?php
        foreach ($actors as $actor) {
        ?>
            <figure class="actor__card-listActors" title="<?= $actor["firstname"] . " " . $actor["surname"] ?>">
                <div class="card__header-listActors">
                    <a href="index.php?action=personDetails&id=<?= $actor["idPerson"] ?>"><img src="<?= $actor["picture"] ?>" alt="Picture of <?= $actor["firstname"] . " " . $actor["surname"] ?>"></a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=personDetails&id=<?= $actor["idPerson"] ?>">
                            <p class="text-hover">Born in <?= $actor["birthdate"] ?></p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listActors">
                    <a href="index.php?action=personDetails&id=<?= $actor["idPerson"] ?>"><span><?= $actor["firstname"] . " " . $actor["surname"] ?></span></a>
                </div>

            </figure>
        <?php
        }

        ?>

    </div>

    <?php
    if ($session->isAdmin()) { ?>
        <button class="main__button list__button"><a href="index.php?action=addPerson">Add a person</a></button>
    <?php } ?>

</section>

<script>
    // Tuto W3Schools
    function myFunction() {
        var input, filter, container, figure, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        container = document.getElementsByClassName("listActors__container")[0];
        figure = container.getElementsByTagName("figure");

        for (i = 0; i < figure.length; i++) {
            title = figure[i].getElementsByTagName("span")[0];
            if (title) {
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    figure[i].style.display = "";
                } else {
                    figure[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php

$title = "Actor's list (" . $requestActors->rowCount() . ")";
$metaDescription = "Here is the list of the different actor(s). There are currently " . $requestActors->rowCount() . " actor(s) in our database.";
$secondary_title = "Actor's list (" . $requestActors->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>