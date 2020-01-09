<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 0);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    require_once('../model/Proposition.php');


    function getGroupe($idGroupe){
        $co = (new Bd('databasProjetTutore'))->connection();
        $gp = (new Groupe($co, $idGroupe));
        return  $gp->toJson();
    }

?>



