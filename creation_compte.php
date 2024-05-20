<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");
    //recuperation des POST
    $isCreated = false;
    if (isset($_POST["pseudo"]))
        {
            
            $pseudo=QuoteStr($_POST["pseudo"]);
            $email=QuoteStr($_POST["email"]);
            //hash du password
            $hash_password=hash('sha256', $_POST["password"]);
            $password=QuoteStr($hash_password);

            $sql="INSERT INTO `user` (`pseudo`, `password`, `email`) VALUES ($pseudo, $password,$email)";
            ExecuteSQL($sql);
            $isCreated = true;
            

        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
</head>
<body>
    <h1>Création de compte</h1>
<!-- formulaire pour enregistrer un user-->
    <form method="POST">
        <h3>entrez un pseudo</h3>
        <input type="text" name="pseudo" value="" required>
        <h3>entrez un mot de passe</h3>
        <input type="password" name="password" value="" required>
        <h3>entrez un mail</h3>
        <input type="text" name="email" value="" required>
        <input type="submit" value="S'enregister">
    </form>
    <?php
        if($isCreated){
            echo "<h3> /!\ Votre compte à été crée avec succès  /!\ </h3>";
            
        }
    ?>
    <a href="./../Projet_Pixel_War_Helle_Evan\connexion.php"> Déjà un compte? -> S'identifier</a>
    
</body>
</html>