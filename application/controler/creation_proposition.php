<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');


    session_start();
    if(!isset($_SESSION['id'])){
        header('location:../vue/formulaire_connexion.php');
    }
    echo $_SESSION['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    
    $co = (new Bd('databasProjetTutore'))->connection();
    $propsition = null;
    try{
        $propsition = new Proposition($co, $titre,$description, $_SESSION['id']);
        header('location:../vue/accueil.php');
    }
    finally{
        if(!is_object($membre)) echo "S'il vous plait, veuilliez logguer";
        
    }
    
?>



