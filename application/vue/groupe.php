<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="../../style/header.css" type="text/css"/>
	<title>TD2-PROG WEB</title>

</head>
<body>	

<?php 
    require_once('../controler/getGroupe.php');
    require_once('../controler/getPropositions.php');
    require_once('../controler/getMyGroupes.php');
    session_start();
    if(!isset($_SESSION['email'])) // && ($_SESSION['email']) == null
        header('Location:accueil.php');
    

    $listeGroupes = getMyGroupes();

    include './header/headertest.php';
    
    $idGroupe = $_GET['idGroupe'];
    $groupe = json_decode(getGroupe($idGroupe));
    
?>
    <header>
        <h2><?php echo $groupe->nom; ?></h2>
	</header>


	<h2>Invitez du monde</h2> 
	<form action="../controler/invitation_groupe.php" method="post">
	    <p>Email  <input type='text' name='email' size='30' maxlength='50' placeholder='email'></p>
	    <input type='hidden' name='idGroupe' value='<?php echo $groupe->id;?>'>
		<button type="submit">Inviter</button> 
	</form>	


    

    <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>    
  </thead>  
  <tbody>
    <?php 
    $grpMme = getGroupeMembres($idGroupe);
    v//ar_dump($grpMme);
        foreach($grpMme as $g) {
            echo "<br><br>Test".$g->getMail();
            $arr    =  json_decode($g, true);

            $id  = $arr["id"];
            $nom  = $arr["nom"];
            $dateC  = $arr["dateC"];
            $dateD   = $arr["dateD"];
            $idCreateur= $arr["idCreateur"];

            echo "
            

          <tr>
            <th scope='row'>1</th>
            <td>".$nom."</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
                ";
    }
?>
</tbody>
</table>
      
      
      
      
      
      
      
      </body>
</html>

