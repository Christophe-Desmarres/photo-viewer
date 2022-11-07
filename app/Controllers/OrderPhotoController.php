<?php

namespace App\Controllers;
use App\Models\OrderPhoto;

class OrderPhotoController extends CoreController
{
 
            /**
     * Méthode s'occupant d'ajouter 1 photo 10x15'
     *
     * @return void
     */
    public function lightplus($id)
    {
        OrderPhoto::lightplus($id);

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }


                /**
     * Méthode s'occupant d'enlever 1 photo 10x15'
     *
     * @return void
     */
    public function lightminus($id)
    {
        OrderPhoto::lightminus($id);

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }


                /**
     * Méthode s'occupant d'ajouter 1 photo 15x20'
     *
     * @return void
     */
    public function largeplus($id)
    {
        OrderPhoto::largeplus($id);

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }


                /**
     * Méthode s'occupant d'enlever 1 photo 15x20'
     *
     * @return void
     */
    public function largeminus($id)
    {
        OrderPhoto::largeminus($id);

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }




        /**
     * Méthode s'occupant de supprimer une photo du panier
     *
     * @return void
     */
    public function delete($id)
    {
        OrderPhoto::delete($id);

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }



}
