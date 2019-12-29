<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'/>
    <link rel='stylesheet' href='style.css' type='text/css'/>
    <title>TD2-PROG WEB</title>
</head>
<body>	
	<header>
		<h1>
        <?php 
            session_start();
            echo $_SESSION['id'];
        ?>
        
        </h1> 
	</header>
	
	<h2>Entrez votre identifiant et votre mot de passe.</h2> 
	<form action='../controler/creation_proposition.php' method='post'>
        <div id='titre'>
	        <input type='text' name='titre' maxlength='140' placeholder='Titre'></p>
        </div>
        <div id='fatty'>
	        <input type='text' name='description' maxlength='2147483647' placeholder='Text(optional)'></p>
	    </div>
		<button type='submit'>Post</button> 
	</form>	
	<a href='formulaire_inscription.php'>Vous n'avez pas encore une compte?</a>
    	
</body>
</html>

