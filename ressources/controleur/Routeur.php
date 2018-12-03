<?php

require_once PATH_CONTROLEUR."controleurAuthentification.php";



class Routeur{

  private $ctrlAthentification;


  public function __construct(){

    $this->ctrlAthentification = new controleurAuthentification();
    }


  public function routeurRequête(){








    /*
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && !isset($_POST['demarrer'])){

      if($this->ctrlAthentification->authentifier($_POST['pseudo'], $_POST['mdp'])){

        $this->ctrlAthentification->lanceLeJeu();
        $acc = false;


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
