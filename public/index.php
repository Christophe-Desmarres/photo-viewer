<?php
// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../vendor/autoload.php';



//* les CoreModèles
require __DIR__ . '/../app/Controllers/CoreController.php';
require __DIR__ . '/../app/Controllers/MainController.php';
require __DIR__ . '/../app/Controllers/ErrorController.php';

// On ouvre la session : création variable $_SESSION[]
session_start();

// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va 
$router = new AltoRouter();
// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}
// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"


$router->addRoutes([
    // to see the folder list
    [
        'GET',
        '/',
        [
            'method' => 'home',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-home'
    ],
    // to connect or register
    [
        'GET',
        '/connect',
        [
            'method' => 'connect',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-connect'
    ],
    // to connect
    [
        'POST',
        '/connect',
        [
            'method' => 'connexion',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-connexion'
    ],
    // to see every image at the selected folder to choose them
    [
        'GET',
        '/images/[:folder]',
        [
            'method' => 'folder',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-folder'
    ],
    // to see image selected for order
    [
        'GET',
        '/cart',
        [
            'method' => 'cart',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-cart'
    ],
    // to see the selected image and choose number of impression to print
    [
        'POST',
        '/cart',
        [
            'method' => 'order',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-order'
    ],
        // to see the selected image and choose number of impression to print
        [
            'GET',
            '/cart/delete/[i:id]',
            [
                'method' => 'delete',
                'controller' => '\App\Controllers\MainController'
            ],
            'main-delete'
        ],
    // to see the resume of cart to validate them
    [
        'POST',
        '/cart_send',
        [
            'method' => 'send',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-send'
    ],
    // to create folder with image to print according size
    [
        'POST',
        '/print',
        [
            'method' => 'print',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-print'
    ],
    // to see administration page (with order)
    [
        'POST',
        '/administration',
        [
            'method' => 'admin',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-admin'
    ],
        // to see every image at the selected folder to choose them
        [
            'GET',
            '/impression/[i:id]',
            [
                'method' => 'printOrder',
                'controller' => '\App\Controllers\MainController'
            ],
            'main-printOrder'
        ],
    // to upload files to print in folder
    [
        'POST',
        '/upload',
        [
            'method' => 'upload',
            'controller' => '\App\Controllers\MainController'
        ],
        'main-upload'
    ],
]);


/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();
// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();
