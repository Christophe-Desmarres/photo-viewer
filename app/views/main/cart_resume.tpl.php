<?php

use App\Models\Photo;

$folder = "";

d($_POST);
?>

<div class='container'>

    <h1>Récapitulatif de la commande</h1>



    <form class="cart__preview" action="/print" method="post">

        <button class="button__ordervalidate" type="submit" name="print">Valider mes choix pour impression</button>

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
                foreach ($_POST as $image => $size) {
                    if ($image !== 'ordertoprint') {
                        // selectionne uniquement le nom de l'image
                        $name = explode("/", $image)[1];
                        // remplace le _jpg par .jpg du au changement de nom automatique lors du passage en tableau indexé du nom avec light ou large
                        $name = preg_replace('/_jpg/', '.jpg', $name);

                        if ($folder != preg_replace('/_/', ' ', explode("/", $image)[0])) {
                            // même principe avec le nom du dossier qu'avec le nom du fichier
                            $folder = explode("/", $image)[0];
                            // les espaces du nom de dossiers sont remplacés automatiquement par des '_' donc on remets des espaces
                            $folder = preg_replace('/_/', ' ', $folder);

                            echo "<h1 class='titre'>Album $folder</h1>";
                        }

                        // echo  "<br>" . $image;
                        // echo  "<br>" . $size['light'] . " 10x15cm";
                        // echo  "<br>" . $size['large'] . " 15x20cm";

                        $photo = new Photo($name, $folder, $size['light'], $size['large']);
                ?>

                        <tr class="row row<?= $image ?>">
                            <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $photo->folder . "/" . $photo->name ?>"></td>
                            <td><?= $photo->folder ?></td>
                            <td><?= $photo->name ?></td>
                            <td class="nblight">
                                <input class="nb" name="nblight/<?= $photo->folder . "/" . $photo->name ?>" value="<?= $photo->nblight ?>">
                            </td>
                            <td class="nblarge">
                                <input class="nb" name="nblarge/<?= $photo->folder . "/" . $photo->name ?>" value="<?= $photo->nblarge ?>">
                            </td>
                        </tr>

                <?php

                    }
                }; ?>
            </table>

        </div>
    </form>



</div>