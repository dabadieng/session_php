<?php

/**
 * fonction qui génére un tableau 2D avec $nbl lignes et $nbc colonnes
 * et rempli avec des valeurs aléatoire entre 1 et 9 
 */
function initTableau(int $nbl, int $nbc): array
{
    $tab = [];
    for ($i = 0; $i < $nbl; $i++) {
        $tab[$i] = [];
        for ($j = 0; $j < $nbc; $j++) {
            $tab[$i][$j] = rand(1, 9);
        }
    }
    return $tab;
}

/**
 * Fonction qui affiche un tableau PHP 2D en HTML
 */
function tableauToHTML(array $tab)
{
    echo "<table>";
    foreach ($tab as $i => $ligne) {
        echo "<tr>";
        foreach ($ligne as $j => $valeur) {
            echo "<td>$valeur</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

/**
 * Fonction qui prend en parametre un tableau 2D, un numéro de ligne, et une valeur,
 * et qui remplit la ligne avec cette valeur
 */

function remplirLigne(array $tab, int $numligne, $chaine): array
{
    foreach ($tab[$numligne] as $cle => $valeur) {
        $tab[$numligne][$cle] = $chaine;
    }
    return $tab;
}

function remplirColonne(array $tab, int $numcolonne, $chaine): array
{
    foreach ($tab as $cle => $ligne) {
        $tab[$cle][$numcolonne] = $chaine;
    }
    return $tab;
}
