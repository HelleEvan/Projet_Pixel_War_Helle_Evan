<?php 
    include("../include/config.inc.php");
    $grille=QuoteStr($_GET["nom"]);
    //pour ne pas avoir les apostrophes dans le titre de la page
    $titre=$_GET["nom"];
    $id=$_GET["param"];
    //test de connexion
    if($_SESSION['isConnected']==false){
        header("location: ../php/connexion.php");
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


   <?php echo'<a href="../php/selection_grille.php?param='.$id.'">Retour à la selection</a>'?>
</body>
</html>

<script src="../js/grille.js"></script>