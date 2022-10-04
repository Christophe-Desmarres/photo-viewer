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
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function cart()
    {
        $this->show('cart');
    }
}
