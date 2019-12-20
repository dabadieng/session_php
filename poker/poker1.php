<?php
session_start();
require "inc_carte.php";


if (isset($_POST["btsubmit"])){
extract($_POST);
var_dump($carte);
$_SESSION["jeu"] = $jeu;
$_SESSION["select"] = $select;
}else{
    
$jeu = jeu52();
shuffle($jeu);

$select=[];
for ($i = 0; $i < 5; $i++) {
    $select[] = array_pop($jeu);
}

$_SESSION["jeu"] = $jeu;
$_SESSION["select"] = $select;
}


?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>jeu</title>
</head>


<body>

    <legend>jeu poker</legend>

    <form method="post">

        </p>
        <?php
        foreach ($select as $cle=> $carte) {
            ?>
            <label for="<?=$cle?>"> <?=afficheIMG($carte)?> </label>
            <input type="checkbox" name="carte[]" id="<?=$cle?>" value="<?=$cle?>"/>
            
            <?php } ?>
            
            <?php  ?>

        <input type="submit" value="Envoyer" name="btsubmit" />
    </form>

</body>

</html>