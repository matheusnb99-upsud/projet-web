<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 0);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');

    function getMyGroupes(){
        session_start();
        $co = (new Bd('databasProjetTutore'))->connection();
        $gp = (new Membre($co, $_SESSION['email'],$_SESSION['password']))->getGroupes();
        return $gp;
    }
?>
