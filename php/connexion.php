<?php 
    include("../include/config.inc.php");
    $MauvaisMotDePasse=$MauvaisCompte=false;
    if(isset($_GET["isDeconected"])){
        $_SESSION['isConnected']=false;
    }

    // si je POSTE le champ, c'est que j'essaie de me connecter
    if (isset($_POST["email"]))
    {

        $password_bdd=$link->prepare("select password from `user` where email =? ");
        $password_bdd->bind_param("s",$_POST["email"]);
        $password_bdd->execute();
        $result = $password_bdd->get_result();
        $row =$result->fetch_assoc();
        $hash = $row ? $row["password"]:null;
                
        // la variable $hash correspond au sha256 du password

        if (isset($hash))
        {
            $hash_poste=hash('sha256', $_POST["password"]);
            // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
            if($hash==$hash_poste)
                {
                    $_SESSION['isConnected']=true;
                    $id_requete=$link->prepare("select id from `user` where email = ?");
                    $id_requete->bind_param("s",$_POST["email"]);
                    $id_requete->execute();
                    $id_result=$id_requete->get_result();
                    $id_row=$id_result->fetch_assoc();
                    $id=$id_row ? $id_row["id"] : null;
                    // je vais à la page de selection de grille
                    header("location: ../php/selection_grille.php?param=".$id); 
                    $id_requete->close();
                }
            else
                {
                    $MauvaisMotDePasse=true;
                }

        }
        else
            { 
                $MauvaisCompte=true;
            }
        $password_bdd->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">


</head>
<body>
    <div class="header">
        <img src="../image/Polytech_dijon.png">
    </div>
    <h1>Veuillez vous identifier</h1>
    <form method="POST">
        <h3>entrez votre email</h3>
        <input type="email" name="email" value="" required>
        <h3>entrez un mot de passe</h3>
        <input type="password" name="password" value="" required>
        <br>
        <br>
        <input class="button" type="submit" value="Connexion">
    </form>
<!-- On regarde le mot de passe et le compte-->
    <?php
        if($MauvaisMotDePasse){
            echo "<h3 class='warning'> /!\ Vous avez saisi un mauvais mot de passe. /!\ </h3>";
        }
        else if($MauvaisCompte){
            echo "<h3 class='warning'> /!\ Le compte n'existe pas ... /!\ </h3>";
        }
    ?>
    <br>
    <a class="button" href="../php/creation_compte.php"> Création de compte</a>
    
</body>
</html>