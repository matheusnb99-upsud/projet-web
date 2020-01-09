<?php 

    error_reporting(E_ALL);
    
 ini_set('display_errors', 0);
    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    
    $idGroupe = $_GET['idGroupe'];
    $dest = $_GET['destinataire'];
 

    session_start();
    $co = (new Bd('databasProjetTutore'))->connection();
    $me = (new Membre($co, $_SESSION['email'],$_SESSION['password']));
    $gp = (new Groupe($co, $idGroupe));
    $gp->ajouterMembre($me);
    $me->ajouterGroupe($gp);
?>
