<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 04/12/2018
 * Time: 19:23
 */

class VueErreur
{

    public function __construct(){


    }

    public function afficher_erreur($msg){

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>  Erreur </title>
            <link rel="stylesheet" href="styleAuth.css">
        </head>
        <body>

        <?php  echo "<h2>".$msg."</h2>" ?>

        </body>
        </html>


<?php


    }


}

?>