<?php         
d($_POST);
d($_SESSION);
 ?>
<div class='container'>

    <h1>Récapitulatif de la commande</h1>



    <form class="cart__preview" action="/print" method="post">

        <div class="cart__preview--button">
            <button class="button__ordervalidate" type="submit" name="print">Valider mes choix pour impression</button>
            <button class="button__ordervalidate" type="submit" name="other_order">Commander d'autres photos</button>
        </div>
        <div>reference client :
            <p>Pseudo : <?= $customer['pseudo'] ?></p>
            <p>Email : <?= $customer['email'] ?></p>
            <p>Prénom : <?= $customer['firstname'] ?></p>
            <p>Nom : <?= $customer['lastname'] ?></p>
        </div>


        <table>
            <tr>
                <th>Image</th>
                <th>Dossier</th>
                <th>Nom</th>
                <th>format 10x15cm</th>
                <th>format 15x20cm</th>
            </tr>

            <?php
            $folder = "";
            $price_light = 0;
            $price_large = 0;
            foreach ($liste as $index => $image) {
                if ($image !== 'ordertoprint') {
                    $price_light += $image->nblight;
                    $price_large += $image->nblarge;
            ?>

                    <tr class="row row<?= $image->id ?>">
                        <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $image->folder . "/" . $image->name ?>"></td>
                        <td><?= $image->folder ?></td>
                        <td><?= $image->name ?></td>
                        <td class="nblight">
                            <input class="nb" style="background-color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "red" : "" ?>; color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "white" : ($image->nblight == 0 ? "red" : "") ?>;" name="nblight/<?= $image->folder . "/" . $image->name ?>" value="<?= $image->nblight ?>">
                        </td>
                        <td class="nblarge">
                            <input class="nb" style="background-color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "red" : "" ?>; color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "white" : ($image->nblarge == 0 ? "red" : "") ?>;" name="nblarge/<?= $image->folder . "/" . $image->name ?>" value="<?= $image->nblarge ?>">
                        </td>
                    </tr>

            <?php

                }
            }; ?>
            <tr class="row">
                <td>TOTAL</td>
                <td></td>
                <td></td>
                <td><?= $price_light ?></td>
                <td><?= $price_large ?></td>
            </tr>
        </table>
        <table>


        </table>

        <p> <?= $price_light ?> photos au format 10x15cm : <?= $price_light * 2 ?>€</p>
        <p><?= $price_large ?> photos au format 15x20cm : <?= $price_large * 3 ?>€</p>
        <p>cout total : <?= $price_light * 2 + $price_large * 3 ?>€</p>

    </form>



</div>