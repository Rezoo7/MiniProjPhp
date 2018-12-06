<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 05/12/2018
 * Time: 18:51
 */

require_once PATH_MODELE."/Villes.php";

class VueJeuChanger
{

    private $villes;

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
        <br>
        <br>
        <table class="center" cellpadding="0" cellspacing="0" border="0">
            <?php

            if(isset($_SESSION['listes_villes'])) {

                for ($i = 0; $i <= 6; $i++) {
                    ?>
                    <tr>

                        <?php
                        for ($j = 0; $j <= 6; $j++) {
                            ?>
                            <td>
                                <?php

                                if ($liste_villes->existe($i, $j)) {

                                    $laVille = $liste_villes->getVille($i, $j);

                                    $src_image = "../ressources/Image/numero" . $laVille->getNombrePontsMax() . ".png";
                                    //vérification de la séléction :
                                    if ($laVille->getID() == $_GET['ville1'] || $laVille->getID() == $_GET["ville2"]) {


                                        if ($this->villes->liaisonPossible($_GET['ville1'], $_GET['ville2'])) {
                                            $src_image = "../ressources/Image/vert/vnumero" . $laVille->getNombrePontsMax() . ".png";

                                        } else {
                                            $src_image = "../ressources/Image/rouge/rnumero" . $laVille->getNombrePontsMax() . ".png";

                                        }
                                    }


                                    $ville_id = $laVille->getId();

                                    #echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville=".$ville_id."&ville2=".$_GET[ville]."><img src=\"".$src_image."\" width='50'></a>";

                                    echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville1=" . $_GET['ville1'] . "&ville2=" . $ville_id . "><img src=\"" . $src_image . "\"></a>";


                                } else {


                                    if ($this->villes->liaisonPossible($_GET['ville1'], $_GET['ville2'])) {


                                        $test_x = array($this->villes->getVillePosX($_GET['ville2']), $this->villes->getVillePosX($_GET['ville1']));
                                        $test_y = array($this->villes->getVillePosY($_GET['ville2']), $this->villes->getVillePosY($_GET['ville1']));


                                        if (($this->villes->getVillePosY($_GET['ville1']) == $this->villes->getVillePosY($_GET['ville2'])) && ($j == $this->villes->getVillePosY($_GET['ville1'])) && ($i < max($test_x)) && ($i > min($test_x))) {

                                            $src_image = "../ressources/Image/Barres/BarreSimpleVerticale.png";
                                            echo "<img src=\"" . $src_image . "\">";

                                        }
                                        if (($this->villes->getVillePosX($_GET['ville1']) == $this->villes->getVillePosX($_GET['ville2'])) && ($i == $this->villes->getVillePosX($_GET['ville1'])) && ($j < max($test_y)) && ($j > min($test_y))) {

                                            $src_image = "../ressources/Image/Barres/BarreSimpleHorizontale.png";
                                            echo "<img src=\"" . $src_image . "\">";

                                        }


                                    }

                                    echo "   ";

                                }
                                ?></td>
                            <?php
                        }
                        ?>  </tr>
                    <?php
                }
            }

            ?>
        </table>
        <!-- bonjour je fais un test | SALUT BUGO | Yo Monsieur REZOO hhh-->

        </form>

        <br>  <br>

        <a href='index.php?etat=recommencer'><button id="bouton"> Recommencer </button></a>
        <a href='index.php?etat=deconnexion'><button id="bouton"> Quitter </button></a>

        </body>
        </html>

<?php


        echo $_GET['ville1'] ." - ";
        echo $_GET['ville2'];
    }


}

?>