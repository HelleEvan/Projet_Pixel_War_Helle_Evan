<?php 
    include("../include/config.inc.php");
    $id=$_GET["param"];
    $grille_already_exists =false;
    $grille_created = false;
    //test de connexion
    if($_SESSION['isConnected']==false){
        header("location: ../php/connexion.php");
    }
    $pseudo_requete =$link->prepare("SELECT `pseudo` FROM `user` WHERE id=?");
    $pseudo_requete->bind_param("i",$id);
    $pseudo_requete->execute();
    $pseudo_result=$pseudo_requete->get_result();
    $pseudo_row=$pseudo_result->fetch_assoc();
    $pseudo=$pseudo_row ? $pseudo_row["pseudo"]:null;

    if (isset($_POST["nom"]))
        {
            $taille=$_POST["taille"];
            $nom=$_POST["nom"];
            //gestion nom identique
            $existing_grille_requete =$link->prepare("SELECT `nom` FROM `grille` WHERE `nom`=?");
            $existing_grille_requete->bind_param("s",$nom);
            $existing_grille_requete->execute();
            $grille_result= $existing_grille_requete->get_result();
            $grille_row = $grille_result->fetch_assoc();
            $existing_grille = $grille_row ? $grille_row["nom"]:null;

            if(isset($existing_grille)){

                $grille_already_exists =true;
            }
            else{
                $grille_requete =$link->prepare("INSERT INTO `grille` (`nom`, `taille`, `id_createur`) VALUES (?,?,?)");
                $grille_requete->bind_param("ssi",$nom,$taille,$id);
                $grille_requete->execute();

                $grille_created = true;
                $grille_requete->close();
            }
            $existing_grille_requete->close();
        }
        $pseudo_requete->close();
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
    <div class="header">
        <img src="../image/Polytech_dijon.png">
    </div>
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
                    echo '<td><a class="button" href="../php/grille.php?nom='.$nom.'&param='.$id.'">'.$nom.'</a></td>';
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
        <br><br>
        <input class="button" type="submit" value="Creer une grille">
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
    <a class="button" href="../php/connexion.php?isDeconected=1">Deconnexion</a>
</body>
</html>