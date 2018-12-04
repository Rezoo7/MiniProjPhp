<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 03/12/2018
 * Time: 23:08
 *
 * Va servir a gérer l'accès aux données !
 */

class Modele
{

    private $connexion;
    public function __construct()
    {
        try{
            $chaine="mysql:host=localhost;dbname=projet";
            $this->connexion = new PDO($chaine,"root","");
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            $exception=new ConnexionException("problème de connection à la base");
            throw $exception;
        }
    }

    // méthode qui permet de se deconnecter de la base
    public function deconnexion(){
        $this->connexion=null;
    }






    /**
     * Fonction qui va permettre de tester si la connection est bonne (pseudo + mot de passe)
     *
     * @param $pseudo
     * @param $mdp
     * @return bool
     */



    public function connection_ok($pseudo,$mdp){

        $convertPseudo =  htmlspecialchars($pseudo);

        if($this->pseudo_ok($convertPseudo)){

            $convertMdp = htmlspecialchars($mdp);


            $password = $this->connexion()->prepare("SELECT motdePasse FROM joueurs WHERE pseudo=?;");
            $password->bindParam(1,$convertPseudo);
            $password->execute();

            $resultats = $password->fetchAll();
            $password->closeCursor();

            $passcoder = crypt($convertPseudo, $resultats[0][0]);

            if($passcoder === $resultats[0][0]){

                $statement = $this->connexion->prepare("SELECT * FROM joueurs where pseudo=? AND motDePasse=?;");
                $statement->bindParam(1,$convertPseudo);
                $statement->bindParam(2,$resultats[0][0]);
                $statement->execute();

                $reponse = $statement->fetchAll();
                $statement->closeCursor();

                return(count($reponse) > 0);
            }
            else{

                return false;
            }
        }
        else{

            return false;
        }



    }


    /**
     * Fonction qui va permettre de tester si le pseudo est bon (pseudo seul)
     *
     * @param $pseudo
     * @return bool
     */


    public function pseudo_ok($pseudo){

        try{

            $statement=$this->connexion->query("SELECT pseudo from joueurs where pseudo = ?;");
            $statement->bindParam(1,$pseudo);

            $result= $statement->fetch();

            if($result['pseudo'] != null){
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $e){
            throw new TableAccesException("problème avec la table joueurs");
        }

    }

}