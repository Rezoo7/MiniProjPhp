<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 04/12/2018
 * Time: 19:31
 */

require_once PATH_VUE."VueErreur.php";


class ControleurErreur
{

    private $vue_erreur;

    public function __construct()
    {

        $this->vue_erreur = new VueErreur();

    }


    public function Erreur($message){

        $this->vue_erreur->afficher_erreur($message);
    }


}