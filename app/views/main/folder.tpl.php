<?php
d($_SESSION);
d($_POST);
?>
<div class='container'>

    <h1 class="titre">Album <?= $folder ?></h1>


    <form class="galerie__preview" action="/cart" method="post">


        <?php
        if ($chaine != []) : ?>
            <div class="buttonchoice">
                <button class='button__ordervalidate' type='submit' name='back'>Annuler</button>
                <div class="loader" id="loading"></div>
                <button class='button__ordervalidate' type='submit' name='ordervalidate'>Ajouter au panier <span id="count"></span></button>
            </div>
            <div class='image__orderlist'>
                <?php
                foreach ($chaine as $index => $image) : ?>
                    <figure class="image__list">
                        <label class="img__labelselect">
                            <img class="image__list-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $folder . "/" . $image ?>">
                            <img class="filigramme" src="<?= $router->generate('main-home') ?>assets/logo.png">
                            <figcaption class='image__list-name'><?= $image ?></figcaption>
                            <input class="img__inputselect" type="checkbox" value="<?= $folder . "/" . $image ?>" name="selected[]" <?= (isset($_SESSION['OrderPhotoListName']) && in_array("$folder/$image", $_SESSION['OrderPhotoListName'])) ? "checked" : "" ?>>
                        </label>
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php else :
            echo "<p class='empty'>Il n'y a pas encore de photos disponibles</p>";
            echo "<a href='/' style='color:#222;'>Cliquez ici pour revenir aux autres cours</a>";

        endif;
        ?>
    </form>

</div>