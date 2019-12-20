<?php
session_start();

//initialisation 
$memo=0; 

//si je reçois les données du formulaire
if (isset($_POST["btsubmit"])) {
    extract($_POST);
    $mp = md5($mp);



    // ecriture dans le fichier annuaire des identifiants 
    if ($ressource = fopen("annuaire.txt", "a+")) {
        fwrite($ressource, $id . ";");
        fwrite($ressource, $mp  . "\n");
        fwrite($ressource, "\n");
        fclose($ressource);
        header("location:authentification.php");
    } else {
        echo "ERREUR";
    }
    
    
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Inscription </title>
</head>

<body>
    <?php if (!isset($_p["btsubmit"])) { ?>
        <h1>Veuillez créer un compte</h1>
        <form method="post" action="inscription.php">
            <p>
                <label for="id">Identifiant</label>
                <input type="text" name="id" id="id" value="" />
            </p>
            <p>
                <label for="mp">Mot de Passe</label>
                <input type="password" name="mp" id="mp" value="" />
            </p>

            <input type="submit" name="btsubmit" value="Ok" />
        </form>
    <?php } ?>

</body>

</html>