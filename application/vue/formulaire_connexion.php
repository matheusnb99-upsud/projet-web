<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="../../style/style.css" type="text/css"/>
	<title>TD2-PROG WEB</title>

</head>
<body>	
	<header>
		<h1>Authentification</h1> 
	</header>
	<?php
		session_start();
	?>
	
	<h2>Entrez votre identifiant et votre mot de passe.</h2> 
	<form action="../controler/connexion.php" method="post">
	    <p>Identifiant  <input type="text" name="email" size='15' maxlength='22' placeholder="email"></p>
	    <p>Mot de passe <input type="password" name="pwd" size='15' maxlength='22' placeholder="mot de passe"></p>
	    
		<button type="submit">Se connecter</button> 
	</form>	
	<a href="formulaire_inscription.php">Vous n'avez pas encore une compte?</a>
	<?php
		require_once('verification_loggout.php');
	?>

</body>
</html>

