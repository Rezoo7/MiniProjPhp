<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 04/12/2018
 * Time: 14:51
 */

include_once "./modele/villes.php";

class VueJeuBridge
{

    public function afficher_jeu(){

        ?>

            <!doctype html>
            <html>
            <head>
                <meta charset="UTF-8">

                <title> Jeu du Bridge  </title>
            </head>
            <body>

            <h1> Bienvenue Sur le Jeu du Bridge ! </h1>
            <br>
            <br>
            <table>
                <?php

               for ( $i=0; $i <=6; $i ++ )
               {
                   ?>
                   <tr style="border: 1px solid black;">
                   <?php
                   for ( $j=0; $j <=6; $j ++ )
                   {
                       ?>
                       <td>
                       <?php echo "<$i $j>"; ?></td>
                       <?php
                   }
                   ?>  </tr>
                   <?php
               }
                ?>
            </table>
            <!-- bonjour je fais un test -->

            <button><a id="bouton" href='index.php?etat=deconnexion'> Quitter </a></button>



            </form>
            </body>
            </html>

<?php


    }




}
?>