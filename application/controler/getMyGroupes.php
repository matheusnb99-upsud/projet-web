<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');

    function getMyGroupes(){
        $co = (new Bd('databasProjetTutore'))->connection();
        echo '<br>berr';
        $yes = (new Membre($co, $_SESSION['email'],$_SESSION['password']))->getGroupes();
        
        echo '<br>berr';
        return $yes;
    }

?>