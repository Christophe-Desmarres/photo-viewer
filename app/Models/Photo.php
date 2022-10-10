<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class Photo extends CoreModel
{
    // Les propriétés représentent les champs
    // Attention il faut que les propriétés aient le même nom (précisément) que les colonnes de la table

    public $name;
    public $folder;
    public $nblight;
    public $nblarge;
    public $nbxlarge;


    public function __construct($name, $folder, $nblight = 0, $nblarge = 0, $nbxlarge = 0)
    {
        $this->name = $name;
        $this->folder = $folder;
        $this->nblight = $nblight;
        $this->nblarge = $nblarge;
        $this->nbxlarge = $nbxlarge;
    }


    public function find($brandId)
    {
    }

    public function findAll()
    {
    }

    public function insert()
    {
    }

    public function update()
    {
    }

    /**
     * Set the value of nblight
     *
     * @return  self
     */
    public function setNblightPlus()
    {
        return $this->nblight++;
    }
    /**
     * Set the value of nblight
     *
     * @return  self
     */
    public function setNblightMinus()
    {
        return $this->nblight--;
    }

    /**
     * Set the value of nblarge
     *
     * @return  self
     */
    public function setNblarge($nblarge)
    {
        $this->nblarge = $nblarge;

        return $this;
    }
}
