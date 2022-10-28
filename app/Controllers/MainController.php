<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderPhoto;
use App\Models\User;

class MainController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil
     * affiche la liste des dossiers
     *
     * @return void
     */
    public function home()
    {
        $this->show('home', ['dossiers' => OrderPhoto::findFolder()]);
    }

    /**
     * Méthode s'occupant de la page de connexion
     *
     * @return void
     */
    public function connect()
    {

        $this->show('connexion');
    }

    /**
     * Méthode s'occupant d'afficher la liste des photos du dossier selectionné
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
     * Méthode s'occupant d'afficher la page du panier
     *
     * @return void
     */
    public function cart()
    {

        // si l'utilisateur va sur le panier avant d'avoir selectionné des photos, pour éviter les défauts
        if (isset($_SESSION['id_order'])) {
            if ($_SESSION['id_order'] != "") {
                OrderPhoto::findAll($_SESSION['id_order']);
                $message = ["hidden", ""];
            } else {
                $message = ["alert", "Panier vide"];
            }
        } else {
            $_SESSION['id_order'] = "";
            $_SESSION['OrderPhoto'] = [];
            $_SESSION['OrderPhotoListName'] = [];
            $message = ["alert", "Panier vide"];
        }


        if (!isset($_SESSION['customer'])) {
            $_SESSION['customer']['pseudo'] = "";
            $_SESSION['customer']['lastname'] = "";
            $_SESSION['customer']['firstname'] = "";
            $_SESSION['customer']['email'] = "";
        }


        $this->show('cart', ['liste' => $_SESSION['OrderPhoto'], 'customer' => $_SESSION['customer'], 'message' => $message]);
    }

    /**
     * Méthode s'occupant d'enregistrer la liste des photos, de créer un numéro de commande et de créer un utilisateur
     * 
     * @return void
     */
    public function order()
    {

        if (isset($_POST['selected'])) {

            // création d'un numéro de commande si non existant ds variable session 'id_order'
            Order::create();

            // si c'est une nouvelle liste pour cette session ou si la liste est différente de la sélection (ajout de photo d'un autre dossier par exemple)
            if (!isset($_SESSION['OrderPhoto']) || $_SESSION['OrderPhoto'] !== $_POST['selected']) {
                // entrée des photos choisi par l'utilisateur ds la bdd en lien avec le numéro de commande
                foreach ($_POST['selected'] as $index => $path) {
                    // je récupere le dossier et le nom du fichier
                    $folder = explode("/", $path)[0];
                    $name = explode("/", $path)[1];
                    // j'instancie la classe OrderPhoto pour créer un objet photo relié à un id_order
                    $photo = new OrderPhoto($_SESSION['id_order'], $folder, $name);
                    // j'ajoute l'objet dans la bdd
                    $photo->insert();
                }
            }
        }

        if (!isset($_SESSION['customer'])) {
            $_SESSION['customer'] = [];
        }

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }


    /**
     * Méthode s'occupant de supprimer une photo du panier
     *
     * @return void
     */
    public function delete($id)
    {
        OrderPhoto::delete($id);

        $this->show('cart', ['liste' => OrderPhoto::findAll($_SESSION['id_order']), 'customer' => $_SESSION['customer']]);
    }



    /**
     * Méthode s'occupant d'afficher la page du récapitulatif du panier
     *
     * @return void
     */
    public function send()
    {

        // pour eviter d'avoir des erreur lors de l'affichage de la page  cart
        // je vérifie la présence de la validation du formulaire et si les info de l'utilisateur sont différentes
        if (isset($_POST['customer']) && $_SESSION['customer'] !== $_POST['customer']) {
            // j'instancie la classe user pour créer un utilisateur
            // TODO
            // nettoyer les donnée du $_POST
            $user = new User($_POST['customer']['pseudo'], $_POST['customer']['firstname'], $_POST['customer']['lastname'], $_POST['customer']['email']);
            // j'ajoute l'objet dans la bdd
            $user_id = $user->insert();
            // j'ajoute ds la bdd le lien entre le user et le numéro de commande
            $order = new Order($_SESSION['id_order'], $user_id);
            $order->insert();
        }

        // mise à jour des quantités et des photos séléctionnées
        foreach ($_POST['selected'] as $path => $size) {
            $folder = explode("/", $path)[0];
            $name = explode("/", $path)[1];
            $photoObject = new OrderPhoto($_SESSION['id_order'], $folder, $name);
            $photoObject->setNblight($size['light']);
            $photoObject->setNblarge($size['large']);

            // je complete les infos de quantités
            $photoObject->update($size['id']);
        }

        $_SESSION['customer'] = $_POST['customer'];

        $this->show('cart_resume', ['liste' => OrderPhoto::findAll($_SESSION['id_order']),  'customer' => $_SESSION['customer']]);
    }

    /**
     * Méthode s'occupant d'enregistrer la commande pour impression
     * création des dossier avec les fichiers à imprimer
     *
     * @return void
     */
    public function print()
    {

        $message = ["", ""];

        if (isset($_POST['print'])) {
            // sinon c'est fini et j'affiche un gentil message de remerciement avec le numéro de commande
            $message = ["info", "Merci " . $_SESSION['customer']['pseudo'] . " de votre commande num : <strong>" . substr(explode('-', $_SESSION['id_order'])[2], 0, 4) . "</strong>"];
            // et je réinitialise les variables de session
            $_SESSION = [];
        }

        // header("Location: http://photoviewer/");
        $this->show('home', ['dossiers' => OrderPhoto::findFolder(), 'message' => $message]);

        // redirige vers la page d'accueil
        // exit;
    }


    /**
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function printOrder($order_id)
    {
        // d($_POST);
        // d($_SESSION);

        $order_info = Order::find($order_id)[0];

        // je créé l'architecture dossier pour récupérer les images commandées
        if (!file_exists("./assets/commandes/commande_" . $order_info['id_order'])) {
            mkdir("./assets/commandes/commande_" . $order_info['id_order'], 0700);
            mkdir("./assets/commandes/commande_" . $order_info['id_order'] . "/10x15", 0700);
            mkdir("./assets/commandes/commande_" . $order_info['id_order'] . "/15x20", 0700);
        } 
        // else {
        //     echo "ce dossier existe déjà !!!";
        // }

        // création d'un fichier texte
        $path_fichier = "./assets/commandes/commande_" . $order_info['id_order'] . "/" . $order_info['user_name'] . ".txt";
        // variable pour le contenu
        $texte = "commande de " . $order_info['user_name'];
        // j'insere le contenu ds la fichier
        file_put_contents($path_fichier, $texte);

        // récupération de la liste des photo à imprimer
        $photo_list_order = OrderPhoto::findAll($order_info['id_order']);
        // initialisation de la variable pour récupérer la liste des chemin de chaque image
        $chaine = [];

        foreach ($photo_list_order as $image) {
            // selectionne uniquement la taille de l'image (nblight ou nblarge)
            // $size = explode("/", $image)[0];
            // $folder = explode("/", $image)[1];
            // $name = explode("/", $image)[2];

            // // remplace le _jpg par .jpg du au changement de nom automatique lors du passage en tableau indexé du nom avec light ou large
            // $name = preg_replace('/_jpg/', '.jpg', $name);
            // // les espaces du nom de dossiers sont remplacés automatiquement par des '_' donc on remets des espaces
            // $folder = preg_replace('/_/', ' ', $folder);

            // // si le nombre d'impression est >0 on ajoute dans le fichier texte de résumé de commande
            // if ($number != 0) {
            //     //On récupère le contenu du fichier
            //     $texte = file_get_contents($path_fichier);
            //     //On ajoute notre nouveau texte à l'ancien
            //     $texte .= "\n$folder=>$name x $number $size";
            //     file_put_contents($path_fichier, $texte);
            // }


            // boucle pour copier les images ds un dossier selon le nombre d'impression
            for ($i = 0; $i < $image->nblight; $i++) {

                // je recupere le type d'extension du fichier
                $extension = strtolower(pathinfo("./assets/images/$image->folder/$image->name", PATHINFO_EXTENSION));
                // je récupere uniquement le nom du fichier puis j'ajoute un incrément puis l'extension
                $new_name = explode(".$extension", $image->name)[0] . "($i).$extension";
                copy("./assets/images/$image->folder/$image->name", "./assets/commandes/commande_" . $order_info['id_order'] . "/10x15/$new_name");
                $chaine[] = "./assets/commandes/commande_" . $order_info['id_order'] . "/10x15/$new_name";

                // si le nombre d'impression est >0 on ajoute dans le fichier texte de résumé de commande
                if ($i == 0) {
                    //On récupère le contenu du fichier
                    $texte = file_get_contents($path_fichier);
                    //On ajoute notre nouveau texte à l'ancien
                    $texte .= "\n$image->folder=>$image->name x $image->nblight en 10x15cm";
                    file_put_contents($path_fichier, $texte);
                }
            }

            // boucle pour copier les images ds un dossier
            for ($i = 0; $i < $image->nblarge; $i++) {
                $extension = strtolower(pathinfo("./assets/images/$image->folder/$image->name", PATHINFO_EXTENSION));
                $new_name = explode(".$extension", $image->name)[0] . "($i).$extension";
                copy("./assets/images/$image->folder/$image->name", "./assets/commandes/commande_" . $order_info['id_order'] . "/15x20/$new_name");
                $chaine[] = "./assets/commandes/commande_" . $order_info['id_order'] . "/15x20/$new_name";


                // si le nombre d'impression est >0 on ajoute dans le fichier texte de résumé de commande
                if ($i == 0) {
                    //On récupère le contenu du fichier
                    $texte = file_get_contents($path_fichier);
                    //On ajoute notre nouveau texte à l'ancien
                    $texte .= "\n$image->folder=>$image->name x $image->nblarge en 15x20cm";
                    file_put_contents($path_fichier, $texte);
                }
            }
        }

        // TODO à voir pour impression directe
        // source: https: //www.developpez.net/forums/d58915/php/langage/systeme-imprimer-php/
        // $lp = 'lp ' + $filename;
        // shell_exec & #40;$lp&#41;;
        // $filename == 'toto.pdf ; rm -rf *';




        // echo "<br> <br>Commande de XXXXX traitée";
        // $this->show('cart_resume');
        //$this->show('print', ['chaine' => $chaine, 'message' => ["info","commande à imprimer"]]);
        //header("Location: http://photoviewer/administration");

        $this->show('admin', ['liste' => Order::findAll(), 'message' => ["info", "Commande de " . $order_info['firstname'] . " " . $order_info['lastname'] . " traitée"]]);
    }

    /**
     * Méthode s'occupant de la page du panier
     *
     * @return void
     */
    public function admin()
    {

        // TODO
        // afficher la liste des commande par customer
        // utiliser un tri si possible
        // ajouter un bouton pour récupérer la commande avec recupOrder($user_id)

        // d($_POST);

        if (isset($_POST)) {
            if ($_POST['pseudo'] == "Malika" || $_POST['pseudo'] == "Christophe") {

                if ($_POST['password'] == "espaceAdmin") {
                    $message = ["info", "Connexion réussie"];

                    $this->show('admin', ['liste' => Order::findAll(), 'message' => $message]);
                    exit;
                } else {
                    $message = ["alert", "Votre login ou mot de passe est incorrect"];
                }
            } else {
                $message = ["alert", "Votre login ou mot de passe est incorrect"];
            }
        }

        $this->show('connexion', ['message' => $message]);
        //header("Location: http://photoviewer/connect");
        exit;
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
