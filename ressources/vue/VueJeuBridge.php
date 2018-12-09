<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 04/12/2018
 * Time: 14:51
 */


class VueJeuBridge
{


    /**
     * @param $liste_villes prend en paramètre l'objet Villes déjà créé avant.
     *  fonction qui affiche le jeu (en mode "pause")
     */
    public function afficher_jeu($liste_villes){

        $this->header();

        ?>


            <body>

            <h1> Bienvenue Sur le Jeu du Bridge ! </h1>
            <h4> Nombre de ponts à construire : <?php echo " ".$liste_villes->total_Ponts()?></h4>
            <br>
            <h5> <B> APPUYEZ SUR UNE VILLE POUR DEMARRER / REPRENDRE LE JEU : </B> </h5>
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

                       if ($liste_villes->existe($i,$j)) {

                           $laVille = $liste_villes->getVille($i, $j);
                           $src_image = "../ressources/Image/numero" . $laVille->getNombrePontsMax() . ".png";

                           $ville_id = $laVille->getId();
                           echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville1=".$ville_id."&ville2=-1><img src=\"".$src_image."\" width='50'></a>";
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


            </form>

            <br>  <br>

            <?php
            $this->bouttonsEnJeu();

              ?>
            </body>
            </html>

<?php


    }


    /**
     * méthode qui affiche les boutons à l'écran
     */
    public function bouttonsEnJeu()
    {
        ?>

        <a href='index.php?etat=recommencer'><button id="bouton"> Recommencer </button></a>
        <a href='index.php?etat=stats'><button id="bouton"> Pause /   Statistiques </button></a>
        <a href='index.php?etat=deconnexion'><button id="bouton"> Quitter </button></a>

        <?php
    }

    /**
     * méthode qui affiche les boutons à l'écran lorsqu'on est en fin de jeu.
     */
    public function bouttonsFinDeGame()
    {
        ?><a href='index.php?etat=recommencer'><button id="bouton"> Recommencer </button></a>
        <a href='index.php?etat=deconnexion'><button id="bouton"> Quitter </button></a>
        <?php
        }

    /**
     * méthode qui affiche toute l'entête pour créer la page en HTML
     */
    public function header()
    {
       ?> <!doctype html>
            <html style="background-color: aliceblue">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styleJeu.css">
                <title> Jeu du Bridge  </title>
            </head>
    <?php
    }

    /**
     * Méthode qui retourne le message de perte.
     */
    public function perdu()
    {
        echo "<H1><B>Vous avez perdu</B></H1>";

    }

    /**
     * Méthode qui retourne le message de victoire.
     */
    public function gagner()
    {
        $this->header();
        echo "<H1>Vous avez gagner</H1>";

    }



}
?>