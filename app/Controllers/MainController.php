<?php

namespace App\Controllers;

use App\Models\Photo;

class MainController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
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

        $this->show('home', ['dossiers' => $dossiers]);
    }

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function connect()
    {

        $this->show('connexion');
    }

    /**
     * Méthode s'occupant de la page des dossiers
     *
     * @return void
     */
    public function folder($folder)
    {
        // pour décoder les caractère spéciaux et les accents
        $folder = rawurldecode(utf8_encode($folder));
        $nom_dossier = "./assets/images/" . $folder;
        // open the directory choose
        $dossierCourant = opendir($nom_dossier);
        $chaine = [];
        $dossiers = [];

        /**
         * test à faire avec scandir()
         * source : https://www.w3schools.com/php/func_directory_scandir.asp
         */

        // boucle pour renommer les noms de fichier sans espace
        while ($dossier = readdir($dossierCourant)) {
            if ($dossier != "." && $dossier != "..") {
                $str = preg_replace('/\s+/', '', $dossier);
                rename("$nom_dossier/$dossier", "$nom_dossier/$str");
            }
        }
        // Je ferme le dossier puis le réouvre pour le réutiliser dès le début
        closedir($dossierCourant);
        $dossierCourant = opendir($nom_dossier);

        // boucle pour parcourir tous les éléments du dossier $nom_dossier 
        while ($dossier = readdir($dossierCourant)) {
            // condition pour ne pas prendre le . (dossier en cours) et .. (dossier parent) et garder les fichiers uniquement en jpg
            if ($dossier != "." && $dossier != "..") {
                if (strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "jpg") {
                    $chaine[] = $dossier;
                } else if (strtolower(pathinfo($dossier, PATHINFO_EXTENSION)) == "") {
                    $dossiers[] = $dossier;
                }
            }
        }

        closedir($dossierCourant);

        $this->show('folder', ['folder' => $folder, 'chaine' => $chaine, 'dossiers' => $dossiers]);
    }

    /**
     * Méthode s'occupant de la page d'affichage des photos du dossier
     *
     * @return void
     */
    public function cart()
    {
        $this->show('cart');
    }

    /**
     * Méthode s'occupant de la page por choisir le nb d'impression
     *
     * @return void
     */
    public function order()
    {

        $_SESSION['liste'] = $_POST['selected'];

        // TODO
        //creation id order
        //ajout photo associé à order

        $this->show('cart', ['liste' => $_POST['selected']]);
    }

    /**
     * Méthode s'occupant d'afficher la page du récapitulatif du panier
     *
     * @return void
     */
    public function send()
    {

        $_SESSION['liste'] = $_POST['selected'];
        $_SESSION['customer'] = $_POST['customer'];

        $this->show('cart_resume', ['liste' => $_POST['selected'], 'customer' => $_POST['customer']]);
    }

    /**
     * Méthode s'occupant d'enregistrer la commande pour impression
     * création des dossier avec les fichiers à imprimer
     *
     * @return void
     */
    public function print()
    {
        d($_POST);
        // je créé l'architecture dossier pour récupérer les images commandées
        mkdir("./assets/commandes/commande_07 gérard mensoif", 0700);
        mkdir("./assets/commandes/commande_07 gérard mensoif/10x15", 0700);
        mkdir("./assets/commandes/commande_07 gérard mensoif/15x20", 0700);

        foreach ($_POST as $image => $number) {
            // enleve le traitement de la première valeur récupérée du formulaire
            if ($image != "print") {
                // selectionne uniquement le nom de l'image
                $size = explode("/", $image)[0];
                // d($size);
                $folder = explode("/", $image)[1];
                // d($folder);
                $name = explode("/", $image)[2];
                // d($name);

                // remplace le _jpg par .jpg du au changement de nom automatique lors du passage en tableau indexé du nom avec light ou large
                $name = preg_replace('/_jpg/', '.jpg', $name);
                // les espaces du nom de dossiers sont remplacés automatiquement par des '_' donc on remets des espaces
                $folder = preg_replace('/_/', ' ', $folder);
                // d($number);

                // boucle pour copier les images ds un dossier
                for ($i = 0; $i < $number; $i++) {
                    $extension = strtolower(pathinfo("./assets/images/$folder/$name", PATHINFO_EXTENSION));
                    $new_name = explode(".$extension", $name)[0] . "($i).$extension";

                    if ($size == "nblight") {
                        copy("./assets/images/$folder/$name", "./assets/commandes/commande_07 gérard mensoif/10x15/$new_name");
                    } else {
                        copy("./assets/images/$folder/$name", "./assets/commandes/commande_07 gérard mensoif/15x20/$new_name");
                    }
                    echo "<br> j'imprime le fichier $folder/$name au format " . ($size == "nblight" ? "10x15" : "15x20");
                }
            }
        }
        echo "<br> <br>yes, we did it !!!";
        // $this->show('cart_resume');
    }


    /**
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function admin()
    {
        $this->show('admin');
    }
    /**
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function upload()
    {
        require __DIR__ . "/../views/main/upload.php";
    }
}
