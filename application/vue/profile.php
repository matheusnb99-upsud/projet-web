<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once('../controler/getMyPropositions.php');
        require_once('../controler/getMyGroupes.php');
        session_start();
        
        if(isset($_SESSION['email']) && ($_SESSION['email'] == null))
            header('Location:../vue/connexion.php');
        
        include './header/headertest.php';
        $jsonPropositions = getProp();
        $listeGroupes = getMyGroupes();
    ?>
    <section id='mesPropositions'>

    <h2>Mes Propositions</h2>
    <?php 
    foreach( $jsonPropositions as $p) {
        $arr    =  json_decode($p->toJson(), true);
        $auteur = $_SESSION['email'];
        $date   = ($arr["date"]);
        $boolDate = (strtotime($arr["datej"]) > new DateTime());
        $titre  = $arr["titre"];
        $tags   = null;
        $description= $arr["desc"];
        $voteN   = $arr["votN"];
        $voteP   = $arr["votP"];
        $id     = $arr['id'];
        $voteT= $arr['total'];
        
        include './propositionMod.php';
    }
?>
    </section>

    <section id='mesGroupes'>
    <h2>Mes Groupes</h2>


<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">.</th>
      <th scope="col">ID</th>
      <th scope="col">NOM</th>
    </tr>    
  </thead>  
  <tbody>
  <?php 
        foreach( $listeGroupes as $g) {
            echo "
          <tr>
          <th scope='row'>1</th>
          <td><a href='./groupe.php?idGroupe=".$g->getId()."'>".$g->getId()."</a></td>
          <td><a href='./groupe.php?idGroupe=".$g->getId()."'>".$g->getTitre()."</a></td>
        </tr>
              ";
        }
    ?>
</tbody>
</table>
      
    </section>
</body>
</html>