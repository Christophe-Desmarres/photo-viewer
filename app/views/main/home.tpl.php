<?php
d($_SESSION);
?>

<div class='container'>

    <h1>Listes de dossiers</h1>

    <p class="description">choissisez un cours</p>

    <div class='folderList'>
        <?php foreach ($dossiers as $dossier) : ?>
            <a href="/images/<?= $dossier ?>"><button class='folderSelect' type='button' onclick='fileList'><?= $dossier ?></button></a>
        <?php endforeach; ?>
    </div>

</div>