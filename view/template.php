<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ========================== FONT AWESOME =======================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ========================== CSS =======================-->
    <link rel="stylesheet" href="img/css/style.css" />

    <title><?= $title ?></title>
</head>

<body>
    <header class="header" id="header">
        <nav>
            <a href="index.php" role="button">Home Page</a>
            <a href="index.php?action=listFilms" role="button">Movies</a>
            <a href="index.php?action=listActeurs" role="button">Acteurs</a>
            <a href="index.php?action=listDirectors" role="button">Directors</a>
            <a href="index.php?action=listRoles" role="button">Roles</a>
            <a href="index.php?action=listThemes" role="button">Themes</a>
        </nav>
    </header>
    <div id="wrapper">
        <main>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $secondary_title ?></h2>
                <?= $content ?>
            </div>
        </main>
    </div>
</body>

</html>