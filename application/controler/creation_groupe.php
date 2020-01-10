<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Groupe.php');


    session_start();
    if(!isset($_SESSION['id'])){
        header('location:../vue/formulaire_connexion.php');
    }
    $id = $_SESSION['id'];
    $titre = $_POST['titre'];
    

    $co = (new Bd('databasProjetTutore'))->connection();
    $groupe = null;
    try{
        $groupe = new Groupe($co, $titre,$id);
        header('location:../vue/accueil.php');
    }
    finally{
        echo "test";
        
    }
    
?>



