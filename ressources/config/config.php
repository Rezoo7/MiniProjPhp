<?php

// les chemins vers les différents répertoires liés au modèle MVC

// chemin complet sur le serveur de la racine du site
define("HOME_SITE",__DIR__."/..");
// donne les chemins vers les divers répertoires liés au modèle MVC
define("PATH_VUE",HOME_SITE."/vue");
define("PATH_CONTROLEUR",HOME_SITE."/controleur");
define("PATH_MODELE",HOME_SITE."/modele");
define("PATH_METIER",HOME_SITE."/metier");
define("PATH_EXCEPTIONS", HOME_SITE."/Exceptions");


// données pour la connexion au sgbd

define("HOST","localhost");
define("BD","projet");
define("LOGIN","root");
define("PASSWORD","");
?>
