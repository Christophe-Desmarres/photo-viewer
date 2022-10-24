<?php
d($_POST);
d($_SESSION);

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

    <h1>Espace Administration</h1>




// TODO <br>
// je récupere la liste des commandes non réalisée <br>
// je clique sur le bouton pour récupérer la commande (création des dossiers avec les images dedans ou impression directe) <br>
// modification du status de la commande comme réalisée <br>
<br>




















    <form class="upload__form" action="/upload" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input class="input__name" type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>










    <div class='folderList'>
        <?php
        foreach ($dossiers as $dossier) : ?>
            <a href="/images/<?= $dossier ?>"><button class='folderSelect' type='button' onclick='fileList'><?= $dossier ?></button></a>

        <?php endforeach; ?>

    </div>
    <div class="hr"></div>


    <h3>Chargement des images :</h3>
    <form class="upload__form" method="post" enctype="multipart/form-data" action="/action_page.php">
        <input class="input__name" type="text" placeholder="choisi un nom de dossier">
        <div class="action">
            <label for="image_uploads">Choisi tes images à charger (PNG, JPG)</label>
            <input class="input__name" type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
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