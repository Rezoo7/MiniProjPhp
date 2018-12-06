<?php

require_once PATH_CONTROLEUR."/controleurAuthentification.php";
require_once PATH_CONTROLEUR."/ControleurErreur.php";
require_once PATH_CONTROLEUR."/ControleurJeuBridge.php";



class Routeur{

  private $ctrlAthentification;
  private $ctrlErreur;
  private $ctrlJeu;


  public function __construct(){

    $this->ctrlAthentification = new controleurAuthentification();
    $this->ctrlErreur = new ControleurErreur();
    $this->ctrlJeu = new ControleurJeuBridge();

    }


  public function routeurRequête()
  {

      if (isset($_GET['etat'])) {

          switch ($_GET['etat']) {

              case 'deconnexion':
                  unset($_SESSION['pseudo']);
                  unset($_SESSION['listes_villes']);
                  unset($_SESSION['ville1']);
                  unset($_SESSION['ville2']);
                  unset($_SESSION['liaison']);
                  unset($_SESSION['nbrLiaison']);
                  session_destroy();
                  break;

              case 'recommencer':
                  unset($_SESSION['listes_villes']);
                  unset($_SESSION['ville1']);
                  unset($_SESSION['ville2']);
                  unset($_SESSION['liaison']);
                  unset($_SESSION['nbrLiaison']);

              default:
                  break;
          }
      }


     if(isset($_GET['ville1'])) {

         for($i =0;$i<=9;$i++){

             if($_GET['ville1'] == $i){

                $this->ctrlJeu->couleur_ville($_GET['ville1']);
                $this->ctrlJeu->vue_actuelle();

             }


         }

     }



      if (isset($_POST['pseudo']) and isset($_POST['mdp'])) {
          if ($_POST['pseudo'] == "" or $_POST['mdp'] == "") {

              $this->ctrlErreur->Erreur("Pseudo ou mot de Passe Vide");
              $this->ctrlAthentification->accueil();

              return;

          } else {


              $this->ctrlAthentification->authentifier($_POST['pseudo'], $_POST['mdp']);

          }
      }


      if (!isset($_SESSION['pseudo'])) {

          $this->ctrlAthentification->accueil();


      } elseif(!isset($_GET['ville1'])){

          $this->ctrlJeu->afficher_bridge();
          $this->ctrlJeu->vue_actuelle();

      }

  }

  


}



 ?>
