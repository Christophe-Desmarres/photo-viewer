<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class User extends CoreModel
{
    // Les propriétés représentent les champs
    // Attention il faut que les propriétés aient le même nom (précisément) que les colonnes de la table

    public $pseudo;
    public $firstname;
    public $lastname;
    public $email;
    public $password;


    public function __construct($pseudo, $firstname, $lastname, $email, $password)
    {
        $this->pseudo = $pseudo;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->$password = $password;
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
