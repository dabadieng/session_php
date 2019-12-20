<?php
session_start();
$grille=[];
$grille[0]=array(3,0,0,7,0,2,4,8,1);
$grille[1]=array(0,6,0,3,0,0,0,0,9);
$grille[2]=array(0,2,0,0,4,0,5,0,6);
$grille[3]=array(7,4,0,0,0,0,0,0,0);
$grille[4]=array(0,0,0,9,0,8,0,0,0);
$grille[5]=array(0,0,0,0,0,0,0,1,2);
$grille[6]=array(6,0,3,0,2,0,0,9,0);
$grille[7]=array(5,0,0,0,0,3,0,2,0);
$grille[8]=array(2,7,8,5,0,6,0,0,3);

$_SESSION["tab"]=$grille;
header("location:sudoku.php");
exit();