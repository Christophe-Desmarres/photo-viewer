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


    public static function find($order_id)
    {
        // recherche toutes les commandes
        $sqlSearch = "
           SELECT * FROM `order_customer` 
           INNER JOIN customer 
           ON order_customer.id_customer = customer.id
           WHERE order_customer.id= $order_id
           ";


        $db = Database::getPDO();
        $stmtSearch = $db->prepare($sqlSearch);
        $stmtSearch->execute();
        $result = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);
        //ferme la connexion
        $db = null;


        return $result;
    }

    public static function findAll()
    {
        // recherche toutes les commandes
        $sqlSearch = "
         SELECT *, order_customer.id AS id_request, customer.id AS customer_id FROM `order_customer` 
         INNER JOIN customer 
         ON order_customer.id_customer = customer.id
         ORDER BY order_customer.created_at 
         ";

        $db = Database::getPDO();
        $stmtSearch = $db->prepare($sqlSearch);
        $stmtSearch->execute();
        $result = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);

        $recapOrder = [];
        foreach ($result as $index => $order) {
            $recapNumber = OrderPhoto::getNumberPrint($order['id_order']);
            $order['10x15'] = $recapNumber['total10x15'];
            $order['15x20'] = $recapNumber['total15x20'];
            $recapOrder[] = $order;
        }

        $db = null;

        return $recapOrder;
    }



    // création d'un numéro de commande
    public static function create()
    {
        // Récupération des données du fichier de config
        // la fonction parse_ini_file parse le fichier et retourne un array associatif
        $configData = parse_ini_file(__DIR__ . '/../config.ini');

        // création d'un numéro de commande si non existant
        if (!isset($_SESSION['id_order']) || $_SESSION['id_order'] == "") {
            // format aaaammjj-hhmmss
            // 20221020-215107
            $order_number = $configData['MACHINE_NAME'] . "-" . date("Ymd-Gis");
            $_SESSION['id_order'] = $order_number;
        }

        // return order number
        return $_SESSION['id_order'];
    }

    // add an order
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
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        //ferme la connexion
        $db = null;

        return $result !== [] ? $result : false;
    }

    public function update()
    {
    }

    // change order status 'pending' to 'printed'
    public static function updateOrderPrint($order_id)
    {
        $db = Database::getPDO();
        $sql = "
        UPDATE `order_customer`
        SET order_status = 'printed'
        WHERE id_order = :id_order
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $order_id, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->rowCount();
        //ferme la connexion
        $db = null;

        return $rows;
    }
}
