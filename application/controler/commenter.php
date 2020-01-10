<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    require_once('../model/Proposition.php');
    require_once('../model/Commentaire.php');
    session_start();
    
    $idProposition = $_POST['idProp'];
    $commentaireBrut = $_POST['commentaire'];

    $co = (new Bd('databasProjetTutore'))->connection();
    $comm = new Commentaire($co, $_SESSION['id'], $idProposition, $commentaireBrut);
    (new Membre($co, $_SESSION['email'],$_SESSION['password']))->ajouterCommentaire($comm);
    (new Proposition($co, $idProposition))->addCommentaire($comm);

    //header('Location:../vue/proposition.php?id='.$idProposition);

?>

