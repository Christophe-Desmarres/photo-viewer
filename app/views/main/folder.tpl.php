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

// boucle pour renommer les noms de fichier sans espace
while ($dossier = readdir($dossierCourant)) {
    if ($dossier != "." && $dossier != "..") {
        $str = preg_replace('/\s+/', '', $dossier);
        // echo "<br> nom du fichier : $dossier";
        // echo "<br>Avant : $nom_dossier/$dossier";
        // echo "<br>Après : $nom_dossier/$str<br>";
        rename("$nom_dossier/$dossier", "$nom_dossier/$str");
    }
}
// Je ferme le dossier puis le réouvre pour le réutiliser dès le début
closedir($dossierCourant);
$dossierCourant = opendir($nom_dossier);

// boucle pour parcourir tous les éléments du dossier $nom_dossier 
while ($dossier = readdir($dossierCourant)) {
    // condition pour ne pas prendre le . (dossier en cours) et .. (dossier parent) et garder les fichiers uniquement en jpg
    if ($dossier != "." && $dossier != "..") {
        if (strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "jpg") {
            $chaine[] = $dossier;
        } else if (strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "") {
            $dossiers[] = $dossier;
        }
    }
}

closedir($dossierCourant);

?>



<div class='container'>

    <h1 class="titre">Album <?= $folder ?></h1>

    <form class="galerie__preview" action="/cart" method="post">

        <button class="button__ordervalidate" type="submit" name="order">Sélection terminé</button>

        <div class="image__orderlist">
            <?php
            foreach ($chaine as $index => $image) : ?>

                <figure class="image__list">
                    <img class="image__list-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $folder . "/" . $image ?>">
                    <img class="filigramme" src="<?= $router->generate('main-home') ?>assets/logo.png">
                    <figcaption class='image__list-name'><?= $image ?></figcaption>
                    <input class="img__inputselect" type="checkbox" value="<?= $folder . "/" . $image ?>" name="selected[]">
                </figure>

            <?php endforeach; ?>
        </div>
    </form>



</div>