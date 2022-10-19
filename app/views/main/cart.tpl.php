<?php
$folder = "";
$nblight = 0;
$nblarge = 0;
?>

<div class='container'>

    <h1>panier</h1>

    <form class="cart__preview" action="/cart_send" method="post" autocomplete="off">

        <button class="button__ordervalidate" type="submit" name="ordertoprint">Valider mes choix pour impression</button>

        <table class="cart__view">
            <tr>
                <th>image</th>
                <th>dossier</th>
                <th>nom</th>
                <th>nb 10x15</th>
                <th>nb 15x20</th>
            </tr>

            <?php
            foreach ($liste as $index => $image) {
                $name = explode("/", $image)[1];
                if ($folder != explode("/", $image)[0]) {
                    $folder = explode("/", $image)[0];
                    echo "<h1 class='titre'>Album $folder</h1>";
                }
            ?>

                <tr class="row row<?= $index ?>">
                    <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $image ?>"></td>
                    <td><?= $folder ?></td>
                    <td><?= $name ?></td>
                    <td class="nblight">
                        <input class="nb" data-nblight="<?= $nblight ?>" name="selected[<?= preg_replace('/ /', '_', $image) ?>][light]" value="<?= $nblight ?>">
                        <div>
                            <button class="plus light" type="button" name="plus">+</button>
                            <button class="minus light" type="button" name="minus">-</button>
                        </div>
                    </td>
                    <td class="nblarge">
                        <input class="nb" data-nblarge="<?= $nblarge ?>" name="selected[<?= preg_replace('/ /', '_', $image) ?>][large]" value="<?= $nblarge ?>">
                        <div>
                            <button class="plus large" type="button" name="plus">+</button>
                            <button class="minus large" type="button" name="minus">-</button>
                        </div>

                    </td>
                </tr>

            <?php
            };
            ?>
        </table>
        <div class="input__list">
            <input class="input__customer" placeholder="Pseudo" type="text" id="pseudo" name="customer['pseudo']" autocomplete="off" required autofocus>
            <input class="input__customer" placeholder="email" type="email" id="email" name="customer['email']" autocomplete="off" required>
            <input class="input__customer" placeholder="Nom" type="text" id="lastname" name="customer['lastname']" autocomplete="off" required>
            <input class="input__customer" placeholder="Prénom" type="text" id="firstname" name="customer['firstname']" autocomplete="off" required>
        </div>

    </form>



</div>