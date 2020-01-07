<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    //require_once('../model/Proposition.php');

    function getProp(){
        $co = (new Bd('databasProjetTutore'))->connection();
        return (new Membre($co, $_SESSION['email'],$_SESSION['password']))->getPropositions();
    }

?>



