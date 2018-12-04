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
            <title>  Erreur </title>
        </head>
        <body>

        <?php  echo $msg ?>

        </body>
        </html>


<?php


    }


}

?>