<?php

require_once PATH_CONTROLEUR."/controleurAuthentification.php";
require_once PATH_CONTROLEUR."/ControleurErreur.php";



class Routeur{

  private $ctrlAthentification;
  private $ctrlErreur;


  public function __construct(){

    $this->ctrlAthentification = new controleurAuthentification();
    $this->ctrlErreur = new ControleurErreur();

    }


  public function routeurRequête()
  {

      if (isset($_GET['commencer'])) {

          switch ($_GET['commencer']) {

              case 'deconnexion':
                  unset($_SESSION['pseudo']);
                  session_destroy();
                  break;

              case  'recommencer':
                  unset($_SESSION['tabvilles']);
                  break;

              default:
                  break;
          }
      }


      if (isset($_POST['pseudo']) and isset($_POST['mdp'])) {
          if ($_POST['pseudo'] == "" or $_POST['mdp'] == "") {

              $this->ctrlErreur->Erreur("Pseudo ou mot de Passe Vide");
              return;

          } else {

              $this->ctrlAthentification->authentifier($_POST['pseudo'], $_POST['mdp']);
          }
      }


      if (!isset($_SESSION['pseudo'])) {

          $this->ctrlAthentification->accueil();

      } else {

          echo "session pseudo active?";
          //controleur d'affichage jeu() + modifier jeu()
      }

  }

  


}



 ?>
