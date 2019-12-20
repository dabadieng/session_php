<?php
$message = ""; // si besoin d'un message d'erreur
//formulaire d'inscription
if (isset($_POST["btSubmit"])) {
	extract($_POST);
	$chaine=$login.";".md5($mdp);
	$tab=file("annuaire.txt");
	foreach($tab as $cle=>$ligne) {
		if (trim($ligne)==$chaine) {
			//authentification réussie
			$_SESSION["ok"]=true;
			$_SESSION["login"]=$login;
			header("location:private.php");
			exit();
		}
	}
	//échec de l'authentification
	$message="échec de l'authentification";
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Authentification</title>
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
		<legend>Authentification</legend>
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