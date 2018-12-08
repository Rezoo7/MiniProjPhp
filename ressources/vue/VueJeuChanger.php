<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 05/12/2018
 * Time: 18:51
 */


class VueJeuChanger
{
    //TODO Nettoyer le code grâce a comparer_X($id1,$id2) et comparer_Y(same)


    /**
     * @param $liste_villes tableau de villes passe en parametres
     */

    public function changer($liste_villes){


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
        <h4> Nombre de ponts à construire : <?php echo " ".$liste_villes->total_Ponts()?></h4>
        <br>
        <br>
        <table class="center" cellpadding="0" cellspacing="0" border="0">
            <?php

            if(isset($_SESSION['listes_villes'])) {
                #echo $_SESSION['listes_villes'];
                // echo $liste_villes;
                for ($i = 0; $i <= 6; $i++) {
                    echo"<tr>";
                        for ($j = 0; $j <= 6; $j++) {
                            echo"<td>";
                                if ($liste_villes->existe($i, $j)) {

                                    $laVille = $liste_villes->getVille($i, $j);
                                    echo "PONTS : ".$laVille->getNombrePonts();

                                    //vérification de la séléction : (images des ponts)
                                    $src_image = "../ressources/Image/numero" . $laVille->getNombrePontsMax() . ".png";

                                    if ($laVille->getID() == $_GET['ville1'] || $laVille->getID() == $_GET["ville2"]) {
                                        $src_image = "../ressources/Image/vert/vnumero" . $laVille->getNombrePontsMax() . ".png";


                                        if (!($liste_villes->liaisonPossible($_GET['ville1'], $_GET['ville2'])) && $_GET['ville2'] > -1) {
                                            $src_image = "../ressources/Image/rouge/rnumero" . $laVille->getNombrePontsMax() . ".png";
                                        }

                                    }


                                    $ville_id = $laVille->getId();

                                    #echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville1=".$ville_id."&ville2=".$_GET[ville]."><img src=\"".$src_image."\" width='50'></a>";

                                    echo "<a href= http://localhost/miniproj/ressources/index.php?ville1=" . $ville_id . "&ville2=" . $_GET['ville1'] . "><img src=\"" . $src_image . "\"></a>";

                                    //TODO PONT AFFICHER AU MOMENT DU CLIQUE DEUXIEME VILLE
                                    // TODO AFFICHER VICTOIRE OU DEFAITE

                                }



                                    foreach($_SESSION['liaison'] as $idvilles) {
                                        $idville1 = $idvilles[0];
                                        $idville2 = $idvilles[1];
                                        $nombreLiaisons = $idvilles[2];

                                        $test_x = array($liste_villes->getVillePosX($idville2), $liste_villes->getVillePosX($idville1));
                                        $test_y = array($liste_villes->getVillePosY($idville2), $liste_villes->getVillePosY($idville1));

                                        if (($liste_villes->comparer_Y($idville1, $idville2)) && ($j == $liste_villes->getVillePosY($idville1)) && ($i < max($test_x)) && ($i > min($test_x))) {

                                            if ($nombreLiaisons==1)
                                                $src_image = "../ressources/Image/Barres/BarreSimpleVerticale.png";
                                            else
                                                $src_image = "../ressources/Image/Barres/BarreDoubleVerticale.png";
                                            echo "<img src=\"" . $src_image . "\">";

                                        }
                                        if (($liste_villes->comparer_X($idville1, $idville2)) && ($i == $liste_villes->getVillePosX($idville1)) && ($j < max($test_y)) && ($j > min($test_y))) {
                                            if ($nombreLiaisons==1)
                                                $src_image = "../ressources/Image/Barres/BarreSimpleHorizontale.png";
                                            else
                                                $src_image = "../ressources/Image/Barres/BarreDoubleHorizontale.png";
                                            echo "<img src=\"" . $src_image . "\">";

                                        }
                                    }


                                    echo "   ";

                                echo "</td>";
                        }
                          echo"</tr>";
                }
            }
            ?>
        </table>
        <!-- bonjour je fais un test | SALUT BUGO | Yo Monsieur REZOO hhh-->

        </form>

        <br>  <br>


        <a href='index.php?etat=recommencer'><button id="bouton"> Recommencer </button></a>
        <a href='index.php?etat=stats'><button id="bouton"> Statistiques </button></a>
        <a href='index.php?etat=deconnexion'><button id="bouton"> Quitter </button></a>


        </body>
        </html>

<?php


        echo $_GET['ville1'] ." - ";
        echo $_GET['ville2'];
    }


}

?>