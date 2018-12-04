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

  if( $pseudo != "" and $motdepasse != "" and $this->modele->connection_ok($pseudo, $motdepasse) == true){

    $_SESSION['pseudo'] = $pseudo;
  }
  else{


      $this->vueerreur->afficher_erreur("Connection Echouée (Pseudo et/ou Mot de Passe Invalide)");
  }

}







}







 ?>
