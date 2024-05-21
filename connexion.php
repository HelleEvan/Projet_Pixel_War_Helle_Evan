<?php 
    include("./../Projet_Pixel_War_Helle_Evan/include/config.inc.php");
    $MauvaisMotDePasse=$MauvaisCompte=false;
    if(isset($_GET["isDeconected"])){
        $_SESSION['isConnected']=false;
    }

    // si je POSTE le champ, c'est que j'essaie de me connecter
    if (isset($_POST["email"]))
    {

        $password_bdd="select password from `user` where email = ".QuoteStr($_POST["email"]);
        $hash=GetSQLValue($password_bdd);
                
        // la variable $hash correspond au sha256 du password

        if (isset($hash))
        {
            $hash_poste=hash('sha256', $_POST["password"]);
            // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
            if($hash==$hash_poste)
                {
                    $_SESSION['isConnected']=true;
                    $id_requete="select id from `user` where email = ".QuoteStr($_POST["email"]);
                    $id = GetSQLValue($id_requete);
                    // je vais à la page de selection de grille
                    header("location: ./../Projet_Pixel_War_Helle_Evan/selection_grille.php?param=".$id); 
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
    <link rel="stylesheet" href="style.css">

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
        <h3>entrez votre email</h3>
        <input type="email" name="email" value="" required>
        <h3>entrez un mot de passe</h3>
        <input type="password" name="password" value="" required>
        <input type="submit" value="Connexion">
    </form>
    <a href="./../Projet_Pixel_War_Helle_Evan\creation_compte.php"> Création de compte</a>
    
</body>
</html>