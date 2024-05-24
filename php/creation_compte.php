<?php 
    include("../include\config.inc.php");
    //recuperation des POST
    $isCreated = false;
    $pseudo_already_used =false;
    $email_already_used =false;
    if (isset($_POST["pseudo"]))
        {
            
            $pseudo=$_POST["pseudo"];
            $email=$_POST["email"];
            //hash du password
            $hash_password=hash('sha256', $_POST["password"]);
            $password=QuoteStr($hash_password);

            //gestion pseudo et email identique
            $existing_pseudo_requete =$link->prepare("SELECT `pseudo` FROM `user` WHERE `pseudo`=?");
            $existing_pseudo_requete->bind_param("s",$pseudo);
            $existing_pseudo_requete->execute();
            $result=$existing_pseudo_requete->get_result();
            $row = $result->fetch_assoc();
            $existing_pseudo= $row ? $row["pseudo"]:null;

            $existing_email_requete =$link->prepare("SELECT `email` FROM `user` WHERE `email`=?");
            $existing_email_requete->bind_param("s",$email);
            $existing_email_requete->execute();
            $mail_result = $existing_email_requete->get_result();
            $mail_row = $mail_result->fetch_assoc();
            $existing_email=$mail_row ? $mail_row["email"] : null;
            
            if(isset($existing_pseudo)){

                $pseudo_already_used =true;
            }
            else if (isset($existing_email)){
                $email_already_used = true;
            }
            else{

                $sql=$link->prepare("INSERT INTO `user` (`pseudo`, `password`, `email`) VALUES (?,?,?)");
                $sql->bind_param("sss",$pseudo,$password,$email);
                $sql->execute();
                $isCreated = true;
                $sql->close();
            }
            $existing_pseudo_requete->close();
            $existing_email_requete->close();
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <img src="../image/Polytech_dijon.png">
    </div>
    <h1>Création de compte</h1>
<!-- formulaire pour enregistrer un user-->
    <form method="POST">
        <h3>entrez un pseudo</h3>
        <input type="text" name="pseudo" value="" required>
        <h3>entrez un mot de passe</h3>
        <input type="password" name="password" value="" required>
        <h3>entrez un mail</h3>
        <input type="email" name="email" value="" required>
        <br><br>
        <input class="button" type="submit" value="S'enregister">
    </form>
    <?php
        if($isCreated){
            echo "<h3 class='well_created'> /!\ Votre compte a été crée avec succès  /!\ </h3>";
        }
        if($pseudo_already_used){
            echo "<h3 class='warning'> /!\ le pseudo a déjà été utilisé /!\ </h3>";
        }
        if($email_already_used){
            echo "<h3 class='warning'> /!\ le mail a déjà été utilisé  /!\ </h3>";
        }
    ?>
    <br>
    <a class="button" href="../php/connexion.php"> Déjà un compte? -> S'identifier</a>
    
</body>
</html>