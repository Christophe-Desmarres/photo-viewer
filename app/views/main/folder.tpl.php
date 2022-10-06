<?php

$nom_dossier = "./assets/images/" . $folder;
// open the directory choose
$dossierCourant = opendir($nom_dossier);
$chaine = [];
$dossiers = [];


/**
 * 
 * 
 * test à faire avec scandir()
 * source : https://www.w3schools.com/php/func_directory_scandir.asp
 * 
 */


// boucle pour parcourir tous les éléments du dossier $nom_dossier 
while ($dossier = readdir($dossierCourant)) {
    // condition pour ne pas prendre le . (dossier en cours) et .. (dosier parent) et garder les dossier uniquement en jpg
    if ($dossier != "." && $dossier != ".." && strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "jpg") {
        $chaine[] = $dossier;
    } else if ($dossier != "." && $dossier != ".." && strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "") {
        $dossiers[] = $dossier;
    }
}

closedir($dossierCourant);

?>

<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">


<div class='container'>

    <h1 class="titre">Album <?= $folder ?></h1>
    <form class="galerie__preview" action="/cart" method="post">

        <button class="button__ordervalidate" type="submit" name="order">Valider mes choix pour impression</button>

        <div class="image__orderlist">
            <?php
            foreach ($chaine as $image) : ?>

                <figure class="image__list">
                    <img class="image__list-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $folder . "/" . $image ?>">
                    <figcaption class='image__list-name'><?= $image ?></figcaption>
                    <input class="img__inputselect" type="checkbox" value="<?= $image ?>" name="selected[]">
                </figure>

            <?php endforeach; ?>
        </div>
    </form>



</div>