<?php 

    error_reporting(E_ALL);
    
 ini_set('display_errors', 0);
    require_once('../model/Bd.php');
    require_once('../model/Groupe.php');
    
    $idGroupe = $_POST['idGroupe'];
    $dest = $_POST['email'];
 

    $co = (new Bd('databasProjetTutore'))->connection();
    (new Groupe($co, $idGroupe))->inviter($dest);
    header('Location:../vue/accueil.php');

?>
