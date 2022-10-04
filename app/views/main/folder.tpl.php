<?php

$nom_dossier = "./assets/images/" . $folder;
d($nom_dossier);
// open the directory choose
$dossierCourant = opendir($nom_dossier);
d($dossierCourant);
$chaine = [];
$dossiers = [];


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


<div class='container'>

    <h1 class="titre">Album <?= $folder ?></h1>
    <div class="preview">
        <ol class="image__list">
            <?php
            foreach ($chaine as $image) : ?>
                <li>
                    <div class='card'>
                        <img class="image__list-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $folder . "/" . $image ?>">
                        <p class='image__list-name'><?= $image ?></p>
                        <input type="checkbox" value="<?= $image ?>">
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>



</div>