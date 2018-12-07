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

        if (!isset($_SESSION['liaison']) && !isset($_SESSION['nbrLiaison']))
        {
            $_SESSION['liaison'] = array();
            $_SESSION['nbrLiaison']= 0;
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


                if ($this->lesV->liaisonPossible($id_ville, $ville2) && $this->lesV->getVilleID($id_ville)->lierVilles($ville2))
                {
                    $this->lierlesVIlles($id_ville, $ville2);


                    $couleur_mise = true;
                }


            }




        return $couleur_mise;


    }

    public function vue_actuelle(){

        return $this->TheVue;
    }


    public function lierlesVIlles($id_ville, $ville2)
    {

        if(!empty($_SESSION['liaison'])) {
            $exist=false;
            $depasserNombre = false;
            $nbr=0;
            $nbrDefinitif=0;
            foreach ($_SESSION['liaison'] as $association) {
                $v1 = $association[0];
                $v2 = $association[1];
                $nombre = $association[2];

                if (($v1 == $id_ville && $v2 == $ville2 || $v2 == $id_ville && $v1 == $ville2) && $nombre < 2) {
                    $exist=true;
                    $nbrDefinitif=$nbr;
                }
                if($nombre>=2)
                {
                    $depasserNombre=true;
                }
                $nbr++;
            }

            if($exist && !$depasserNombre)
            {
                #var_dump($_SESSION['liaison'][$nbrDefinitif]);
                $_SESSION['liaison'][$nbrDefinitif][2]++;
            }
            else if($depasserNombre) {
                echo "<br/>I WILL BUILD A WALL";
            }
            else if(!$exist)
            {
                $_SESSION['liaison'][$_SESSION['nbrLiaison']] = array($id_ville, $ville2, 1);
                $_SESSION['nbrLiaison']++;
            }

        }
        else
        {
            $_SESSION['liaison'][$_SESSION['nbrLiaison']] = array($id_ville, $ville2, 1);
            $_SESSION['nbrLiaison']++;
        }


        var_dump($_SESSION['liaison']);
    }





}