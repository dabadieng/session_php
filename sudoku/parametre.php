<?php
$tab=[1,2,3];

function carre(&$tableau) {
    foreach($tableau as $cle=>$valeur) {
        $tableau[$cle]=$valeur*$valeur;
    }
    var_dump($tableau);
}

function cube(int $x) {
    $x=$x*$x*$x;
}

$a=2;
cube($a);
var_dump($a);

var_dump($tab);
carre($tab);
var_dump($tab);
