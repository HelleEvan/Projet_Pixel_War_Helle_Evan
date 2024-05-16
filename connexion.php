<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");
    $MauvaisMotDePasse=$MauvaisCompte=false;

    // si je POSTE le champ, c'est que j'essaie de me connecter
    if (isset($_POST["pseudo"]))
    {

        $password_bdd="select password from `user` where pseudo = ".QuoteStr($_POST["pseudo"]);
        $hash=GetSQLValue($password_bdd);
                
        // la variable $hash correspond au sha256 du password

        if (isset($hash))
        {
            $hash_poste=hash('sha256', $_POST["password"]);
            // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
            if($hash==$hash_poste)
                {
                    $_SESSION['isConnected']=true;
                    $_SESSION['pseudo']=$_POST["pseudo"];
                    // je vais à la page index.html
                    header("location: ./../Projet_Pixel_War_Helle_Evan/selection_grille.php"); 
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<!-- On regarde le mot de passe-->
<?php if ($MauvaisMotDePasse) { ?>
            <div>
                <strong>Attention!</strong> Vous avez saisi un mauvais mot de passe.
            </div>
        <?php } ?>

        <?php if ($MauvaisCompte) { ?>
            <div>
                <strong>Attention!</strong> Le compte n'existe pas ...
            </div>
        <?php } ?>


    <h1>Veuillez vous identifier</h1>
    <form method="POST">
        <h3>entrez un pseudo</h3>
        <input type="text" name="pseudo" value="" required>
        <h3>entrez un mot de passe</h3>
        <input type="password" name="password" value="" required>
        <input type="submit" value="Connexion">
    </form>
    <a href="./../Projet_Pixel_War_Helle_Evan\creation_compte.php"> Création de compte</a>
    
</body>
</html>