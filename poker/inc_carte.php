<?php
session_abort();
$face = [2 => "Deux", 3 => "Trois", 4 => "Quatre", 5 => "Cinq", 6 => "Six", 7 => "Sept", 8 => "Huit", 9 => "Neuf", 10 => "Dix", 11 => "Valet", 12 => "Dame", 13 => "Roi", 14 => "As"];
$coul = ["Carreau", "Coeur", "Pique", "Trefle"];

/**
 * Crée un jeu de 52 cartes
 */
function jeu52(): array
{
    global $coul, $face;
    $jeu = [];
    foreach ($coul as $couleur) {
        foreach ($face as $cle => $v) {
            $jeu[] = creerCarte($couleur, $cle);
        }
    }
    return $jeu;
}

/**
 * Créer une carte de couleur $c et de valeur $v
 */
function creerCarte(string $c, int $v): array
{
    return ["couleur" => $c, "valeur" => $v];
}

/**
 * fontion qui retourne l'url de l'image d'une carte
 */
function getSrc(array $carte): string
{
    global $face;
    return  $carte["couleur"] . "/" . $face[$carte["valeur"]] . ".PNG";
}

/**
 * retourne le nom complet de la carte
 */
function getNom(array $carte): string
{
    global $face;
    return $face[$carte["valeur"]] . " de " . $carte["couleur"];
}


function afficheIMG($carte) : string { 
    return "<img src='" . getSrc($carte) . "' alt='" . getNom($carte) . "' title='" . getNom($carte) . "' >";
}
