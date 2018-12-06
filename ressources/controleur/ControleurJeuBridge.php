<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 04/12/2018
 * Time: 19:47
 */

require_once PATH_VUE."/VueJeuBridge.php";
require_once PATH_VUE."/VueJeuChanger.php";
require_once PATH_VUE."/VueJeuChanger.php";
require_once PATH_MODELE."/Partie.php";
require_once PATH_MODELE."/Villes.php";




class ControleurJeuBridge
{

   private $vuejeu;
   private $partie_mod;
   private $lesV;
   private $vue_chan;

   private $TheVue;
   private $selected;

    public function __construct(){

        $this->vuejeu = new VueJeuBridge();
        $this->partie_mod = new Partie();
        $this->lesV =new Villes();
        $this->vue_chan = new VueJeuChanger();
       $this->selected = false;



    }


    public function afficher_bridge(){

       $this->TheVue = $this->vuejeu->afficher_jeu();
    }


    public function couleur_ville($id_ville){

        $couleur_mise = false;

        $this->TheVue = $this->vue_chan->changer($id_ville);

        $x1=$this->lesV->getVillePosX($id_ville);
        $y1=$this->lesV->getVillePosY($id_ville);

        echo "<br/> coordonnées de ".$id_ville. " :  ". $x1 . ", " . $y1;

        if ($_GET['ville2']>-1)
        {
            $ville2=$_GET['ville2'];

            $x2=$this->lesV->getVillePosX($ville2);
            $y2=$this->lesV->getVillePosY($ville2);

            echo "<br/>coordonnées de ".$ville2. " :  ". $x2 . "; " . $y2 ."<br/>";

            if($this->lesV->liaisonPossible($id_ville, $_GET['ville2']))
            {
                //TODO
                //utiliser la fonction de liaison entre villes
                //et accéssoirement afficher les ponts

                /*for ($i = 0; $i <= 9;$i++){
                    for ($j=0;$j<=9;$j++){

                        // si la position x de la ville tester est superieur
                        // à la ville clikee et inf à celui de ville2 alors NOP
                        // = si il y a une ville entre les deux

                        if( !($this->lesV->existe($i,$j) && ((($i > $x1) && ($i < $x2)) || (($j > $y1) && ($j < $y2))))  ){
*/
                            $this->lesV->getVilleID($id_ville)->lierVilles($ville2);
                            $couleur_mise = true;
                            echo "YESS";

                        /*}else{
                            echo "Ville entre les deux !";
                            $couleur_mise=false;
                            break;
                        }

                    }
                }*/


                #$this->lesV->getVilleID($id_ville)->lierVilles($ville2); //ça ça donne une errreur que je ne sais pas trop ce que ça veut dire faut check ville.php->lierVilles
        }
            else
            {

                echo "NOPE";


            }
        }

        return $couleur_mise;


    }

    public function vue_actuelle(){

        return $this->TheVue;
    }



    public function modifier_jeu($id_ville){

        $laville = $this->lesV->getVilleID($id_ville);

        if($this->partie_mod->isSelected($laville)){



        }


    }


}