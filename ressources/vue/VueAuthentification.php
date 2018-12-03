<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 03/12/2018
 * Time: 18:22
 */

class VueAuthentification
{

    public function AffichageCo(){

        ?>

        <!doctype html>
        <html>
        <head>
            <meta charset="UTF-8">

            <title> Authentification du Joueur  </title>
        </head>
        <body>

        <h1> Connexion au Jeu </h1>
        <form action="index.php" method="POST">

            <p> Pseudo: <input type="name" name="pseudo"> </p>
            <p> Mot de Passe: <input type = "password" name="mdp"></p>

            <input type="submit" value="Connexion">
        </form>
        </body>
        </html>

        <?php
    }


}

?>
