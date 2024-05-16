<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");
    $grille=QuoteStr($_GET["nom"]);
    $pseudo=$_GET["param"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $grille?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $requete = "SELECT `taille` FROM `grille` WHERE `nom`=".$grille;
        $taille = GetSQLValue($requete);
        echo'<table>';
        for ($i=0;$i<$taille;$i++){

            //affichage des grilles créees + liens vers ces dernières.
            echo '<tr>';
            for($n=0;$n<$taille;$n++){
                echo '<td>'."  ".'</td>';
            }
            echo '</tr>';
        }

        echo'</table>';
    ?>

   <?php echo'<a href="./../Projet_Pixel_War_Helle_Evan/selection_grille.php?param='.$pseudo.'">Retour à la selection</a>'?>
</body>
</html>