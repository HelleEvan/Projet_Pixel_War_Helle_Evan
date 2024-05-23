<?php 
    include("../include/config.inc.php");
    //test de connexion
    if($_SESSION['isConnected']==false){
        header("location: ../php/connexion.php");
    }
    $grille=QuoteStr($_GET["nom"]);
    //pour ne pas avoir les apostrophes dans le titre de la page
    $titre=$_GET["nom"];
    $id=$_GET["param"];
    
    $id_createur_requete ="SELECT `id_createur`FROM `grille` WHERE `nom`=".$grille;
    $id_createur = GetSQLValue($id_createur_requete);
    $createur_requete = "SELECT `pseudo` FROM `user` WHERE id=".$id_createur;
    $createur = GetSQLValue($createur_requete);

    //save de la grille:
    
        $data = json_decode(file_get_contents('php://input'),true);
        if(isset($data['position'])){
            $position =$data['position'];
            $couleur = $data['couleur'];

            echo ''.$position[1].''.$couleur[1].'';
                // $save_requete = $sql="INSERT INTO `pixel` (`couleur`, `positionX`) VALUES ($couleur, $position)";
                // ExecuteSQL($save_requete);
        }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $titre?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div>
        <colors>
            <color class="red" title="red"></color>
            <color class="green" title="green"></color>
            <color class="blue" title="blue"></color>
        </colors>
        <grille>
            <pixels></pixels>
        </grille>
    </div>


   <?php echo'<a class="button" href="../php/selection_grille.php?param='.$id.'">Retour à la selection</a>'?>
   <br>
    <?php 
    echo 'Cette grille a été créée par :'.$createur;
    ?>
</body>
</html>

<script src="../js/grille.js"></script>