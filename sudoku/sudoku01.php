<?php
session_start();
require "inc_function.php";

$tab= initTableau(9,9);
$_SESSION["tab"]=$tab;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>Sudoku</title>
		<link href="style.css" rel="stylesheet" >
    </head>	
	
    <body>
		<h1>Initialisation d'un tableau</h1>
		<?php tableauToHTML($tab); ?>
		<a href="sudoku02.php">Goto Next</a>
    </body>
</html>