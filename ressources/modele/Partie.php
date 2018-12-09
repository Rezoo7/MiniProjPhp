<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 05/12/2018
 * Time: 18:28
 */

require_once PATH_MODELE."/Villes.php";
require_once PATH_MODELE."/Modele.php";

class Partie
{

    private $connexion;
    private $lesV;
    private $modele;


    public function __construct()
    {

        $this->modele =new Modele();
        $this->lesV = new Villes();


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

    /**
     * Fonction qui renvoie vrai si la partie en cours esr Gagnée ou pas
     *
     * @param $var_villes
     * @return bool
     */

    public function isWin($var_villes){

        foreach ($var_villes as $ville ){
            if($ville->getNombrePonts() < $ville->getNombrePontsMax()){
                return false;
            }
            //echo "Ville :" . $ville->getNombrePonts() . "Nombre MAX" . $ville->getNombrePontsMax();
        }
        return true;
    }

    public function isLose($var_villes){

        foreach ($var_villes as $ville ){
            if($ville->getNombrePonts() > $ville->getNombrePontsMax()){
                return true;
            }
            //echo "Ville :" . $ville->getNombrePonts() . "Nombre MAX" . $ville->getNombrePontsMax();
        }

        return false;
    }



    /**
     * @param $pseudo_g : pseudo du joueur
     *
     * Méthode qui permet d'insérer un partie gagnée dans la base de donnée
     * La partie gagnée est désignée dans la colonne partieGagnee par le nombre 1
     */
    public function win($pseudo_g){


        $statement = $this->connexion->prepare("INSERT INTO parties VALUES(NULL,?,1);");
        $statement->bindParam(1,$pseudo_g);
        $statement->execute();
        $statement->closeCursor();
        return;
    }

    /**
     * @param $pseudo_g : pseudo du joueur
     *
     * Méthode qui permet d'insérer un partie gagnée dans la base de donnée
     * La partie gagnée est désignée dans la colonne partieGagnee par le nombre 1
     */


    public function lose($pseudo_g){

        $statement = $this->connexion->prepare("INSERT INTO parties VALUES (NULL,?,0);");
        $statement->bindParam(1,$pseudo_g);
        $statement->execute();
        $statement->closeCursor();
        return;
    }

    /**
     * Fonction qui renvoie le ratio du joueur
     * @param $pseudo_g
     * @return float|int ratio = ratio de victoire/défaite en pourcentage !
     */

    public function ratio($pseudo_g){

        if ($this->nbr_parties($pseudo_g)>0) {

            $statement = $this->connexion->prepare("SELECT SUM(partieGagnee) FROM parties WHERE pseudo = ? AND partieGagnee=1 GROUP BY pseudo");
            $statement->bindParam(1, $pseudo_g);
            $statement->execute();
            $lesvictoires = $statement->fetchAll();
            $statement->closeCursor();

            if (!empty($lesvictoires)) {
                $nombreV = $lesvictoires[0][0];


                $statementL = $this->connexion->prepare("SELECT COUNT(partieGagnee) FROM parties WHERE pseudo = ? AND partieGagnee=0 GROUP BY pseudo");
                $statementL->bindParam(1, $pseudo_g);
                $statementL->execute();
                $lesdefaites = $statementL->fetchAll();
                $statementL->closeCursor();
                if (!empty($lesdefaites)) {
                    $nombreL = $lesdefaites[0][0];
                    $ratio = $nombreV / ($nombreV + $nombreL);
                    return ", vous avez ".intval($ratio * 100) . "% de réussite avec ". $this->nbr_parties($pseudo_g). " parties jouées.";
                }
                return ", vous n'avez jamais perdu";
            }
            return ", vous n'avez jamais gagner";
        }
        else
        {
            return "vous n'avez jamais joué";
        }
    }

    /**
     * Fonction qui permet d'obtenir le classement du jeu grâce à la base de donnée
     * @return classement des meilleurs joueurs
     */

    public function meilleurs_Joueurs(){


        $statement = $this->connexion->query("SELECT pseudo, COUNT(partieGagnee) p FROM parties WHERE partieGagnee =1 GROUP BY pseudo ORDER BY p DESC LIMIT 3 ");
        $statement->execute();
        $classement = $statement->fetchAll();

        return $classement;

    }

    public function nbr_gagnees($pseudo){

        $statement = $this->connexion->prepare("SELECT COUNT(partieGagnee) FROM parties WHERE partieGagnee =1 AND  pseudo=? GROUP BY pseudo");
        $statement->bindParam(1,$pseudo);
        $statement->execute();
        $nombre = $statement->fetchAll();

        $victoires = $nombre[0][0];
        return $victoires;
    }


    public function nbr_parties($pseudo){

        $statement = $this->connexion->prepare("SELECT COUNT(partieGagnee) FROM parties WHERE pseudo=? GROUP BY pseudo");
        $statement->bindParam(1,$pseudo);
        $statement->execute();
        $nombre = $statement->fetchAll();

        if (!empty ($total))
        {
            $total = $nombre[0][0];
            return $total;
        }
        else return 0;

    }


}