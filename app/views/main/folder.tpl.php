<?php         
d($_POST);
d($_SESSION);
 ?>
<div class='container'>

    <h1 class="titre">Album <?= $folder ?></h1>

    <form class="galerie__preview" action="/cart" method="post">

        <button class="button__ordervalidate" type="submit" name="order">Sélection terminée pour commande</button>

        <div class="image__orderlist">
            <?php foreach ($chaine as $index => $image) : ?>
                <figure class="image__list">
                    <label class="img__labelselect">
                        <img class="image__list-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $folder . "/" . $image ?>">
                        <img class="filigramme" src="<?= $router->generate('main-home') ?>assets/logo.png">
                        <figcaption class='image__list-name'><?= $image ?></figcaption>
                        <input class="img__inputselect" type="checkbox" value="<?= $folder . "/" . $image ?>" name="selected[]" <?= in_array("$folder/$image",$_SESSION['OrderPhotoListName'])?"checked":"" ?>>
                    </label>
                </figure>
            <?php endforeach; ?>
        </div>
    </form>

</div>