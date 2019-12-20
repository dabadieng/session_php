<?php
session_start();
$multiplicateur=[
		"valet"=>1,
		"double paire"=>2,
		"brelan"=>3,
		"quinte"=>4,
		"couleur"=>6,
		"full"=>9,
		"carré"=>25,
		"quinte flush"=>50,
		"quinte flush royale"=>250];

require "inc_carte.php";
$finDeTour = false;

//initialisation d'une nouvelle main
function initjeu()
{
	global $jeu, $main, $credit;

	//nouveau jeu mélangé
	$jeu = jeu52();
	shuffle($jeu);

	//nouvelle main
	$main = [];
	for ($i = 0; $i < 5; $i++)
		$main[] = array_pop($jeu);

	//mémorisation 
	$_SESSION["jeu"] = $jeu;
	$_SESSION["main"] = $main;

	//une nouvelle partie coute 1 crédit
	$credit--;
	$_SESSION["credit"] = $credit;
}


if (isset($_POST["btsubmit"])) {
	//récupération de la mise et des blocages
	$credit = $_SESSION["credit"];
	$main = $_SESSION["main"];
	$jeu = $_SESSION["jeu"];
	$finDeTour = true;

	extract($_POST);
	//$carte contient les indice des cartes bloquées dans $main
	//=> détermination des indices non bloqués
	$indice=[];
	for($i=0; $i<5; $i++) {
		if ( array_search($i,$carte)===false )
			$indice[]=$i;
	}

	//tirage des nouvelles cartes
	foreach($indice as $index) {
		$main[$index]=array_pop($jeu);
	}

	//TODO : calcul des gains, maj de $credits.
	$_SESSION["credit"] = $credit-$mise;	
	/** analyse de la main **/
	$valeur=[];
	foreach($main as $carte) {
		$valeur[]=$carte["valeur"];
	}
	//$stat : compte la fréquence des valeurs.
	$stat = array_count_values($valeur);
	var_dump($stat);


} else if (isset($_POST["newgame"])) {
	//récupération des crédits	
	$credit = $_SESSION["credit"];
	//tirage d'une nouvelle main
	initjeu();
} else {
	$jeu = [];
	$main = [];
	$credit = 1000;
	//tirage d'une nouvelle main
	initjeu();
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Poker</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<h2>Crédit : <?= $_SESSION["credit"] ?></h2>
	<form method="post">
		<?php if ($finDeTour) { ?>
			<div class="myflex">
				<?php
					foreach ($main as $cle => $carte)
						echo afficheIMG($carte);
					?>
			</div>
			<input type="submit" name="newgame" value="Nouvelle partie">
		<?php } else { ?>
			<div class="myflex">
				<?php
					foreach ($main as $cle => $carte) {
						echo "<div>";
						echo "<label for='carte$cle'>" . afficheIMG($carte) . "<br>";
						echo "<input type='checkbox' id='carte$cle' name='carte[]' value='$cle' onchange='change(this)' ></label>";
						echo "</div>";
					}
				?>
			</div>
			<p>
				<label for="mise">Mise</label><input type="text" name="mise" id="mise" value="10">
				<input type="submit" name="btsubmit" value="OK">
			</p>
		<?php } ?>
	</form>
	<h3>Tableau des gains</h3>
	<pre>
		<?php print_r($multiplicateur); ?>
	</pre>
</body>
<script>
	function change(obj) {
		let lab=obj.parentNode;
		if (obj.checked)			
			lab.style.border="4px solid #00F";
		else
			lab.style.border="4px solid #FFF";			
	}
</script>

</html>