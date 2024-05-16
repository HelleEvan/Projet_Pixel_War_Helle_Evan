<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");
    $pseudo=$_GET["param"];
    if($_SESSION['isConnected']==false){
        header("location: connexion.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection_grille</title>
</head>
<body>
    <h1>Bienvenue <?php echo $pseudo ?> sur la PixelWar!</h1>
    <br>
    <h1>Selection de grille</h1>

    <?php 
    $requete = "SELECT * FROM `grille`";
    $sql = GetSQL($requete,$tab);
    ?>
    <br>

    <table>
        <tr>
            <th>Nom</th>
        </tr>
        <tr>
        <?php
        for ($i=0;$i<$sql;$i++)
            {
                $nom=$tab[$i][1];

                echo '<TR>';
                //affichage des grilles créees + liens vers ces dernières.
                    echo '<td><a href="grille.php?nom='.$nom.'&param='.$pseudo.'">'.$nom.'</a></td>';
                echo '</TR>';
            }
        ?>
        </tr>

    </table>
    <br>

    <a href="./../Projet_Pixel_War_Helle_Evan/connexion.php?isDeconected=1">Deconnexion</a>
</body>
</html>