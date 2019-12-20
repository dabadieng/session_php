<?php
session_start();
require "inc_function.php";

if (isset($_SESSION["tab"]))
    $tab= $_SESSION["tab"];
else
    $tab=[];

if (isset($_POST["submit"])) {
    extract($_POST);
    $tab=remplirColonne($tab,$numc, $valeur);
    $_SESSION["tab"]=$tab;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>Sudoku</title>
		<link href="style.css" rel="stylesheet" >
    </head>	
	
    <body>
        <h1>Restauration d'un tableau depuis la session</h1>
        <h1>remplir une colonne par une valeur</h1>
        <form method="post">
            <p>
                <label for="numc">Numéro de colonne</label>
                <select name="numc" id="numc">
                    <?php
                    for($i=0; $i<=8;$i++)
                        echo "<option>$i</option>";
                    ?>
                </select>
            </p>
            <p>
                <label for="valeur">Nouvelle valeur</label>
                <input type="text" name="valeur" id="valeur">
            </p>
            <p><input type="submit" value="ok" name="submit" ></p>
        </form>
		<?php tableauToHTML($tab); ?>
    </body>
</html>