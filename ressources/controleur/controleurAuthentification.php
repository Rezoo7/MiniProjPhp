<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/Connecter.php";
require_once PATH_MODELE."/Modele.php";


class ControleurAuthentification{

private $vueAuthentif;
private $modele;

public function __construct(){

  $this->vueAuthentif = new VueAuthentification();
  $this->modele = new Modele();
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

  if($this->modele->connection_ok($pseudo, $motdepasse)){

    $_SESSION['pseudo'] = $pseudo;
  }
  else{

    $this->accueil();
    echo "Authentification Invalide";
  }

}







}







 ?>
