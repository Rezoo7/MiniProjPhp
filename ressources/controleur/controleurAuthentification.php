<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/Connecter.php";
require_once PATH_MODELE."/Modele.php";


class ControleurAuthentification{

private $vue;
private $modele;

public function __construct(){

  $this->vue = new Vue();
  $this->modele = new Connecter();
}


function accueil(){
  $this->vue->demandePseudo();
}


function authentifier($pseudotest, $motdepasse){

  if($this->modele->existe($pseudotest, $motdepasse)){
    return true;
  }
  return false;

}



function lanceLeJeu()
{
  $this->vue->lancerlejeu();
}



function commence(){

	$this->vue->commencer();
}







}







 ?>
