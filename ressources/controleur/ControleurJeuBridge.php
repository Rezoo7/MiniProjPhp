<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 04/12/2018
 * Time: 19:47
 */

require_once PATH_VUE."/VueJeuBridge.php";


class ControleurJeuBridge
{

   private $vuejeu;



    public function __construct(){

        $this->vuejeu = new VueJeuBridge();

    }


    public function afficher_bridge(){

        $this->vuejeu->afficher_jeu();
    }



}