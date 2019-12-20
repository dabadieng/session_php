<?php
session_start();
require "inc_function.php";

function traitementGrille3x3(int $a,int $b,array $liste) {
    global $grille;
    for($k=0; $k<=2; $k++) {
        for($l=0; $l<=2; $l++) {
            if (in_array($grille[$a+$k][$b+$l],$liste)) {
                $index = array_search($grille[$a+$k][$b+$l], $liste);
                unset($liste[$index]);
            }            
        }    
    }
    return $liste;
}


/**
 * Affiche le select dans la case ligne $i, colonne $j
 */
function afficheSelect($i, $j)
{
    global $grille;

    //liste des chiffres à afficher dans le select
    $liste = [];

    /* traitement de la ligne $i : $tab[$i] */
    for ($k = 1; $k <= 9; $k++) {
        if (!in_array($k, $grille[$i])) {
            $liste[] = $k;
        }
    }

    /* traitement de la colonne $j : $tab[$k][$j] */
    for ($k = 0; $k <= 8; $k++) {
        if (in_array($grille[$k][$j], $liste)) {
            $index = array_search($grille[$k][$j], $liste);
            unset($liste[$index]);
        }
    }

    //Recherche de $a et $b
    $a = 3*floor($i/3);
    $b = 3*floor($j/3);
    $liste=traitementGrille3x3($a,$b,$liste);

    //Affiche le select   
    if (count($liste)==1) {
        $x=array_pop($liste);
        echo "<td>$x</td>";
        $grille[$i][$j]=$x;
        $_SESSION["tab"]=$grille;
    } else {
        echo "<td>";
        echo "<select>";
        foreach ($liste as $valeur)
            echo "<option>$valeur</option>";
        echo "</select>";
        echo "</td>";
    }

    
}

if (isset($_SESSION["tab"]))
    $grille = $_SESSION["tab"];
else {
    $grille = [];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Sudoku</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <p><a href="initjeu.php">Initialiser le jeu</a></p>
    <form method="post">
        <?php
        echo "<table>";
        foreach ($grille as $i => $ligne) {
            echo "<tr>";
            foreach ($ligne as $j => $valeur) {
                if ($valeur == 0) {
                    afficheSelect($i, $j);
                } else
                    echo "<td>$valeur</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <p><input type="submit" value="ok" name="submit"></p>
    </form>
</body>

</html>