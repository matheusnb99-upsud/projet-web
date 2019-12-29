<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    
    $email = $_POST["mail"];
    $password = $_POST["pswd"];
    $nom = $_POST["last-name"];
    $prenom = $_POST["first-name"];
    $dateN = $_POST["dateNaissance"];
    
    $co = (new Bd('databasProjetTutore'))->connection();
    $membre = new Membre($co, $email,$password, $nom, $prenom, $dateN);
    $membre->startConnection();
    header('location:../vue/accueil.php');
    
    //mysqli_close($co);
    
?>



