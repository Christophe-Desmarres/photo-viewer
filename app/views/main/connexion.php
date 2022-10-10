<?php
$nom_dossier = "./assets/images/";
?>

<div class='container'>

    <h2>Connexion / Inscription</h2>
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