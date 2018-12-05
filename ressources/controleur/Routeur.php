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
                  session_destroy();
                  break;

              default:
                  break;
          }
      }

     if(isset($_GET['ville'])) {

         for($i =1;$i<=9;$i++){

             if($_GET['ville'] == $i){

                $this->ctrlJeu->couleur_ville($_GET['ville']);

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


      } else {

          $this->ctrlJeu->afficher_bridge();

          //controleur d'affichage jeu() + modifier jeu()
      }

  }

  


}



 ?>
