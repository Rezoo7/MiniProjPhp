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


    /**
     * Fonction qui permet d'afficher l'etat du plateau en fonctino du déroulement de la partie grace a la
     * variable de session listes_villes
     */

    public function afficher_bridge(){

        if(!isset($SESSION['listes_villes']) or $_SESSION['listes_villes'] == null) {

            $villes = new Villes();
            $_SESSION['listes_villes'] = $villes;
            $this->TheVue = $this->vuejeu->afficher_jeu($_SESSION['listes_villes']);

        }else{
            echo"Variable session => ";
            var_dump($_SESSION['listes_villes']);
            $this->TheVue = $this->vue_chan->changer($_SESSION['listes_villes']);
        }
    }


    public function couleur_ville($id_ville){


        if((!isset($_SESSION['ville1']) && !isset($_SESSION['ville2'])) || (!empty($_SESSION['ville1']) && empty($_SESSION['ville2']))) {  //si session ville 1 null et session ville 2 null :


            $_SESSION['ville1'] = $_GET['ville1'];  // IDs enregistrer dans les var sessions
            $_SESSION['ville2'] = $_GET['ville2'];



            $_GET['ville1'] = -1;
            $_GET['ville2'] = -1;


        }

            $couleur_mise = false;

            $this->TheVue = $this->vue_chan->changer($_SESSION['listes_villes']);

            $x1 = $this->lesV->getVillePosX($id_ville);
            $y1 = $this->lesV->getVillePosY($id_ville);

            echo "<br/> coordonnées de " . $id_ville . " :  " . $x1 . ", " . $y1;

            if ($_GET['ville2'] > -1) {
                $ville2 = $_GET['ville2'];

                $x2 = $this->lesV->getVillePosX($ville2);
                $y2 = $this->lesV->getVillePosY($ville2);


                if ($this->lesV->liaisonPossible($_GET['ville1'], $_GET['ville2']) && (($this->lesV->getVilleID($_GET['ville1'])->getNombrePonts() > $this->lesV->getVilleID($_GET['ville1'])->getNombrePontsMax())
                        && ($this->lesV->getVilleID($_GET['ville1'])->getNombrePonts() > $this->lesV->getVilleID($_GET['ville1'])->getNombrePontsMax()))) {
                    $couleur_mise = true;
                    $this->lesV->getVilleID($id_ville)->lierVilles($ville2);  // Si liaison possible enregistrer dans deux variables de sessions => deux id de villes


                }
            }




        return $couleur_mise;


    }

    public function vue_actuelle(){

        return $this->TheVue;
    }





}