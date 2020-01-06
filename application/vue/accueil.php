<?php 

    require_once('../controler/getPropositions.php');
    session_start();
    if(isset($_SESSION['email'])){ // && ($_SESSION['email']) == null
        include './header/loggued.php';
    }
    else{
        include './header/unloggued.php';
    }
    $json = getProp(2);
?>

<h2>

<?php 
    echo "hi ".$_SESSION['email'];
?>
</h2>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed inventore laboriosam nulla necessitatibus et corrupti eum sapiente dolorem omnis assumenda, laborum doloremque quisquam nostrum blanditiis earum totam suscipit quasi aut.</p>

<?php 
    foreach( $json as $p) {
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