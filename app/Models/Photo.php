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

    public $path;
    public $nblight;
    public $nblarge;


    public function __construct($path = '', $nblight = 0, $nblarge = 0)
    {
        $this->path = $path;
        $this->nblight = $nblight;
        $this->nblarge = $nblarge;
    }


    public function find($brandId)
    {
    }

    public function findAll()
    {
        $db = Database::getPDO();
        $sql = "SELECT * from photo";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        //ferme la connexion
        $db = null;
        return $result;
    }


    // insere les données d'1 photo pour 1 commande
    public function insert()
    {
        $db = Database::getPDO();
        $sql = "
        INSERT INTO `photo` (`path`) VALUES (:path)
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":path", $this->path, PDO::PARAM_STR);
        $stmt->execute();
        // retourne l'id du dernier élément inséréde cette connexion db
        return $db->lastInsertId();
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
