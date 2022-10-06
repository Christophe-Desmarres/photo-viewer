<?php

namespace App\Controllers;


class ErrorController extends CoreController
{

    /**
     * Méthode s'occupant de la page 404
     *
     * @return void
     */
    public function err404()
    {
        $this->show('404');
    }
}
