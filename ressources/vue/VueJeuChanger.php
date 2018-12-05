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



    public function changer($idville){

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
                ?>
                <tr>

                    <?php
                    for ( $j=0; $j <=6; $j ++ )
                    {
                        ?>
                        <td>
                            <?php
                            if ($this->villes->existe($i,$j))
                            {

                                $laVille = $this->villes->getVille($i,$j);
                                $src_image = "../ressources/Image/numero".$laVille->getNombrePontsMax().".png";

                                if($laVille->getID() == $idville || $laVille->getID()==$_GET["ville2"] ) {

                                    $ville_modif = $this->villes->getVille($i, $j);
                                    $src_image = "../ressources/Image/vert/vnumero" . $ville_modif->getNombrePontsMax() . ".png";

                                }

                                $ville_id = $laVille->getId();

                                #echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville=".$ville_id."&ville2=".$_GET[ville]."><img src=\"".$src_image."\" width='50'></a>";

                                echo "<a href= http://localhost/miniprojphp/ressources/index.php?ville=".$idville."&ville2=".$ville_id."><img src=\"".$src_image."\"></a>";


                            }
                            else
                            {
                                echo "   ";
                            }
                            ?></td>
                        <?php
                    }
                    ?>  </tr>
                <?php
            }
            ?>
        </table>
        <!-- bonjour je fais un test | SALUT BUGO | Yo Monsieur REZOO -->

        </form>

        <br>  <br>

        <button id="bouton"><a href='index.php?etat=deconnexion'> Quitter </a></button>

        </body>
        </html>

<?php


        echo $idville ." - ";
        echo $_GET['ville2'];
    }


}

?>