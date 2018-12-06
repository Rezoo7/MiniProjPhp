<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 04/12/2018
 * Time: 14:51
 */


class VueJeuBridge
{

    public $villes;
    public function afficher_jeu(){

        $this->villes = new Villes();
        ?>

            <!doctype html>
            <html style="background-color: aliceblue">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styleJeu.css">
                <title> Jeu du Bridge  </title>
            </head>
            <body>

            <h1> Bienvenue Sur le Jeu du Bridge ! </h1>
            <br>
            <br>
            <table class="center" cellpadding="0" cellspacing="0" border="0">
                <?php

               for ( $i=0; $i <=6; $i ++ )
               {

                   echo "<tr>";


                   for ( $j=0; $j <=6; $j ++ )
                   {

                       echo "<td>";

                       if ($this->villes->existe($i,$j)) {

                           $laVille = $this->villes->getVille($i, $j);
                           $src_image = "../ressources/Image/numero" . $laVille->getNombrePontsMax() . ".png";

                           $ville_id = $laVille->getId();
                           echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville=".$ville_id."&ville2=-1><img src=\"".$src_image."\" width='50'></a>";
                       }
                       else
                       {
                           echo "  ";
                       }

                       echo "</td>";

                   }
                   echo "</tr>";

               }
                ?>
            </table>
            <!-- bonjour je fais un test | SALUT BUGO | Qu'as tu changé ici ? -->

            </form>

            <br>  <br>

            <button id="bouton"><a href='index.php?etat=deconnexion'> Quitter </a></button>

            </body>
            </html>

<?php


    }




}
?>