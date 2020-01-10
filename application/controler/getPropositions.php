<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    require_once('../model/Proposition.php');


    function getProp($num){
        $co = (new Bd('databasProjetTutore'))->connection();
        return Proposition::getPropositions($co, $num);
    }
    function getPropId($id){
        $co = (new Bd('databasProjetTutore'))->connection();
        return (new Proposition($co, $id))->getProposition();
    }

?>



