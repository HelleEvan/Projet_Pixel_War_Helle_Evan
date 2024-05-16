<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Veuillez vous identifier</h1>
    <form method="POST">
        <h3>entrez un pseudo</h3>
        <input type="text" name="pseudo" value="" required>
        <h3>entrez un mot de passe</h3>
        <input type="password" name="password" value="" required>
        <input type="submit" value="S'enregister">
    </form>
    <a href="./../Projet_Pixel_War_Helle_Evan\creation_compte.php"> Création de compte</a>
    
</body>
</html>