<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');


    $email = $_POST["email"];
    $password = $_POST["pwd"];
    
    $co = (new Bd('databasProjetTutore'))->connection();
    $membre = null;
    try{
        $membre = new Membre($co, $email,$password);
        header('location:../vue/accueil.php');
    }
    finally{
        if(!is_object($membre)) echo 'Wrong credentials';
        
    }
    
?>



