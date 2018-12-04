<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 04/12/2018
 * Time: 14:18
 */

class MonException extends Exception
{
    private $chaine;

    public function __construct($chaine){
        $this->chaine=$chaine;
    }

    public function afficher($chaine){

        return $this->chaine;
    }
}

