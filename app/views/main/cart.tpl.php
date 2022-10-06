<?php

use App\Models\Photo;

$folder = "";
$light = 0;
?>

<div class='container'>

    <h2>panier</h2>



    <form class="cart__preview" action="/cart_validate" method="post">

        <button class="button__ordervalidate" type="submit" name="order">Valider mes choix pour impression</button>

        <div>

            <table>
                <tr>
                    <th>image</th>
                    <th>dossier</th>
                    <th>nom</th>
                    <th>nb 10x15</th>
                    <th>nb 15x20</th>
                </tr>

                <?php
                foreach ($_POST['selected'] as $index => $image) {
                    $name = explode("/", $image)[1];
                    if ($folder != explode("/", $image)[0]) {
                        $folder = explode("/", $image)[0];
                        echo "<h1 class='titre'>Album $folder</h1>";
                    }
                    $photo = new Photo($image, $folder);
                ?>

                    <tr class="row row<?= $index ?>">
                        <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $image ?>"></td>
                        <td><?= $photo->folder ?></td>
                        <td><?= $photo->name ?></td>
                        <td id="nblight">
                            <p data-nblight="<?= $photo->nblight ?>"><?= $photo->nblight ?></p>
                            <div>
                                <button class="plus" type="button" name="plus">+</button>
                                <button class="minus" type="button" name="minus">-</button>
                            </div>
                        </td>
                        <td id="nblarge<?= $index ?>"><?= $photo->nblarge ?></td>
                    </tr>

                <?php }; ?>
            </table>

        </div>
    </form>



</div>