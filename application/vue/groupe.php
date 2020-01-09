<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="../../style/style.css" type="text/css"/>
	<title>TD2-PROG WEB</title>

</head>
<body>	

<?php 
    require_once('../controler/getGroupe.php');
    session_start();
    if(!isset($_SESSION['email'])) // && ($_SESSION['email']) == null
        header('Location:accueil.php');

    include './header/logged.php';

    
    $idGroupe = $_GET['idGroupe'];
    $groupe = json_decode(getGroupe($idGroupe));
    

?>
    <header>
        <h2><?php echo $groupe->nom; ?></h2>
	</header>


	<h2>Invitez du monde</h2> 
	<form action="../controler/invitation_groupe.php" method="post">
	    <p>Identifiant  <input type='text' name='email' size='30' maxlength='50' placeholder='email'></p>
	    <input type='hidden' name='idGroupe' value='<?php echo $groupe->id;?>'>
		<button type="submit">Inviter</button> 
	</form>	
</body>
</html>

