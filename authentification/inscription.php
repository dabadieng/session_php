<?php
$message = ""; // si besoin d'un message d'erreur
//formulaire d'inscription
if (isset($_POST["btSubmit"])) {
	extract($_POST);
	//ouvrir l'annuaire en mode "ajout"
	if ($ressource = fopen("annuaire.txt", "a")) {
		//Ecrire la chaine "login;mdp" dans annuaire.txt
		fwrite($ressource, $login . ";" . md5($mdp) . "\n");
		fclose($ressource);
		//rediriger sur la page d'authentification
		header("location:authentification.php");
		exit();
	} else {
		$message = "<h1>Une erreur s'est produite, veuillez réessayer.</h1>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Inscription</title>
</head>
<style>
	body {
		font-family: Verdana, Geneva, Tahoma, sans-serif;
	}
	
	fieldset {
		background-color:#9DA;
		margin:auto 30%;			
	}
	
	legend {
		text-shadow:  5px 5px #558ABB;
	}
	
	label {
		display:inline-block;
		width:200px;
		text-align:right;
	}
	
	.textCenter {
		text-align:center;
	}
</style>
<body>
	<fieldset>
		<legend>Inscription</legend>
		<?= $message ?>
		<form method="post">
			<p>
				<label for="login">votre login : </label>
				<input type="text" name="login" id="login">
			</p>
			<p>
				<label for="mdp">votre mot de passe : </label>
				<input type="password" name="mdp" id="mdp">
			</p>
			<p class="textCenter"><input type="submit" value="Envoyer" name="btSubmit" /></p>
		</form>
	</fieldset>
</body>

</html>