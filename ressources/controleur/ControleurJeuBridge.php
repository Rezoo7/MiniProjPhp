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
            //echo"Variable session => ";
            //var_dump($_SESSION['listes_villes']);
            $this->TheVue = $this->vue_chan->changer($_SESSION['listes_villes']);
        }
    }


    public function couleur_ville($id_ville){
        //echo "retour en haut";
        if($this->etatDeLaPartie()=="perdu")
        {
            $this->partie_mod->win($_SESSION['pseudo']);
            $this->vuejeu->header();
            $this->vuejeu->perdu();
            $this->vuejeu->bouttons();
            $this->afficher_Stats();
        }

        elseif ($this->etatDeLaPartie()=="gagner")
        {
            $this->partie_mod->lose($_SESSION['pseudo']);
            $this->vuejeu->header();
            $this->vuejeu->gagner();
            $this->vuejeu->bouttons();
            $this->afficher_Stats();
        }

        else {
            //echo "<br/> sinon";
            if ((!isset($_SESSION['ville1']) && !isset($_SESSION['ville2'])) || (!empty($_SESSION['ville1']) && empty($_SESSION['ville2']))) {  //si session ville 1 null et session ville 2 null :
                $_SESSION['ville1'] = $_GET['ville1'];  // IDs enregistrer dans les var sessions
                $_SESSION['ville2'] = $_GET['ville2'];
                $_GET['ville1'] = -1;
                $_GET['ville2'] = -1;
            }
            if (!isset($_SESSION['liaison']) && !isset($_SESSION['nbrLiaison'])) {
                $_SESSION['liaison'] = array();
                $_SESSION['nbrLiaison'] = 0;
            }
            $couleur_mise = false;
            $this->TheVue = $this->vue_chan->changer($_SESSION['listes_villes']);
            $x1 = $this->lesV->getVillePosX($id_ville);
            $y1 = $this->lesV->getVillePosY($id_ville);
            //echo "<br/> coordonnées de " . $id_ville . " :  " . $x1 . ", " . $y1;
            if ($_GET['ville2'] > -1) {
                $ville2 = $_GET['ville2'];
                $x2 = $this->lesV->getVillePosX($ville2);
                $y2 = $this->lesV->getVillePosY($ville2);
                if ($this->lesV->liaisonPossible($id_ville, $ville2) && $this->lesV->getVilleID($id_ville)->lierVilles($ville2)) {
                    $this->lierlesVilles($id_ville, $ville2);

                    $couleur_mise = true;
                }
            }
            return $couleur_mise;
        }
    }



    public function vue_actuelle(){

        return $this->TheVue;
    }


    public function lierlesVilles($ville1, $ville2)
    {

        $xVille1=$_SESSION['listes_villes']->getVillePosX($ville1);
        $yVille1=$_SESSION['listes_villes']->getVillePosY($ville1);
        $xVille2=$_SESSION['listes_villes']->getVillePosX($ville2);
        $yVille2=$_SESSION['listes_villes']->getVillePosY($ville2);

        //echo "<br> " . $ville1 ."Ville 1 :      Nombre de ponts => " . $_SESSION['listes_villes']->getVilleID($ville1)->getNombrePonts();
        //echo "<br> " . $ville2 ."Ville 2 :      Nombre de ponts => " . $_SESSION['listes_villes']->getVilleID($ville2)->getNombrePonts();
        //var_dump($_SESSION['listes_villes']);


        if(!empty($_SESSION['liaison'])) {
            $exist=false;
            $nbr=0;

            $nbrDefinitif=-1;
            foreach ($_SESSION['liaison'] as $association) {
                $depasserNombre = false;
                $v1 = $association[0];
                $v2 = $association[1];
                $nombre = $association[2];

                if ((($v1 == $ville1 && $v2 == $ville2) || ($v2 == $ville1 && $v1 == $ville2))) {
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
                echo "AJOUT S'IL EXSITE MAIS LE NOMBRE N'EST PAS DEPASSE";
                $_SESSION['listes_villes']->getVilleID($ville1)->addPont();
                $_SESSION['listes_villes']->getVilleID($ville2)->addPont();

            }
            else if(!$exist)
            {
                $_SESSION['liaison'][$_SESSION['nbrLiaison']] = array($ville1, $ville2, 1);
                $_SESSION['nbrLiaison']++;
                echo 'AJOUT SIL NEXSITE PAS';
                $_SESSION['listes_villes']->getVilleID($ville1)->addPont();
                $_SESSION['listes_villes']->getVilleID($ville2)->addPont();
            }

        }
        else
        {
            $_SESSION['liaison'][$_SESSION['nbrLiaison']] = array($ville1, $ville2, 1);
            $_SESSION['nbrLiaison']++;
            $_SESSION['listes_villes']->getVilleID($ville1)->addPont();
            $_SESSION['listes_villes']->getVilleID($ville2)->addPont();
            echo "AJOUT SI VIDE";
        }
        var_dump($_SESSION['liaison']);
}



    public function afficher_Stats()
    {


        $classement = $this->partie_mod->meilleurs_Joueurs();

        echo "<h4> Classement des Joueurs : </h4>";
        $place = 1;

        foreach ($classement as $row) {

            $ligne = "<p style='text-align: center'>" . $place . "&#9658" . "<B>&nbsp;" . $row["pseudo"] . "</B> &nbsp;&nbsp;&nbsp;&nbsp;Nombre de Victoires: " . $this->partie_mod->nbr_gagnees($row["pseudo"]) . "</p>";
            $place++;
            echo $ligne;
        }
    }
    public function renvoyerLesVilles()
    {
        $nbr=0;
        $liste=array();
        for ($i = 0; $i <= 6; $i++) {
            for ($j = 0; $j <= 6; $j++) {
                if ($_SESSION['listes_villes']->existe($i, $j)) {
                    $liste[$nbr]=$_SESSION['listes_villes']->getVille($i,$j);
                    $nbr++;
                }
            }
        }
        return $liste;
    }

    public function etatDeLaPartie()
    {
        $ListeDesVilles= $this->renvoyerLesVilles();

        if($this->partie_mod->isLose($ListeDesVilles))
        {
            unset($_SESSION['listes_villes']);
            unset($_SESSION['ville1']);
            unset($_SESSION['ville2']);
            unset($_SESSION['liaison']);
            unset($_SESSION['nbrLiaison']);
            return "perdu";
        }

        if($this->partie_mod->isWin($ListeDesVilles))
        {
            unset($_SESSION['listes_villes']);
            unset($_SESSION['ville1']);
            unset($_SESSION['ville2']);
            unset($_SESSION['liaison']);
            unset($_SESSION['nbrLiaison']);
            return "gagner";
        }

        return;

    }





}