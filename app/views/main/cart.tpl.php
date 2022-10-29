<?php
d($_SESSION);
d($_POST);
?>
<div class='container'>

     <form class="cart__preview" action="/cart_send" method="post" autocomplete="off">
         <?php
            // si le panier n'est pas vide, j'affiche le tableau
            if (count($liste) != 0) {
            ?>
             <h1>Panier</h1>
             <p>Commande n° <?= $_SESSION['id_order'] ?></p>

             <div class="input__list">
                 <input class="input__customer" placeholder="Nom" type="text" id="lastname" name="customer[lastname]" value="<?= isset($_SESSION['customer']) ? $customer['lastname'] : "" ?>" autocomplete="off" required>
                 <input class="input__customer" placeholder="Prénom" type="text" id="firstname" name="customer[firstname]" value="<?= isset($_SESSION['customer']) ? $customer['firstname'] : "" ?>" autocomplete="off" required>
                 <input class="input__customer" placeholder="Pseudo" type="text" id="pseudo" name="customer[pseudo]" value="<?= isset($_SESSION['customer']) ? $customer['pseudo'] : "" ?>" autocomplete="off" required>
                 <input class="input__customer" placeholder="email" type="email" id="email" name="customer[email]" value="<?= isset($_SESSION['customer']) ? $customer['email'] : "" ?>" autocomplete="off">
             </div>
             <div class="cart__preview--button">
                 <button class="button__ordervalidate" type="submit" name="ordertoprint">Confirmer</button>
                 <input type="button" class="button__ordervalidate" id="order1015" value="Ajouter 1 à tous en 10x15cm">
                 <input type="button" class="button__ordervalidate" id="order1520" value="Ajouter 1 à tous en 15x20cm">
             </div>

             <table class="cart__view">
                 <tr>
                     <th>image</th>
                     <th>dossier</th>
                     <th>nom</th>
                     <th>impression 10x15</th>
                     <th>impression 15x20</th>
                     <th>action</th>
                 </tr>

                 <?php
                    foreach ($liste as $index => $image) {
                    ?>

                     <tr class="row row<?= $index ?>">
                         <td><img class="image__cartlist-img" src="<?= $router->generate('main-home') ?>assets/images/<?= $image->folder . "/" . $image->name ?>"></td>
                         <td><?= $image->folder ?></td>
                         <td><?= $image->name ?></td>
                         <td class="nblight">
                             <input class="nb nblight<?= $index ?>" data-nblight="<?= $image->nblight ?>" style="background-color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "red" : "" ?>; color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "white" : ($image->nblight == 0 ? "red" : "") ?>;" name="selected[<?= $image->folder . "/" . $image->name ?>][light]" value="<?= $image->nblight ?>">
                             <div>
                                 <button class="plus light" type="button" name="plus">+</button>
                                 <button class="minus light" type="button" name="minus">-</button>
                             </div>
                         </td>
                         <td class="nblarge">
                             <input class="nb nblarge<?= $index ?>" data-nblarge="<?= $image->nblarge ?>" style="background-color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "red" : "" ?>; color:<?= $image->nblight == 0 && $image->nblarge == 0 ? "white" : ($image->nblarge == 0 ? "red" : "") ?>;" name="selected[<?= $image->folder . "/" . $image->name ?>][large]" value="<?= $image->nblarge ?>">
                             <div>
                                 <button class="plus large" type="button" name="plus">+</button>
                                 <button class="minus large" type="button" name="minus">-</button>
                             </div>

                         </td>
                         <td>
                             <a href="/cart/delete/<?= $image->id ?>"><img class="image__cartlist-icon" src="<?= $router->generate('main-home') ?>assets/images/delete-icon-png-69.png"></a>
                             <input type="hidden" name="selected[<?= $image->folder . "/" . $image->name ?>][id]" value="<?= $image->id ?>">
                         </td>
                     </tr>

             <?php
                    };
                } else {
                    // sinon j'indique que le panier est vide
                    echo "<p class='empty'>Le panier est vide</p>";
                    echo "<a href='/' style='color:#222;'>Cliquez ici pour choisir un cours</a>";
                }
                ?>
             </table>


     </form>



 </div>