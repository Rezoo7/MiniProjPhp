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


function authentifier($pseudotest, $motdepasse){

  if($this->modele->existe($pseudotest, $motdepasse)){
    return true;
  }
  return false;

}







}







 ?>
