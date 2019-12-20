<?php
session_start();
//On fournit la liste des mots possibles
$liste=array("manteau","parapluie", "intersection", "retournement", "helicoptere", "montagne", "contravention", "fin");

if (isset($_POST["btSubmit"])) {
	extract($_POST);
	//trouver les positions de cette lettre dans $mot et remplacer les tirets correspondant dans $motcache
    for($i=0; $i<strlen($_SESSION["mot"]);$i++) {
        if ($_SESSION["mot"][$i]==$lettre)
			$_SESSION["motcache"][$i]=$lettre;		
	}
	$_SESSION["nbCoup"]++;
	//si il n'y a plus de tirets dans $motcache alors $partieGagnee = true
    if (stripos($_SESSION["motcache"],"-")===false)
		$_SESSION["partieGagnee"] = true;

	//retirer $lettre de l'alphabet
	$cle=array_search($lettre,$_SESSION["alphabet"]);
	unset($_SESSION["alphabet"][$cle]);

	//gérer la fin de partie
	if ($_SESSION["partieGagnee"])
		$message="Vous avez gagné";
	else if ( ($_SESSION["nbCoup"]>=$_SESSION["nbCoupMax"]) )
		$message="Vous avez perdu";
	else
		$message="";
} 
else
{	/** INITIALISATION DU JEU */
	$_SESSION["alphabet"]=range('a','z');
	//1. tirer un mot au hasard : $mot
	$_SESSION["mot"]=$liste[array_rand($liste)];
	//2. définir le nombre de tentatives max :	
	$_SESSION["nbCoupMax"] = 2*strlen($_SESSION["mot"]);
	//3. remplacer toutes les lettres par des tirets : $motcache et afficher $motcache
	$_SESSION["motcache"]=str_repeat("-",strlen($_SESSION["mot"]));
	//4. Initialiser le nombre de tentatives à 0
	$_SESSION["nbCoup"]=0;
	$_SESSION["partieGagnee"]=false;	

	$lettre="";
	$message="";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Pendu</title>
    </head>	
	<style>
		body {
			font-face:Arial;
			font-size:20px;
		}
		
		form {
			border: 2px solid #333;
			background-color:#ADE;
		}
	</style>	
    <body>
		<h3><?=$_SESSION["motcache"]?></h3>
		<?php if ($message != "") { ?>
			<h3><?=$message?></h3>
			<p><a href="pendu.php">Rejouer</a></p>
		<?php } else { ?>
			<form method="post"> 
				<p>
					<label for="lettre">Saisir une lettre : </label>
					<select name="lettre" id="lettre">
					<?php
					foreach($_SESSION["alphabet"] as $cle => $valeur)
						echo "<option>$valeur</option>";
					?>
					</select>
				</p>
				<p><input type="submit" value="Envoyer" name="btSubmit" /></p>
			</form>
		<?php } ?>			
    </body>
</html>