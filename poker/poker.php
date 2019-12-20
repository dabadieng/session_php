<?php
session_start();
require "inc_carte.php";

//Grille des gains :
$grilledgains = array(1, 2, 3, 4, 6, 9, 25);

if (isset($_POST["btSubmit"])) {
    extract($_POST);
    /**
     * Mémorise les cartes que le joueur souhaite garder
     */

    if (isset($_POST["play"])) {
        $main = [];
        foreach ($play as $cle => $valeur)
            $main[] = $joueur[$valeur];
        /**
         * Complète les cartes manquantes en possession du joueur 
         */
        if (count($main) < 5) {
            for ($i = 5 - count($main); $i <= 5; $i++)
                array_push($main, array_pop($_SESSION["jeu52"]));
        }
        $_SESSION["tour"] = $main;    //rénitialise la session avec les nouvelles cartes
    }


    /**
     * Affiche les nouvelles cartes en possesion du joueur 
     */
} else if (isset($_POST["reJouer"])) {
    $_SESSION["credit"] = 1000;

    //récupérer les 5 cartes 
    $choix = jeu52();
    shuffle($choix);

    $joueur = [];
    for ($i = 1; $i <= 5; ++$i) {
        $joueur[] = array_pop($choix);
    }
    $_SESSION["jeu52"] = $choix;
    $_SESSION["tour"] = $joueur;
} else {
    
    $play = [];
    $credit = 1000;

    //récupérer les 5 cartes 
    $choix = jeu52();
    shuffle($choix);

    $joueur = [];
    for ($i = 1; $i <= 5; ++$i) {
        $joueur[] = array_pop($choix);
    }
    $_SESSION["jeu52"] = $choix;
    $_SESSION["tour"] = $joueur;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Formulaire2</title>
</head>

<body>

    <?php
    if (!isset($_POST["btSubmit"])) { ?>
        <h3>Votre crédit est de : <?= $credit ?></h3>
        <form method="POST">
            <fieldset>
                <legend>Statut</legend>
                <?php
                    foreach ($_SESSION["tour"] as $cle => $valeur) { ?>
                    <label for="carte" .<?= "$cle" ?>> <img src=<?= getSrc($valeur); ?> /> </label>
                    <input type="checkbox" id="carte" .<?= "$cle" ?> name="play[]" value="<?= $cle ?>" />
                <?php  } ?>

                <label for="mise">Votre mise</label>
                <input type="text" id="mise" name="mise" value="" />

            </fieldset>

            </p>
            <input type="submit" name="btSubmit" value="Envoyer" />
        </form>
    <?php   } else { ?>
        <?php
            foreach ($_SESSION["tour"] as $cle => $valeur) { ?>
            <label for="carte" .<?= "$cle" ?>> <img src=<?= getSrc($valeur); ?> /> </label>
        <?php  } ?>
        <input type="submit" name="reJouer" value="reJouer" ; <?php    }  ?> </body> </html>