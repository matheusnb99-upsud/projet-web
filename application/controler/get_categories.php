<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 0);

    require_once('../model/Bd.php');
    require_once('../model/Categorie.php');
    $a = getCategories();

    function getCategories(){
        session_start();
        $co = (new Bd('databasProjetTutore'))->connection();
        $gp = Categorie::getCategories($co);
        return $gp;
    }
?>