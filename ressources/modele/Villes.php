<?php
// cette classe ne doit pas être modifiée
require "Ville.php";

class Villes{

private $villes;

function __construct(){
// tableau représentatif d'un jeu qui servira à développer votre code

$this->villes[0][0]=new Ville("0",3,0);
$this->villes[0][6]=new Ville("1",2,0);
$this->villes[3][0]=new Ville("2",6,0);
$this->villes[3][5]=new Ville("3",2,0);
$this->villes[5][1]=new Ville("4",1,0);
$this->villes[5][6]=new Ville("5",2,0);
$this->villes[6][0]=new Ville("6",2,0);

}


// sélecteur qui retourne la ville en position $i et $j 
// précondition: la ville en position $i et $j existe
          
function getVille($i,$j){
return $this->villes[$i][$j];
}

    /**
     * Permet d'obtenir une Ville grâce à un ID
     * @param $id de la Ville
     * @return la ville
     */
function getVilleID($id){
    for ($i=0; $i<7; $i++) //Parcours de X
    {
        for ($j=0; $j<7; $j++) //Parcours de Y
        {
            if(isset($this->villes[$i][$j]) && $this->villes[$i][$j]->getId()==$id) //Si la case sur laquelle je pointe contient une ville
            {//et que  l'ID de la ville recherchée est le même que la ville pointée
                return $this->villes[$i][$j]; // alors je retourne la ville en question.
            }
            //sinon je test jusqu'à avoir atteint toutes les coordonnées possibles.
        }
    }
    return null; // SI rien est trouvé on retourne null.
    }

    /**
     * Retourne la position X de la ville avec l'ID mis en paramètre
     * @param $id de la Ville
     * @return int Position X
     */
    function getVillePosX($id)
    {

        for ($i=0; $i<7; $i++) //parcours de X
        {

            for ($j=0; $j<7; $j++) //parcours de Y
            {
                if(isset($this->villes[$i][$j])&&($this->villes[$i][$j]->getId() == $id))  //si la case n'est pas vide
                { // et que  l'ID de la ville recherchée est le même que la ville pointée
                        return $i; //renvoie la valeur i actuelle.

                    }
                }
            }//on continue jusqu'à la fin des coordonnées.
        return -1; //s'il n'a pas de position x alors on retourne -1.
        }

    /**
     * Retourne la position Y de la ville avec l'ID mis en paramètre
     * @param $id de la Ville
     * @return int Position Y
     */
    function getVillePosY($id)
    {
        for ($i=0; $i<7; $i++)//parcours de X
        {
            for ($j=0; $j<7; $j++) //parcours de Y
            {
                if(isset($this->villes[$i][$j])&&($this->villes[$i][$j]->getId() == $id)) //si la case n'est pas vide
                {  // et que  l'ID de la ville recherchée est le même que la ville pointée
                    return $j;  //renvoie la valeur j actuelle.
                }
                }
            }//on continue jusqu'à la fin des coordonnées.
        return -1; //s'il n'a pas de position Y alors on retourne -1.
        }


    /**
     * Compare les coordonnées X de de villes en paramètres
     * Entrées par leurs ID !
     *
     *
     * @param $id1
     * @param $id2
     * @return bool retourne vrai si egaux ou faux sinon
     */

        function comparer_X($id1,$id2){
            if($this->getVillePosX($id1)== $this->getVillePosX($id2)){
                return true;
            }
            return false;
        }

    /**
     * Compare les coordonnées Y de de villes en paramètres
     * Entrées par leurs ID !
     *
     * @param $id1
     * @param $id2
     * @return bool retourn vrai si egaux ou faux sinon
     */

    function comparer_Y($id1,$id2){
        if($this->getVillePosY($id1)== $this->getVillePosY($id2)){
            return true;
        }
        return false;
    }


