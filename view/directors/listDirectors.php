<?php ob_start();
$directors = $requestDirectors->fetchAll();
?>

<section class="listDirectors section" id="listDirectors">

    <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search for a director.." title="Type in a name" aria-label="Search for a director by name" />

    <div class="listDirectors__container container">

        <?php
        foreach ($directors as $director) {
        ?>
            <figure class="director__card-listDirectors" title="<?= $director["firstname"] . " " . $director["surname"] ?>">
                <div class="card__header-listDirectors">
                    <a href="index.php?action=personDetails&id=<?= $director["idPerson"] ?>" aria-label="Details of <?= $director["firstname"] . " " . $director["surname"] ?>">
                        <img src="<?= $director["picture"] ?>" alt="Picture of <?= $director["firstname"] . " " . $director["surname"] ?>" loading="lazy" />
                    </a>
                    <div class="bg-card-hover">
                        <a href="index.php?action=personDetails&id=<?= $director["idPerson"] ?>" aria-label="Details of <?= $director["firstname"] . " " . $director["surname"] ?>">
                            <p class="text-hover">Born in <?= $director["birthdate"] ?></p>
                        </a>
                    </div>
                </div>

                <div class="card__description-listDirectors">
                    <a href="index.php?action=personDetails&id=<?= $director["idPerson"] ?>"><span><?= $director["firstname"] . " " . $director["surname"] ?></span></a>

                </div>

            </figure>
        <?php
        }

        ?>
    </div>

    <?php
    if ($session->isAdmin()) { ?>
        <button class="main__button list__button" aria-label="Add a person"><a href="index.php?action=addPerson">Add a person</a></button>
    <?php } ?>

</section>

<script>
    // Tuto W3Schools
    function myFunction() {
        var input, filter, container, figure, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        container = document.getElementsByClassName("listDirectors__container")[0];
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

$title = "Directors's List (" . $requestDirectors->rowCount() . ")";
$metaDescription = "Here is the list of the different director(s). There are currently " . $requestDirectors->rowCount() . " director(s) in our database.";
$secondary_title = "Directors's List (" . $requestDirectors->rowCount() . ")";
$content = ob_get_clean();
$hideBgImage = false;
require "view/template.php";
?>