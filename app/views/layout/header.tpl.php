<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($viewVars['currentPage']) ? $viewVars['currentPage'] . " | " : '' ?>Image Viewer</title>
    <link rel="stylesheet" href="<?= $router->generate('main-home') ?>assets/css/reset.css">
    <link rel="stylesheet" href="<?= $router->generate('main-home') ?>assets/css/style.css">

</head>

<body>

    <header>
        <a href="/"><img class="logo" src="<?= $router->generate('main-home') ?>assets/logo.png"></a>
        <h1 class="header--title">Image Viewer</h1>

        <?php

        include "../app/views/partials/nav.part.php";

        ?>


    </header>

    <main>