<?php 
    require_once('../controler/getPropositions.php');
    require_once('../controler/getMyGroupes.php');
    session_start();

    
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    if(isset($_SESSION['email'])){ // && ($_SESSION['email']) == null
        $connected = true;
    }else{        
        $connected = false;
    }

    if($connected){
        $listeGroupes = getMyGroupes();
        include './header/headertest.php';
    }
    else{
        include './header/unlogged.php';
    }

    $jsonPropositions = getProp(10);
?>

<h2 style='margin: 50px;'>
<?php 
    if($connected)
        echo "hi ".$_SESSION['email'];
    else
        echo "Hi stranger";
?>

</h2>
<?php 
    foreach( $jsonPropositions as $p) {
        $arr    =  json_decode($p, true);
        $auteur = $arr["auteur"];
        $date   = ($arr["date"]);
        $boolDate = ((strtotime($arr["datej"])) > new DateTime());
        
        $titre  = $arr["titre"];
        $tags   = $arr["tag"];
        $description= $arr["desc"];
        $voteN   = $arr["votN"];
        $voteP   = $arr["votP"];
        $id     = $arr['id'];
        $voteT= $arr['total'];
        
        include './propositionMod.php';
    }

?>
