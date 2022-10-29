<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class OrderPhoto extends CoreModel
{
    // Les propriétés représentent les champs
    // Attention il faut que les propriétés aient le même nom (précisément) que les colonnes de la table

    public $id_order;
    public $folder;
    public $name;
    public $nblight;
    public $nblarge;


    public function __construct($id_order, $folder, $name, $nblight = 0, $nblarge = 0)
    {
        $this->id_order = $id_order;
        $this->folder = $folder;
        $this->name = $name;
        $this->nblight = $nblight;
        $this->nblarge = $nblarge;
    }

    // find all folders in images folder
    public static function findFolder()
    {
        $nom_dossier = "./assets/images/";
        // open the directory choose
        $dossierCourant = opendir($nom_dossier);
        $dossiers = [];

        // boucle pour parcourir tous les éléments du dossier $nom_dossier 
        while ($dossier = readdir($dossierCourant)) {
            // condition pour ne pas prendre le . (dossier en cours) et .. (dosier parent) et garder les dossier uniquement (sans extension)
            if ($dossier != "." && $dossier != ".." && strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "") {
                $dossiers[] = $dossier;
            }
        }
        closedir($dossierCourant);

        return $dossiers;
    }


    // search photo according to id
    public static function findById($id)
    {
        // requete de recherche si photo existante ds la commande
        $sqlSearch = "
                SELECT * FROM `order_photo` 
                WHERE `id` = :id
                ";
        $db = Database::getPDO();
        $stmtSearch = $db->prepare($sqlSearch);
        $stmtSearch->bindValue(":id", $id, PDO::PARAM_INT);
        $stmtSearch->execute();
        $result = $stmtSearch->fetchAll(PDO::FETCH_CLASS);
        //ferme la connexion
        $db = null;

        return $result !== [] ? $result : false;
    }

    // find all selected photo to order
    public static function find($id_order, $folder, $name)
    {
        // requete de recherche si photo existante ds la commande
        $sqlSearch = "
                SELECT * FROM `order_photo` 
                WHERE `id_order` = :id_order 
                AND `folder` = :folder 
                AND `name` =:name
                ORDER BY `folder`
                ";
        $db = Database::getPDO();
        $stmtSearch = $db->prepare($sqlSearch);
        $stmtSearch->bindValue(":id_order", $id_order, PDO::PARAM_STR);
        $stmtSearch->bindValue(":folder", $folder, PDO::PARAM_STR);
        $stmtSearch->bindValue(":name", $name, PDO::PARAM_STR);
        $stmtSearch->execute();
        $result = $stmtSearch->fetchAll(PDO::FETCH_CLASS);
        //ferme la connexion
        $db = null;
        return $result !== [] ? $result : false;
    }


    // find all object photo in order with this id
    public static function findAll($id_order)
    {
        $db = Database::getPDO();
        $sql = "
        SELECT * from order_photo 
        WHERE id_order = :id_order
        ORDER BY `folder`
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $id_order, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        // je mets à jour la variable de session avec la liste des photos selectionnées sous forme d'objet OrdePhoto
        $_SESSION['OrderPhoto'] = $result;

        // je créé la variable de session 'OrderPhotoListName' qui contient la iste des photos selectionnées pour cette commande sous format 'folder/name'
        OrderPhoto::findAllName();

        //ferme la connexion
        $db = null;
        return $result;
    }


    // création variable de session contenant la liste des photos selectionnées sous forme de tableau indexé folder/name
    public static function findAllName()
    {
        $tablist[] = "";
        // je récupere la liste des noms des photos de la commande en cours
        //$_SESSION['OrderPhoto'] = OrderPhoto::findAll($id_order);
        foreach ($_SESSION['OrderPhoto'] as $index => $photo) {
            $path = "$photo->folder/$photo->name";
            $tablist[] = $path;
        }
        $_SESSION['OrderPhotoListName'] = $tablist;
    }

    // get the number of print according to one order
    public static function getNumberPrint($id_order)
    {

        $db = Database::getPDO();
        $sql = "
        SELECT * from order_photo 
        WHERE id_order = :id_order
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $id_order, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $totalNbLight = 0;
        $totalNbLarge = 0;

        // je récupere la liste des noms des photos de la commande en cours
        foreach ($result as $photo) {
            $totalNbLight += $photo->nblight;
            $totalNbLarge += $photo->nblarge;
        }
        return ['total10x15'=>$totalNbLight, 'total15x20'=> $totalNbLarge];
    }

    // insere les données d'1 photo pour 1 commande
    public function insert()
    {
        $db = Database::getPDO();

        // requete d'insertion de la photo ds la commande
        $sqlInsert = "
        INSERT INTO `order_photo` (`id_order`, `folder`, `name`, `nblight`, `nblarge`) 
        VALUES (:id_order, :folder, :name, :nblight, :nblarge)
        ";

        $exist = OrderPhoto::find($this->id_order, $this->folder, $this->name);
        // si la photo n'est pas ds la commande, je l'ajoute
        if (!$exist) {
            $stmtInsert = $db->prepare($sqlInsert);
            $stmtInsert->bindValue(":id_order", $this->id_order, PDO::PARAM_STR);
            $stmtInsert->bindValue(":folder", $this->folder, PDO::PARAM_STR);
            $stmtInsert->bindValue(":name", $this->name, PDO::PARAM_STR);
            $stmtInsert->bindValue(":nblight", $this->nblight, PDO::PARAM_INT);
            $stmtInsert->bindValue(":nblarge", $this->nblarge, PDO::PARAM_INT);
            $stmtInsert->execute();
            // retourne l'id du dernier élément inséréde cette connexion db
            return $db->lastInsertId();
        }
    }

    // update number of print on photo
    public function update($id)
    {
        $sqlUpdate = "
        UPDATE `order_photo`
        SET nblight = :nblight, nblarge= :nblarge
        WHERE id = :id
        ";
        $db = Database::getPDO();
        $stmtUpdate = $db->prepare($sqlUpdate);
        $stmtUpdate->bindValue(":id", $id, PDO::PARAM_INT);
        $stmtUpdate->bindValue(":nblight", $this->nblight, PDO::PARAM_INT);
        $stmtUpdate->bindValue(":nblarge", $this->nblarge, PDO::PARAM_INT);
        $stmtUpdate->execute();
        $result = $stmtUpdate->fetchAll(PDO::FETCH_CLASS);

        //ferme la connexion
        $db = null;
        return $result !== [] ? $result : false;
    }

    // delete one hpoto to this order
    public static function delete($id)
    {
        $db = Database::getPDO();
        $sql = "
        DELETE FROM `order_photo` 
        WHERE id = $id
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }


    /**
     * Set the value of nblight
     *
     * @return  self
     */
    public function setNblight($nblight)
    {
        $this->nblight = $nblight;
    }

    /**
     * Set the value of nblarge
     *
     * @return  self
     */
    public function setNblarge($nblarge)
    {
        $this->nblarge = $nblarge;
    }
}
