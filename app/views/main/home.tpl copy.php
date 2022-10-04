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
            <a href="/<?= $dossier ?>"><button class='folderSelect' type='button' onclick='fileList'><?= $dossier ?></button></a>

        <?php endforeach; ?>

    </div>
    <br />


    <div class='card'>
        <div class="preview">
            <ol>
                <?php
                foreach ($chaine as $image) : ?>
                    <li>
                        <img src="assets/images/<?= $image ?>">
                        <p class='titre'><?= $image ?></p>
                    </li>
            </ol>
        </div>
    <?php endforeach; ?>
    </div>




    <hr>
    <div class="container">
        <p> remettre le HTML ici </p>



    </div>
    <div class='vignette-card' style="background-image:url('<?= $image ?>')"></div>

    <hr>
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


    <hr>

</div>