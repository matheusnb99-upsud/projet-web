<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');
    require_once('../model/Proposition.php');

    
    $co = (new Bd('databasProjetTutore'))->connection();

    $propsitions = Proposition::getPropositions($co, 1);
    
    foreach( $propsitions as $p ) {
        $json = json_encode($p);
        echo "Value is $json <br />";
     }
       
?>



