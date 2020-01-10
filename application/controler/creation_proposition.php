<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    require_once('../model/Proposition.php');


    session_start();
    if(!isset($_SESSION['id'])){
        header('location:../vue/formulaire_connexion.php');
    }
    // echo $_SESSION['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    if (empty($_POST['cats']))
        $categories= null;
    else
        $categories = json_encode($_POST['cats']);
    

    $co = (new Bd('databasProjetTutore'))->connection();
    $propsition = null;
    try{
        if($categories!=null)
        $propsition = new Proposition($co, $titre,$description, $_SESSION['id']);
        else
        $propsition = new Proposition($co, $titre,$description, $_SESSION['id'], $categories);
        header('location:../vue/accueil.php');
    }
    finally{
        echo "test";
        
    }
    
?>



