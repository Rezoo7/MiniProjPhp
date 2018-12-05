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

        $this->TheVue = $this->vue_chan->changer($id_ville);

        $x=$this->lesV->getVillePosX($id_ville);
        $y=$this->lesV->getVillePosY($id_ville);

        echo "coordonnées de ".$id_ville. " :". $x . ", " . $y;

        if ($_GET['ville2']>-1)
        {
            $ville2=$_GET['ville2'];
            $x=$this->lesV->getVillePosX($ville2);
            $y=$this->lesV->getVillePosY($ville2);

            echo "coordonnées de ".$ville2. " :". $x . "; " . $y;

            if($this->lesV->getVillePosX($id_ville)==$this->lesV->getVillePosX($ville2) || $this->lesV->getVillePosY($id_ville)==$this->lesV->getVillePosY($ville2))
            {
                echo "YESS";
                #$this->lesV->getVilleID($id_ville)->lierVilles($ville2);
        }
            else
            {
                echo "NOO";
                #$this->TheVue = $this->vuejeu->afficher_jeu();
            }
        }


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