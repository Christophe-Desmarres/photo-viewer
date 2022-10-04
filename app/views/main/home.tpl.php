<?php
$nom_dossier = "./assets/images/";

// open the directory choose
$dossierCourant = opendir($nom_dossier);
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

    <h2>Listes de dossiers</h2>
    <div class='folderList'>
        <?php
        foreach ($dossiers as $dossier) : ?>
            <a href="/images/<?= $dossier ?>"><button class='folderSelect' type='button' onclick='fileList'><?= $dossier ?></button></a>

        <?php endforeach; ?>

    </div>
    <div class="hr"></div>


    <h3>input type file multiple :</h3>
    <form method="post" enctype="multipart/form-data" action="/action_page.php">
        <div class="action">
            <label for="image_uploads">Choisi tes images à charger (PNG, JPG)</label>
            <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
        </div>
        <div class="preview">
            <p>No files currently selected for upload</p>
        </div>
        <div>
            <button>Submit</button>
        </div>
    </form>


    <div class="hr"></div>

</div>