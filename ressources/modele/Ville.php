<?php


class Ville{
    // permet d'identifier de manière unique la ville

    private $id;
    private $nombrePontsMax;
    private $nombrePonts;
    // un tableau associatif qui stocke les villes qui sont reliées à la ville cible et le nombre de ponts qui les relient (ce nombre de ponts doit être <=2)
    private $villesLiees;


    /**
     * Ville Constructeur
     * @param $id : ID de la Ville
     * @param $nombrePontsMax: Son nombre de ponts Maximal
     * @param $nombrePonts: Son nombre de Pons Actuel
     */
    function __construct($id,$nombrePontsMax,$nombrePonts){
    $this->id=$id;
    $this->nombrePontsMax=$nombrePontsMax;
    $this->nombrePonts=$nombrePonts;
    $this->villesLiees=array();

    }

    /**
     * @return ID de la Ville
     */
    function getId(){
    return $this->id;
    }


    /**
     * @return Nombre de Ponts Maximal de la Ville
     */
    function getNombrePontsMax(){
    return $this->nombrePontsMax;
    }

    /**
     * @return Nombre de Ponts de la Ville
     */
    function getNombrePonts(){
    return $this->nombrePonts;
    }


    /**
     * @return Les villes Liees à la Ville
     */
    function getLiaison(){
        return $this->villesLiees;
        }


    /**
     * Permet de Set le nmobre de ponts de la Ville
     * @param un Nombre de Ponts
     */
    function setNombrePonts($nb){
    $this->nombrePonts=$nb;
    }

    /**
     * Fonction qui Incrémenter le nombre de ponts
     */
    function addPont(){
        $this->nombrePonts++;
    }


    /**
     * Fonction qui lie cette ville à une autre
     *
     * @param $ville
     * @return bool
     */

    function lierVilles($ville){

        if($this->nombrePonts <= $this->getNombrePontsMax()){ //vérification de si le nombre de pont max n'est pas atteint

            $this->villesLiees[$this->nombrePonts] = $ville; //On associe le nombre de pont actuelle et la ville dans l'arrays de liaisons.
            //NombrePonts sert ici de clé pour atteindre la ville
            $this->addPont(); //On incrémente pont.

            #echo "Nombre de pont de " . $ville . " -> " . $this->nombrePonts;
            return true; //On retourne vrai si l'action à été faite.
        }
        else{

            return false; //sinon on retourne faux.
        }
    }


}
