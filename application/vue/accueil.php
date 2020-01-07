<?php 
    require_once('../controler/getPropositions.php');
    require_once('../controler/getMyGroupes.php');
    session_start();
    if(isset($_SESSION['email'])){ // && ($_SESSION['email']) == null
        $connected = true;
    }else{        
        $connected = false;
    }

    if($connected){
    /*
        $listeGroupes = getMyGroupes();
        foreach( $listeGroupes as $p) {
            $arr    =  json_decode($p, true);
            foreach( $arr as $el) {
                $echo $el;
            }
        }
    */


        include './header/logged.php';
    }
    else{
        include './header/unlogged.php';
    }

    $jsonPropositions = getProp(2);
?>

<h2>
<?php 
    if($connected)
        echo "hi ".$_SESSION['email'];
    else
        echo "Hi stranger";
?>
</h2>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed inventore laboriosam nulla necessitatibus et corrupti eum sapiente dolorem omnis assumenda, laborum doloremque quisquam nostrum blanditiis earum totam suscipit quasi aut.</p>

<?php 
    foreach( $jsonPropositions as $p) {
        $arr    =  json_decode($p, true);
        $auteur = $arr["auteur"];
        $date   = $arr["date"];
        $titre  = $arr["titre"];
        $tags   = $arr["tag"];
        $description= $arr["desc"];
        $ncom   = null;
        $id     = $arr['id'];
        include './propositionMod.php';
    }

?>