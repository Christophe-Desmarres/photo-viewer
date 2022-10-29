<div class='container'>

    <h1>Espace Administration</h1>
    <?php
    if (count($liste) != 0) {
    ?>
        <table class="cart__view">
            <tr>
                <th>id</th>
                <th>numéro commande</th>
                <th>status</th>
                <th>pseudo</th>
                <th>Prénom Nom</th>
                <th>Email</th>
                <th>10x15</th>
                <th>15x20</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($liste as $index => $order) {
            ?>

                <tr class="row row<?= $index ?>">
                    <td><?= $order['id_request'] ?></td>
                    <td><?= $order['id_order'] ?></td>
                    <td class="<?= $order['order_status'] ?>"><?= $order['order_status'] == 'pending' ? 'en attente' : 'imprimée' ?></td>
                    <td><?= $order['user_name'] ?></td>
                    <td><?= $order['firstname'] . " " . $order['lastname'] ?></td>
                    <td><?= $order['email'] ?></td>
                    <td><?= $order['10x15'] ?></td>
                    <td><?= $order['15x20'] ?></td>
                    <td><?= $order['10x15'] * 2 + $order['15x20'] * 4 ?>€</td>
                    <td>
                        <a href="/impression/<?= $order['id_request'] ?>"><img class="image__cartlist-icon" src="<?= $router->generate('main-home') ?>assets/images/printer.png"></a>
                    </td>
                </tr>

        <?php
            };
        } else {
            // sinon j'indique que le panier est vide
            echo "<p class='empty'>Pas de commande en cours</p>";
        }
        ?>
        </table>

</div>