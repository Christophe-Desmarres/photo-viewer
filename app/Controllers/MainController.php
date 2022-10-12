<?php

namespace App\Controllers;


class MainController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $this->show('home');
    }

    /**
     * Méthode s'occupant de la page des dossiers
     *
     * @return void
     */
    public function folder($folder)
    {
        $this->show('folder', ['folder' => rawurldecode(utf8_encode($folder))]);
    }

    /**
     * Méthode s'occupant de la page d'affichage des photos du dossier
     *
     * @return void
     */
    public function cart()
    {
        $this->show('cart');
    }

    /**
     * Méthode s'occupant de la page por choisir le nb d'impression
     *
     * @return void
     */
    public function order()
    {
        d($_POST);
        $this->show('cart', ['order' => $_POST['order']]);
    }

    /**
     * Méthode s'occupant d'afficher la page du récapitulatif du panier
     *
     * @return void
     */
    public function send()
    {
        $this->show('cart_resume');
    }

    /**
     * Méthode s'occupant d'enregistrer la commande pour impression
     * création des dossier avec les fichiers à imprimer
     *
     * @return void
     */
    public function print()
    {
        d($_POST);
        mkdir("./assets/commandes/commande_07 gérard mensoif", 0700);
        mkdir("./assets/commandes/commande_07 gérard mensoif/10x15", 0700);
        mkdir("./assets/commandes/commande_07 gérard mensoif/15x20", 0700);
        foreach ($_POST as $image => $number) {
            if ($image != "print") {
                // selectionne uniquement le nom de l'image
                $size = explode("/", $image)[0];
                // d($size);
                $folder = explode("/", $image)[1];
                // d($folder);
                $name = explode("/", $image)[2];
                // d($name);

                // remplace le _jpg par .jpg du au changement de nom automatique lors du passage en tableau indexé du nom avec light ou large
                $name = preg_replace('/_jpg/', '.jpg', $name);
                // les espaces du nom de dossiers sont remplacés automatiquement par des '_' donc on remets des espaces
                $folder = preg_replace('/_/', ' ', $folder);
                // d($number);

                for ($i = 0; $i < $number; $i++) {
                    if ($size == "nblight") {
                        copy("./assets/images/$folder/$name", "./assets/commandes/commande_07 gérard mensoif/10x15/($i)$name");
                    } else {
                        copy("./assets/images/$folder/$name", "./assets/commandes/commande_07 gérard mensoif/15x20/($i)$name");
                    }
                    echo "<br> j'imprime le fichier $folder/$name au format $size";
                }
            }
        }
        echo "<br> <br>yes, we did it !!!";
        // $this->show('cart_resume');
    }


    /**
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function admin()
    {
        $this->show('admin');
    }
    /**
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function upload()
    {
        require __DIR__ . "/../views/main/upload.php";
    }
}
