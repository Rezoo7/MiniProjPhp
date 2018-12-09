<?php
require_once PATH_VUE."/vueAuthentification.php";
require_once PATH_MODELE."/Modele.php";
require_once PATH_VUE."/VueErreur.php";


class ControleurAuthentification{

private $vueAuthentif;
private $modele;
private $vueerreur;

public function __construct(){

  $this->vueAuthentif = new VueAuthentification();
  $this->modele = new Modele();
  $this->vueerreur = new VueErreur();

}


function accueil(){
  $this->vueAuthentif->AffichageCo();
}


    /**
     * Test l'authentification est bonne ou fausse
     *
     * @param $pseudotest
     * @param $motdepasse
     * @return bool
     */

function authentifier($pseudo, $motdepasse){

  if( $pseudo != "" and $motdepasse != "" and $this->modele->connection_ok($pseudo, $motdepasse) == 1){

    $_SESSION['pseudo'] = $pseudo;

  }
  else {

      if ($this->modele->connection_ok($pseudo, $motdepasse) == -1) {
          $this->vueerreur->afficher_erreur("Connection Echouée : Votre Pseudo est Invalide !)");
      }
      elseif($this->modele->connection_ok($pseudo, $motdepasse) == -2){

          $this->vueerreur->afficher_erreur("Connection Echouée : Votre Mot de Passe est Invalide !");
      }
  }

}

function ajouter_compte($pseudo,$mdp1,$mdp2){


    if($mdp1 == $mdp2){

        $this->modele->ajout_compte($pseudo,$mdp1);
    }
    else{

        echo "<br> <h1 style='color: darkred'>Mots de Passe différents</h1> ";
    }

}







}







 ?>
