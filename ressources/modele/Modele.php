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
        $this->connexion = new PDO('mysql:host',LOGIN,MDP);
    }

    /**
     * Fonction qui va permettre de tester si la connection est bonne (pseudo + mot de passe)
     *
     * @param $pseudo
     * @param $mdp
     * @return bool
     */



    public function connection_ok($pseudo,$mdp){

        if($this->pseudo_ok($pseudo)){

            $password = $this->connexion()->prepare("SELECT motdePass FROM joueurs WHERE pseudo = ?;");
            $password->bindParam(1,pseudo);
            $password->execute();

            $resultats = $password->fetchAll();
            $passcoder = crypt($mdp, $resultats[0][0]);

            if($passcoder == $resultats[0][0]){

                $statement = $this->connexion->prepare("SELECT * FROM joueurs where pseudo=? AND motDePasse=?;");
                $statement->bindParam(1,$pseudo);
                $statement->bindParam(2,$mdp);
                $statement->execute();
                $resultat = count($statement->fetchAll());

                if($resultat > 0){
                    return true;
                }
                else{
                    return false;
                }
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

        $statement = $this->connexion->prepare("SELECT pseudo FROM joueurs WHERE pseudo= ?;");
        $statement->bindParam(1,$pseudo);
        $statement->execute();

        $resultats = count($statement->fetchAll());

        if($resultats > 0){
            return true;
        }
        else{
            return false;
        }

    }

}