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
     *
     * @return void
     */
    public function print()
    {
        d($_POST);
        mkdir("./assets/images/new", 0700);
        echo "yes, we did it !!!";
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