    /**
     * Permet de mettre la valeur $nombreponts sur la Ville i,j
     *
     * @param $i position x de la ville
     * @param $j position y de la ville
     * @param $nombrePonts à mettre sur cette ville
     */

function setVille($i,$j,$nombrePonts){
$this->villes[$i][$j]->setNombrePonts($nombrePonts);
}


    /**
     * Permet de Savoir si une Ville existe ou non
     *
     * @param $i
     * @param $j
     * @return bool Existe ou Non
     */

function existe($i,$j){
return isset($this->villes[$i][$j]);
}


    /** Méthode qui va permettre de déterminer si deux villes sont liables.
     * @param ville1 est l'ID de la première ville
     * @param ville2 est l'ID de la deuxième ville
     * @return bool si oui ou non les deux villes sont liables.
     */
    function liaisonPossible($ville1, $ville2)
{

    //On récupère toutes les coordonnées X,Y des deux villes.
    $vPosition_x1= $this->getVillePosX($ville1);
    $vPosition_x2= $this->getVillePosX($ville2);
    $vPosition_y1= $this->getVillePosY($ville1);
    $vPosition_y2= $this->getVillePosY($ville2);

    //Cas erreur qui renvois FAUX si les deux villes ont des coordonnées totalement différentes ou totalement égale.
    if($vPosition_x1!=$vPosition_x2 && $vPosition_y1!=$vPosition_y2 || $vPosition_x1==$vPosition_x2 && $vPosition_y1==$vPosition_y2 || $this->getVilleID($ville2)->getNombrePontsMax()<= $this->getVilleID($ville2)->getNombrePonts() || $this->getVilleID($ville1)->getNombrePontsMax()<= $this->getVilleID($ville1)->getNombrePonts() )
        return false;
    else //Cas d'alignement entre deux villes
    {

        if($vPosition_x1==$vPosition_x2) //soi elle sont liées sur X
        {
            if($vPosition_y1<$vPosition_y2) //Si Y de la ville 2 est supérieur à Y de la ville 1
            {
                $tmp = $vPosition_y1;
                $vPosition_y1=$vPosition_y2;
                $vPosition_y2=$tmp; //on inverse le tout (on pourrait aussi utiliser max()) #TODO corriger ce détail#
            }

            for ($i=$vPosition_y2+1; $i<$vPosition_y1; $i++) //pour i allant de la coordonnée du plus petit Y jusqu'à l'autre
            {
                    if($this->existe($vPosition_x2,$i)) // si i est une ville, alors il existe une ville entre ville 1 et ville 2
                        return false; //alors on retourne faux.
            }//on continue de parcourir jusqu'à la fin
            return true; //sinon VRAI.
        }

        if ($vPosition_y1==$vPosition_y2) //soi elle sont liées sur Y
            {

                if($vPosition_x1<$vPosition_x2) //Si X de la ville 2 est supérieur à X de la ville 1
                {
                    $tmp = $vPosition_x1;
                    $vPosition_x1=$vPosition_x2;
                    $vPosition_x2=$tmp; //on inverse le tout (on pourrait aussi utiliser max())
                }

                for ($i=$vPosition_x2+1; $i<$vPosition_x1; $i++) //pour i allant de la coordonnée du plus petit X jusqu'à l'autre
                {

                    if($this->existe($i, $vPosition_y2)) // si i est une ville, alors il existe une ville entre ville 1 et ville 2
                        return false; //alors on retourne faux.
                    }//on continue de parcourir jusqu'à la fin
                return true; //Sinon on retourne VRAI
                }
            }


    }


    /**  Renvoie le nombre de ponts total à construire pour terminener la partie.
     * @return $total qui représente la somme des nombre de ponts maximum de toutes les villes.
     */
    public function total_Ponts(){

        $total = 0;

        for ($i=0; $i<7; $i++)//parcours de X
        {
            for ($j=0; $j<7; $j++) //parcours de Y
            {
                if($this->existe($i,$j)){

                    $total = $total + $this->getVille($i,$j)->getNombrePontsMax();
                }
            }
        }
        return $total;

    }



//rajout d'éventuelles méthodes



}
