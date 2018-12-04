<?php
require_once PATH_VUE."/vueAuthentification.php";
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

  if( $pseudo != "" and $motdepasse != "" and $this->modele->connection_ok($pseudo, $motdepasse) == true){

    $_SESSION['pseudo'] = $pseudo;
  }
  else{

    echo "Authentification Invalide";
  }

}







}







 ?>
