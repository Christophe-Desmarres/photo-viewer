<?php
d($_POST);
d($_SESSION);
?>


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
                    <th>Action</th>
                </tr>

                <?php
                foreach ($liste as $index => $order) {
                ?>

                    <tr class="row row<?= $index ?>">
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['id_order'] ?></td>
                        <td><?= $order['order_status']=='pending'?'en attente':'imprimée' ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= $order['firstname'] . " " . $order['lastname'] ?></td>
                        <td><?= $order['email'] ?></td>
                        <td>
                            <a href="/impression/<?= $order['id'] ?>"><img class="image__cartlist-icon" src="<?= $router->generate('main-home') ?>assets/images/printer.png"></a>
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



<p>
    // TODO <br>
    // je récupere la liste des commandes non réalisée <br>
    // je clique sur le bouton pour récupérer la commande (création des dossiers avec les images dedans ou impression directe) <br>
    // modification du status de la commande comme réalisée <br>
</p>
<br>




<h3>Chargement des images : 2 form en hidden</h3>


    <form class="upload__form hidden" action="/upload" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input class="input__name" type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>


    <form class="upload__form hidden" method="post" enctype="multipart/form-data" action="/action_page.php">
        <input class="input__name" type="text" placeholder="choisi un nom de dossier">
        <div class="action">
            <label for="image_uploads">Choisi tes images à charger (PNG, JPG)</label>
            <input class="input__name" type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
        </div>
        <div class="preview">
            <p>No files currently selected for upload</p>
        </div>
        <div>
            <button>Submit</button>
        </div>
    </form>

</div>