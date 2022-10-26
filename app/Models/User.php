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


    public function __construct($pseudo, $firstname, $lastname, $email)
    {
        $this->pseudo = $pseudo;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }


    public function find($pseudo)
    {
        // requete de recherche si pseudo existant
        $sqlSearch = "
                SELECT * FROM `customer` WHERE `user_name` = :pseudo
                ";
        $db = Database::getPDO();
        $stmtSearch = $db->prepare($sqlSearch);
        $stmtSearch->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmtSearch->execute();
        $result = $stmtSearch->fetchAll(PDO::FETCH_CLASS);
        //ferme la connexion
        $db = null;
        return $result !== [] ? $result : false;
    }

    public function findAll()
    {
    }

    public function insert()
    {
        $db = Database::getPDO();
        
        // requete d'insertion de l'utilisateur'
        $sqlInsert = "
        INSERT INTO `customer` (`user_name`, `firstname`, `lastname`, `email`) 
        VALUES (:user_name, :firstname, :lastname, :email)
        ";
        
        $exist = User::find($this->pseudo);
        // si le pseudo n'existe pas, je l'ajoute
        if (!$exist) {
            $stmtInsert = $db->prepare($sqlInsert);
            $stmtInsert->bindValue(":user_name", $this->pseudo, PDO::PARAM_STR);
            $stmtInsert->bindValue(":firstname", $this->firstname, PDO::PARAM_STR);
            $stmtInsert->bindValue(":lastname", $this->lastname, PDO::PARAM_STR);
            $stmtInsert->bindValue(":email", $this->email, PDO::PARAM_STR);
            $stmtInsert->execute();
            // retourne l'id du dernier élément inséréde cette connexion db
            // return $db->lastInsertId();
            $result = $stmtInsert->fetchAll(PDO::FETCH_CLASS);
            //ferme la connexion
            $result=$db->lastInsertId();
            $db = null;
            
            return $result;
        } else {
            return $exist;
        }
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
