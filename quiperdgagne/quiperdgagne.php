<?php
session_start();

//constante du jeu
const JOUEUR = 0;
const ORDI = 1;

//IA de l'ordinateur
function ordiIA()
{
    return rand(1, 9);
}

if (isset($_POST["btSubmit"])) {
    extract($_POST);
    $ordi=ordiIA();
    $_SESSION["score"][JOUEUR]+=$choix;
    $_SESSION["score"][ORDI]+=$ordi;
    //ajout à l'historique des coups
    $_SESSION["memo"][ORDI][]=$ordi;
    $_SESSION["memo"][JOUEUR][]=$choix;

    if ($choix>$ordi) {
        $_SESSION["score"][ORDI]+=$ordi;
    } else if ($choix<$ordi) {
        $_SESSION["score"][JOUEUR]+=$choix;
    }

    if ($_SESSION["score"][JOUEUR]>100 || $_SESSION["score"][ORDI]>100)
        $fin=true;
    else
        $fin=false;
    
} else {
    /** INITIALISATION DU JEU */
    $_SESSION["score"][JOUEUR]=0;
    $_SESSION["score"][ORDI]=0;
    $_SESSION["memo"][JOUEUR]=[];
    $_SESSION["memo"][ORDI]=[];
    $ordi="";
    $choix="";
    $fin=false;
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Qui Perd Gagne</title>
        <link href="style.css" rel="stylesheet">
    </head>			
    <body>
        <h1>Qui Perd Gagne</h1>
        <table>
            <caption>Affichage des coups</caption>
            <thead>
                <tr>
                    <th>Humain</th>
                    <th>Ordinateur</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nbcoup=count($_SESSION["memo"][JOUEUR]);
                for($i=0; $i<$nbcoup; $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION["memo"][JOUEUR][$i] . "</td>";
                    echo "<td>" . $_SESSION["memo"][ORDI][$i] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><?=$_SESSION["score"][JOUEUR]?></th>
                    <th><?=$_SESSION["score"][ORDI]?></th>
                </tr>
            </tfoot>
        </table>        

        <?php
        if ($fin) {
            if ($_SESSION["score"][JOUEUR]>$_SESSION["score"][ORDI])
                echo "L'humain a gagné";
            else if ($_SESSION["score"][JOUEUR]<$_SESSION["score"][ORDI])
                echo "L'ordinateur a gagné";
            else
                echo "égalité";
            echo "<p><a href='quiperdgagne.php'>Rejouer</a></p>";
        } else { ?>
		<form method="post">
            <label for="choix">Sélectionner un nombre</label>
            <select name="choix" id="choix" size="10" required>
                <?php for($i=1; $i<10; $i++)
                    echo "<option>$i</option>";
                ?>
            </select>
            
            <p><input type="submit" value="Envoyer" name="btSubmit" /></p>
        </form>	
        <?php } ?>
    </body>
</html>