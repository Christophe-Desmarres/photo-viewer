<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class Order extends CoreModel
{
    // Les propriétés représentent les champs
    // Attention il faut que les propriétés aient le même nom (précisément) que les colonnes de la table




    public function __construct()
    {
    }


    public function find($brandId)
    {
    }

    public function findAll()
    {
    }
    public static function create()
    {
        // Récupération des données du fichier de config
        // la fonction parse_ini_file parse le fichier et retourne un array associatif
        $configData = parse_ini_file(__DIR__ . '/../config.ini');
        
        // création d'un numéro de commande si non existant
        if (!isset($_SESSION['id_order']) || $_SESSION['id_order'] == null) {
            // format aaaammjj-hhmmss
            // 20221020-215107
            $_SESSION['id_order'] = $configData['MACHINE_NAME'] . "-" . date("Ymd-Gis");
        }
    }


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
}
