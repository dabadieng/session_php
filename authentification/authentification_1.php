<?php
session_start();

$tab = [];              //stockage des identifiants de connexion 
$verification = 0;


//si je reçois les données du formulaire
if (isset($_POST["btsubmit"])) {
    extract($_POST);


    // utilisation des données du fichier annuaire pour créer un tableau 
    $monFichier = fopen("annuaire.txt", "r");
    while ($ressource = fgets($monFichier)) {
        if ($ressource != "\n")
            $tab[] = explode(";", $ressource);
    }

    //  comparaison des 2 chaines pour authentification 
    foreach ($tab as $cle => $valeur) {
        foreach ($valeur as $i => $v) {
            echo "la cle $i la valeur $v";
            if (trim($v) == trim($id)) {
                $verification = 1;
            }
        }
    }
    var_dump($tab);

    // redirection vers la page selon la vérification  
    if ($verification == 1) {
        // si cocher enregistrement de cookiers sinon dans une session 
        if ($memo == "1") {
            setcookie("id", $id, time() + 365 * 24 * 3600);
        } else {
            $_SESSION["id"] = $id;
        }
        header("location:private.php");
    } else {
        header("location:inscription.php");
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
    <?php if (!isset($_POST["btsubmit"])) { ?>

        <h1>Veuillez vous autentifier</h1>
        <form method="post">
            <p>
                <label for="id">Identifiant</label>
                <input type="text" name="id" id="id" value="" />
            </p>
            <p>
                <label for="mp">Mot de Passe</label>
                <input type="passeword" name="mp" id="mp" value="" />
            </p>
            <p>
                <label for="memo">Se souvenir de moi </label>
                <input type="checkbox" name="memo" id="memo" value="1" />
            </p>
            <input type="submit" name="btsubmit" value="Ok" />
        </form>

        <a href="incription.php">Créer un compte</a>

    <?php } ?>
</body>

</html>