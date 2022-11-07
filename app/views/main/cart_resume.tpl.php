<?php
d($_SESSION);
d($viewVars);
d($_POST);
?>
<div class='container'>

    <h1>Récapitulatif de la commande</h1>



    <form class="cart__preview" action="/print" method="post">

        <div class="cart__preview--button">
            <button class="button__ordervalidate" type="submit" name="print">Valider mes choix pour impression</button>
            <button class="button__ordervalidate" type="submit" name="other_order">Commander d'autres photos</button>
        </div>

        <p class="cart__preview--customer">Référence client : <?= $customer['firstname'] ?> <?= $customer['lastname'] ?> dit "<?= $customer['pseudo'] ?>"</p>
        <p class="cart__preview--customer">Email : <?= $customer['email'] ?></p>

        <table>
            <tr class="row end">
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
            <tr class="row end">
                <td>Quantité</td>
                <td></td>
                <td></td>
                <td> <?= $price_light ?></td>
                <td><?= $price_large ?></td>
            </tr>
            <tr class="row end">
                <td></td>
                <td></td>
                <td></td>
                <td><?= $price_light * $lightprice ?>€</td>
                <td><?= $price_large * $largeprice ?>€</td>
            </tr>
            <tr class="row end">
                <td>TOTAL</td>
                <td></td>
                <td><?= $price_light + $price_large?></td>
                <td>impressions</td>
                <td><?= $price_light * $lightprice + $price_large * $largeprice ?>€</td>
            </tr>
        </table>

    </form>

</div>