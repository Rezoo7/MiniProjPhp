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



    public function __construct(){

        $this->vuejeu = new VueJeuBridge();
        $this->partie_mod = new Partie();
        $this->lesV =new Villes();
        $this->vue_chan = new VueJeuChanger();



    }


    public function afficher_bridge(){

       $this->TheVue = $this->vuejeu->afficher_jeu();
    }


    public function couleur_ville($id_ville){

        $this->TheVue = $this->vue_chan->changer($id_ville);

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