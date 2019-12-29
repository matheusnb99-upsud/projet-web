<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
	<title>TD2-PROG WEB</title>
	<script>
		class Validator{
			constructor(champ){
				this.val1 = null;
				this.val2 = null;
				this.err = champ;
			}
			setVal1(sender){
				this.val1 = sender.value;
				
				if(this.val2!= "" && this.val2 != null){
					this.core();
				}
			}
			setVal2(sender){
				this.val2 = sender.value;

				if(this.val1!= "" && this.val1 != null){
					this.core();
				}
			}
			core(){
				if(!this.areEqual(this.val1,this.val2)){
						document.getElementById("ErreurVerification"+this.err.replace(/\s/g, '')).innerHTML = "aint no good, the "+ this.err + "s aint the same";
				}else{
					document.getElementById("ErreurVerification"+this.err.replace(/\s/g, '')).innerHTML = "";
					// ErreurVerification + (Email ou Mot de passe) sans espaces
				}
			}
			
			areEqual(){
				return this.val1 == this.val2;
			}
		}
		var validatorEmail = new Validator("Email");
		var validatorPwd = new Validator("Mot de passe");
		
	</script>


</head>
<body ng-app="">	
	<header>
		<h1>Inscription étudiants</h1> 
	</header>
	
	<h2>Nouveau étudiant</h2> 
	<form action="../controler/inscription.php" method="post" >
	    <p>Nom <input type="text" name="last-name" size='15' maxlength='40'  placeholder="Nom"></p>
		<p>Prenom <input type="text" name="first-name" size='15' maxlength='40'  placeholder="Prenom"></p>
		
	    <p>Adresse mail<input type="text" name="mail" size='15' maxlength='40' placeholder="email" onblur='validatorEmail.setVal1(this)'></p>
	    <p>Confirmation d'adresse mail<input type="text" name="mail" size='15' maxlength='40' placeholder="Confirmation d'email" onblur='validatorEmail.setVal2(this)'></p>
		<p id='ErreurVerificationEmail'> <p>

	    <p>Mot de passe <input type="password" name="pswd" size='15' maxlength='40' placeholder="Mot de passe" onblur='validatorPwd.setVal1(this)'></p>
		<p>Confirmation mot de passe <input type="password" name="pswd" size='15' maxlength='40' placeholder="Confirmation de mot de passe" onblur='validatorPwd.setVal2(this)'></p>
		<p id='ErreurVerificationMotdepasse'> <p>

		<p>Date de naissance<input type="text"	onfocus="(this.type='date');
														(this.min='1900-01-01');
														(this.max='<?php echo '20'.date('y-m-d', strtotime('-16 year'))?>')"
												onblur="(this.type='text')" id="date" name="dateNaissance" placeholder="Date de Naissance"></p>
		<button type="submit" value="">Creer un compte</button> 
	</form>	
	<a href="formulaire_connexion.php">Vous avez deja un compte?</a>
</body>
</html>

