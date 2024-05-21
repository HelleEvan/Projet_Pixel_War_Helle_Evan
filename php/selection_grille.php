<?php 
    include("../include/config.inc.php");
    $id=$_GET["param"];
    $grille_already_exists =false;
    $grille_created = false;
    //test de connexion
    if($_SESSION['isConnected']==false){
        header("location: ../php/connexion.php");
    }
    $pseudo_requete = "SELECT `pseudo` FROM `user` WHERE id=".$id;
    $pseudo = GetSQLValue($pseudo_requete);

    if (isset($_POST["nom"]))
        {
            $taille=QuoteStr($_POST["taille"]);
            $nom=QuoteStr($_POST["nom"]);
            //gestion pseudo et email identique
            $existing_grille_requete = "SELECT `nom` FROM `grille` WHERE `nom`=".$nom;
            $existing_grille = GetSQLValue($existing_grille_requete);

            if(isset($existing_grille)){

                $grille_already_exists =true;
            }
            else{
                $grille_requete ="INSERT INTO `grille` (`nom`, `taille`, `id_createur`) VALUES ($nom, $taille,$id)";
                ExecuteSQL($grille_requete);
                $grille_created = true;
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection_grille</title>
    <link rel="stylesheet" href="../css/style.css">

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
                    echo '<td><a href="../php/grille.php?nom='.$nom.'&param='.$id.'">'.$nom.'</a></td>';
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
    <?php
        if($grille_already_exists){
            echo "<h3 class='warning'> /!\ le nom de grille a déjà été utilisé /!\ </h3>";
        }
        else if($grille_created){
            echo "<h3 class='well_created'> /!\ La grille a bien été crée /!\ </h3>";
        }
    ?>
    <a href="../php/connexion.php?isDeconected=1">Deconnexion</a>
</body>
</html>