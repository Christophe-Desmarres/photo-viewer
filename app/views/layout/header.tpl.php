<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $router->generate('main-home') ?>assets/images/favicon.ico">
    <title><?= isset($viewVars['currentPage']) ? $viewVars['currentPage'] . " | " : '' ?>Image Viewer</title>
    <link rel="stylesheet" href="<?= $router->generate('main-home') ?>assets/css/reset.css">
    <link rel="stylesheet" href="<?= $router->generate('main-home') ?>assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

</head>

<body>

    <header>
        <div class="banniere">
            <a href="/"><img class="logo" src="<?= $router->generate('main-home') ?>assets/logo.png"></a>
            <h1 class="header--title">CD Mar Photo</h1>
            <video width="320" controls autoplay loop muted>
                <source src="<?= $router->generate('main-home') ?>assets/video/diapo stage danse 2022.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <?php

        include "../app/views/partials/nav.part.php";

        ?>

    </header>

    <main>
        <p class="session "><?= isset($_SESSION) ? 'commande en cours : ' . $_SESSION['id_order'] : "" ?></p>
        <p class="session "><?= isset($_SESSION) ? 'pseudo : ' . $_SESSION['customer']['pseudo'] : "" ?></p>
        <p id="message" class="<?= isset($message) ? $message[0] : "hidden" ?>"><?= isset($message) ? $message[1] : "" ?></p>