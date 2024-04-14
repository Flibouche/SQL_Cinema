<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ========================== FONT AWESOME =======================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ========================== SWIPER =======================-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- ========================== CSS =======================-->
    <link rel="stylesheet" href="public/css/style.css" />

    <title><?= $title ?></title>
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav__logo">
                <img src="public/img/bxs-planet.svg" alt="Logo CineDune">CineDune
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.php">Home Page</a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?action=listMovies">Movies</a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?action=listActors">Actors</a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?action=listDirectors">Directors</a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?action=listRoles">Roles</a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?action=listThemes">Themes</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div id="wrapper">
        <main>
            <div id="content">
                <h1>CineDune</h1>
                <h2><?= $secondary_title ?></h2>
                <?= $content ?>
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class="footer__container container grid">

        </div>
    </footer>

    <!--========================== SWIPER ==========================-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
        </script>

</body>

</html>