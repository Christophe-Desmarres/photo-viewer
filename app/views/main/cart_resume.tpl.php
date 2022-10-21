<?php
d($_POST);
d($liste);
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
                    // d($image);
                    // d($size);
                    // selectionne uniquement le nom de l'image
                    //$name = explode("/", $image)[1];
                    // remplace le _jpg par .jpg du au changement de nom automatique lors du passage en tableau indexé du nom avec light ou large
                    //$name = preg_replace('/_jpg/', '.jpg', $name);

                    // if ($folder != preg_replace('/_/', ' ', explode("/", $image)[0])) {
                    //     // même principe avec le nom du dossier qu'avec le nom du fichier
                    //     $folder = explode("/", $image)[0];
                    //     // les espaces du nom de dossiers sont remplacés automatiquement par des '_' donc on remets des espaces
                    //     $folder = preg_replace('/_/', ' ', $folder);

                    //     echo "<h1 class='titre'>Album $folder</h1>";
                    // }

                    $price_light += $image->nblight;
                    $price_large += $image->nblarge;
            ?>

                    <tr class="row row<?= $image->id ?>">
                        <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $image->folder . "/" . $image->name ?>"></td>
                        <td><?= $image->folder ?></td>
                        <td><?= $image->name ?></td>
                        <td class="nblight">
                            <input class="nb" style="color:<?= $image->nblight == 0 ? "red" : "" ?>;" name="nblight/<?= $image->name ?>" value="<?= $image->nblight ?>">
                        </td>
                        <td class="nblarge">
                            <input class="nb" style="color:<?= $image->nblarge == 0 ? "red" : "" ?>;" name="nblarge/<?= $image->name ?>" value="<?= $image->nblarge ?>">
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