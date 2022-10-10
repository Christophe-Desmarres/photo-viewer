<?php

use App\Models\Photo;

$folder = "";

d($_POST);
?>

<div class='container'>

    <h1>panier</h1>



    <form class="cart__preview" action="/print" method="post">

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
                foreach ($_POST as $image => $size) {
                    if ($image !== 'ordertoprint') {
                        $name = explode("/", $image)[1];
                        $name = preg_replace('/_jpg/', '.jpg', $name);

                        if ($folder != explode("/", $image)[0]) {
                            $folder = explode("/", $image)[0];
                            echo "<h1 class='titre'>Album $folder</h1>";
                        }

                        // echo  "<br>" . $image;
                        // echo  "<br>" . $size['light'] . " 10x15cm";
                        // echo  "<br>" . $size['large'] . " 15x20cm";

                        $photo = new Photo($name, $folder, $size['light'], $size['large']);
                ?>

                        <tr class="row row<?= $index ?>">
                            <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $photo->folder . "/" . $photo->name ?>"></td>
                            <td><?= $photo->folder ?></td>
                            <td><?= $photo->name ?></td>
                            <td class="nblight">
                                <p type="number" class="nb" data-nblight="<?= $photo->nblight ?>"><?= $photo->nblight ?></p>
                            </td>
                            <td class="nblarge">
                                <p class="nb" data-nblarge="<?= $photo->nblarge ?>"><?= $photo->nblarge ?></p>

                            </td>
                        </tr>

                <?php

                    }
                }; ?>
            </table>

        </div>
    </form>



</div>