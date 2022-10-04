# Fonction pour demander toutes les infos a l'utilisateur
donnees_utilisateur(){
    echo "✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨"
    echo "✨✨✨ MVC Creator by M.Slayki ✨✨✨"
    echo "✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨✨"
    # On demande si l'utilisateur est pret a faire l'install
    read -p "Etes vous pret a installer une structure MVC ? (O/N) " confirm
    if [ "$confirm" = "O" ]
    then
        echo "Et c'est parti pour le show, et c'est parti tout le monde il est chaud"
    else
        echo "Arret du script"
        exit
    fi 

    # On demande à l'utilisateur la DB_HOST
    read -p "Ou se trouve la base de donnée ? (localhost par defaut) " DB_HOST
    if [ "$DB_HOST" = "" ]
    then
        echo "✅ Ok, on part sur DB_HOST = localhost"
        DB_HOST="localhost"
    else
        echo "✅ Ok, on part sur DB_HOST = $DB_HOST"

    fi 

    # On demande à l'utilisateur la DB_NAME
    read -p "Le nom de la BDD ? " DB_NAME
    if [ "$DB_NAME" = "" ]
    then
        echo "❌ Le nom de base de donnée est nécessaire pour réaliser l'installation"
        echo "Arret du script"
        exit
    else
        echo "✅ Ok, on part sur DB_NAME = $DB_NAME"

    fi 

    # On demande à l'utilisateur la DB_USERNAME
    read -p "Le nom d'utilisateur pour la connexion a la bdd' ? (explorateur par defaut)" DB_USERNAME
    if [ "$DB_USERNAME" = "" ]
    then
        echo "✅ Ok, on part sur DB_USERNAME = explorateur"
        DB_USERNAME="explorateur"
    else
        echo "✅ Ok, on part sur DB_USERNAME = $DB_USERNAME"

    fi 

    # On demande à l'utilisateur la DB_PASSWORD
    read -p "Le password pour la connexion a la bdd' ? (Ereul9Aeng par defaut)" DB_PASSWORD
    if [ "$DB_PASSWORD" = "" ]
    then
        echo "✅ Ok, on part sur DB_PASSWORD = Ereul9Aeng"
        DB_PASSWORD="Ereul9Aeng"
    else
        echo "✅ Ok, on part sur DB_USERNAME = $DB_PASSWORD"

    fi 

    # Et on a terminé de demander les infos sur la BDD
    echo "\n"
    echo "✨✨ Noice noice noice, on a terminé la config BDD ✨✨"
    echo "\n"

    # Pour terminer on demande le NAMESPACE principal pour notre projet
    read -p "Pour terminer, le namespace principal pour la  mise en oeuvre de la PSR4' ? (App par defaut)" NAMESPACE
    if [ "$NAMESPACE" = "" ]
    then
        echo "✅ Ok, on part sur NAMESPACE = App"
        NAMESPACE="App"
    else
        echo "✅ Ok, on part sur NAMESPACE = $NAMESPACE"

    fi 

    # On check si composer est bien installé  ou pas 
    echo "Maintenant on va vérifier que composer est bien installé "
    if [ -f "/usr/local/bin/composer" ]; then
        echo "✅ Composer est déjà installé ! C'est impeccable, je dirais même DEUXpeccable hahaha";
    else
        echo "Composer n'est pas installé, je m'en occupe 💚!";
        installation_composer;
    fi

}

# Fonction pour remplacer un string par un autre dans un fichier
# exemple utilisation :
# remplacer_dans_fichier 'texte a remplacer' 'par ce texte' dansCeFichier.php
remplacer_dans_fichier() {
    php -r "file_put_contents('$3', str_replace('$1', '$2', file_get_contents('$3')));";
}

# Fonction de création de la strucutre des dossiers
creation_structure_dossiers() {
    mkdir app
    mkdir public
    cd public
    mkdir assets
    cd ../app
    mkdir Controllers
    mkdir Models
    mkdir Utils
    mkdir views
    cd views
    mkdir main
    mkdir layout
    mkdir partials
    cd ../..
    echo "✅ Creation des dossiers"
}

# Fonction d'installation de composer
installation_composer(){
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
}

# Fonction copie des ressources de ./bin vers le bon endroit
creation_ressources(){
    # On place les fichiers grace a notre dossier bin  qui contient toutes les ressources
    cp ./bin/index.php ./public/index.php
    cp ./bin/.htaccess ./public/.htaccess
    cp ./bin/config.ini ./app/config.ini
    echo "Deny from all" > ./app/.htaccess
    cp ./bin/composer.json ./composer.json
    cp ./bin/CoreController.php ./app/Controllers/CoreController.php
    cp ./bin/MainController.php ./app/Controllers/MainController.php
    cp ./bin/Database.php ./app/Utils/Database.php
    cp ./bin/CoreModel.php ./app/Models/CoreModel.php
    cp ./bin/Model.php ./app/Models/Model.php
    echo "<h1>HEADER</h1>" > ./app/views/layout/header.tpl.php
    echo "<h1>FOOTER</h1>" > ./app/views/layout/footer.tpl.php
    echo "<h2>MAIN</h2>" > ./app/views/main/home.tpl.php
    echo "✅ Creation des ressources"
}

# Fonction édition des ressources
edition_ressources(){
    remplacer_dans_fichier "REPLACEDBHOST" $DB_HOST ./app/config.ini
    remplacer_dans_fichier "REPLACEDBNAME" $DB_NAME ./app/config.ini
    remplacer_dans_fichier "REPLACEDBUSERNAME" $DB_USERNAME ./app/config.ini
    remplacer_dans_fichier "REPLACEDBPASSWORD" $DB_PASSWORD ./app/config.ini

    remplacer_dans_fichier "REPLACENAMESPACE" $NAMESPACE ./composer.json
    remplacer_dans_fichier "REPLACENAMESPACE" $NAMESPACE ./app/Controllers/CoreController.php
    remplacer_dans_fichier "REPLACENAMESPACE" $NAMESPACE ./app/Controllers/MainController.php
    remplacer_dans_fichier "REPLACENAMESPACE" $NAMESPACE ./app/Models/CoreModel.php
    remplacer_dans_fichier "REPLACENAMESPACE" $NAMESPACE ./app/Models/Model.php
    remplacer_dans_fichier "REPLACENAMESPACE" $NAMESPACE ./app/Utils/Database.php
    echo "✅ Edition des ressources"
}