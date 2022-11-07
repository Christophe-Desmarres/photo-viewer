<?php
d($_SESSION);
d($_POST);
?>
<div class='container'>

    <h1 class="titre">Choisissez un cours</h1>
    <?php

    include "../app/views/partials/searchbar.part.php";

    ?>
    <div class='folderList'>
        <?php foreach ($dossiers as $dossier) : ?>
            <a class="folder" href="/images/<?= $dossier ?>"><button class='folderSelect'><?= $dossier ?></button></a>
        <?php endforeach; ?>
    </div>

</div>