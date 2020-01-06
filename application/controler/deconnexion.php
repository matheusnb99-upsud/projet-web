<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');

    session_start();

    if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
        $co = (new Bd('databasProjetTutore'))->connection();
        (new Membre($co,$_SESSION['email'],$_SESSION['password']))->deconnection();
    }
    header('Location:../vue/formulaire_connexion.php');
    
?>