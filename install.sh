#!/bin/bash

# On inclus le fichier qui contient toutes les fonctions qui vont nous etre utile pour la suite
. ./includes/functions.sh

# On demande toutes les données a l'utilisateur
donnees_utilisateur;

# On fabrique tous les dossiers
echo "On va maintenant fabriquer toute la structure de dossier de notre MVC"
creation_structure_dossiers;

# On copie les ressources de ./bin au bon endroit
echo "On va maintenant créer toutes les ressources"
creation_ressources;

# On edite les ressources 
echo "On va maintenant editer les ressources avec les données utilisateur"
edition_ressources;

# On installe les dependances
echo "pour terminer on installe altorouteur, altodispatcher, var_dumper et on génère l'autoload"
composer install
echo "✅ Installation des dépendances"
echo "✨✨✨✨✨✨✨✨✨✨✨✨"
echo "✨Installation terminée✨"
echo "✨✨✨✨✨✨✨✨✨✨✨✨"



