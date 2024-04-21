<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ========================== FONT AWESOME =======================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ========================== CSS =======================-->
    <link rel="stylesheet" href="public/css/style.css" />

    <title><?= $title ?></title>
</head>

<body>
    <!--========================== HEADER ===========================-->
    <header class="header" id="header">

        <!-- <img class="background__header" src="public/img/header.svg" alt="Background header"> -->

        <nav class="nav container">
            <a href="index.php" class="nav__logo">
                <img src="public/img/bxs-planet.svg" alt="Logo CineDune">CinEDunE
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

                    <li class="nav__item">
                        <a href="index.php?action=listSubmissions">Submission</a>
                    </li>
                </ul>

                <!-- Close button -->
                <div class="nav__close" id="nav-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="nav__actions">
                <!-- Toggle Button -->
                <div class="nav__toggle" id="nav-toggle">
                    <i class="fa-solid fa-bars"></i>
                </div>

            </div>

        </nav>
    </header>

    <!--========================== MAIN ===========================-->
    <div id="wrapper">
        <main>
            <div id="content">
                <h2><?= $secondary_title ?></h2>
                <?= $content ?>
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class="footer__container container grid">

        </div>
    </footer>

    <!--========================== JQUERY & MATERIALIZE ==========================-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                indicators: true
            });
        });
    </script>

    <!--========================== MAIN JS ==========================-->
    <script src="public/js/main.js"></script>

</body>

</html>