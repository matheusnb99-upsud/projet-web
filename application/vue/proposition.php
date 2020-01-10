<?php 
    require_once('../controler/getPropositions.php');
    require_once('../controler/getMyGroupes.php');
    session_start();

    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
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
    $jsonProposition = getPropId($_GET['id']);
    //echo $jsonProposition->gettitre();
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
    $arr    =  json_decode($jsonProposition, true);
    $auteur = $arr["auteur"];
    $date   = ($arr["date"]);
    $boolDate = (strtotime($arr["datej"]) > new DateTime());
    $titre  = $arr["titre"];
    $tags   = $arr["tag"];
    $description= $arr["desc"];
    $voteN   = $arr["votN"];
    $voteP   = $arr["votP"];
    $id     = $arr['id'];
    $voteT= $arr['total'];
    include './propositionMod.php';
    
?>
<section class="content">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-16" style='padding-top: 50px;'>

                <!-- POST -->
                <div class="post">
                    <form action='../controler/commenter.php' class="form newtopic" method="post" id='form'>
                        <input type="hidden" name="idProp" value="<?php echo $_GET['id'];?>">
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                <div class="email" style="width: 1px;word-wrap: break-word;white-space: pre-wrap;">
                                    <div class="text-center">
                                        <p style='padding-left:25px;'><?php echo $_SESSION['nom']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <div>
                                    <textarea style='resize: vertical;' name='commentaire' id="desc" placeholder="Description (optionel)" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                        </div>                              
                        <div class="postinfobot">
                            <div class="pull-right postreply">
                                <div class="pull-left"><button type="submit" class="btn btn-primary">Post</button></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <!-- POST -->
            </div>
        </div>
    </div>
</section>