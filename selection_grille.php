<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");
    $id=$_GET["param"];
    //test de connexion
    if($_SESSION['isConnected']==false){
        header("location: connexion.php");
    }
    $pseudo_requete = "SELECT `pseudo` FROM `user` WHERE id=".$id;
    $pseudo = GetSQLValue($pseudo_requete);

    if (isset($_POST["nom"]))
        {
            $taille=QuoteStr($_POST["taille"]);
            $nom=QuoteStr($_POST["nom"]);

            $grille_requete ="INSERT INTO `grille` (`nom`, `taille`, `id_createur`) VALUES ($nom, $taille,$id)";
            ExecuteSQL($grille_requete);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection_grille</title>
    <link rel="stylesheet" href="style.css">

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
            <th>Nom :</th>
        </tr>
        <tr>
        <?php
        for ($i=0;$i<$sql;$i++)
            {
                $nom=$tab[$i][1];

                echo '<TR>';
                //affichage des grilles créees + liens vers ces dernières.
                    echo '<td><a href="grille.php?nom='.$nom.'&param='.$id.'">'.$nom.'</a></td>';
                echo '</TR>';
            }
        ?>
        </tr>

    </table>
    <br>
    <h1> Création de grille</h1>
    <form method="POST">
        <h3>entrez le nom de la grille</h3>
        <input type="text" name="nom" value="" required>
        <h3>entrez la taille de grille souhaité</h3>
        <input type="text" name="taille" value="" required>
        <br>
        <input type="submit" value="Creer une grille">
    </form>
    <br>
    <a href="./../Projet_Pixel_War_Helle_Evan/connexion.php?isDeconected=1">Deconnexion</a>
</body>
</html>