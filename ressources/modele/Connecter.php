<?php

// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}


// Exception relative à un probleme de connexion
class ConnexionException extends MonException{
}

// Exception relative à un probleme d'accès à une table
class TableAccesException extends MonException{
}


//classe qui reprend les mêmes principes que modele.php


class Connecter {


  private $connexion;

  public function __construct() {
    try{
    $chaine="mysql:host=".HOST.";dbname=".BD;
    $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
    $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     }
    catch(PDOException $e){
      $exception=new ConnexionException("problème de connexion à la base");
      throw $exception;
    }
  }




  public function deconnexion(){
   $this->connexion=null;
}




public function getPseudos(){
 try{

$statement=$this->connexion->query("SELECT pseudo from pseudonyme;");

while($ligne=$statement->fetch()){
$result[]=$ligne['pseudo'];
}
return($result);
}
catch(PDOException $e){
    throw new TableAccesException("problème avec la table pseudonyme");
  }
}


public function existe($pseudo, $mdp){
  try{
    $declaration = $this->connexion->prepare("select pseudo from joueurs where pseudo=? and motDePasse=?;");
    $declaration->bindparam(1, $pseudo);
    $declaration->bindparam(2, crypt($mdp));
    $declaration->execute();
    $resultat=$declaration->fetch(PDO::FETCH_ASSOC);

    if($resultat["pseudo"]==NULL)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  catch(PDOException $s)
  {
    $this->deconnexion();
    throw new TableAccesException("problème de table joueurs");
  }
}



}