<?php
session_start();

$tab = [];
$verification = "false";
$pseudo = "";
if (!(isset($_SESSION["id"]) || isset($_COOKIE["id"]))) {
    header("location:authentification.php");
}

$monFichier = fopen("annuaire.txt", "r");
while ($ressource = fgets($monFichier)) {
    if ($ressource != "\n")
        $tab[] = explode(";", $ressource);
}
foreach ($tab as $cle => $valeur) {
    foreach ($valeur as $i => $v) {
        if ($i == $_COOKIE["id"] || $v == $_SESSION["id"]) {
            $verification = "true";
        }
    }
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>private </title>
</head>

<body>
    <?php
    if ($verification == "true") { ?>
        <p>Bienvenue dans la page private</p>
    <?php } else {
        header("location:authentification.php");
    } ?>

</body>

</html>