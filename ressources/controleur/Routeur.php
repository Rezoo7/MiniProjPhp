<?php

require_once PATH_CONTROLEUR."/controleurAuthentification.php";



class Routeur{

  private $ctrlAthentification;


  public function __construct(){

    $this->ctrlAthentification = new controleurAuthentification();
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
          if ($_POST['pseudo'] == "" or $_POST['mdp']== "" ) {
              $this->ctrlAthentification->accueil();
              echo "Pseudo / Mot de Pass vide";

          } else {

              $this->ctrlAthentification->authentifier($_POST['pseudo'], $_POST['mdp']);
          }
      }


      if(!isset($_SESSION['pseudo'])){

          $this->ctrlAthentification->accueil();

      }else{

        //controleur d'affichage jeu() + modifier jeu()
      }




    /*
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && !isset($_POST['demarrer'])){

      if($this->ctrlAthentification->authentifier($_POST['pseudo'], $_POST['mdp'])){

        $this->ctrlAthentification->lanceLeJeu();

        print_r($_POST['pseudo']);


      }
    }else{


         $this->ctrlAthentification->accueil();

    }




    if(isset($_POST['demarrer'])){

        $this->ctrlAthentification->commence();
    }
    

  */

    }

  


}



 ?>
