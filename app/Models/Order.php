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

    public $id_order;
    public $id_customer;
    public $status;


    public function __construct($id_order, $id_customer)
    {
        $this->id_order = $id_order;
        $this->id_customer = $id_customer;
    }


    public function find($brandId)
    {
    }

    public static function findAll()
    {
        // recherche toutes les commandes
        $sqlSearch = "
         SELECT * FROM `order_customer` 
         INNER JOIN customer 
         ON order_customer.id_customer = customer.id
         ";



        $db = Database::getPDO();
        $stmtSearch = $db->prepare($sqlSearch);
        $stmtSearch->execute();
        $result = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);
        //ferme la connexion
        $db = null;

        // dd($result);
        
        return $result;
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
            $order_number = $configData['MACHINE_NAME'] . "-" . date("Ymd-Gis");
            $_SESSION['id_order'] = $order_number;
        }
        // return order number
        return $_SESSION['id_order'];
    }


    public function insert()
    {
        $db = Database::getPDO();
        $sql = "
        INSERT INTO `order_customer` (`id_order`, `id_customer`) 
        VALUES (:id_order, :id_customer)
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $this->id_order, PDO::PARAM_STR);
        $stmt->bindValue(":id_customer", $this->id_customer, PDO::PARAM_INT);
        $stmt->execute();
        // retourne l'id du dernier élément inséréde cette connexion db
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        //ferme la connexion
        $db = null;

        return $result !== [] ? $result : false;
    }

    public function update()
    {
    }
}
