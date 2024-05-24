<?php
    include("../include/config.inc.php");
    $to_email = $_POST["email"];
    echo $to_email;
    $subject = "mot de passe oublié";
    $body = "Ceci est un email de test envoyé depuis PHP.";

    // En-têtes
    $headers = "From: noreply@pixelwar.com\r\n";
    $headers .= "Reply-To: noreply@pixelwar.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envoi de l'email
    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email envoyé avec succès à $to_email.";
    } else {
        echo "Erreur lors de l'envoi de l'email.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="header">
        <img src="../image/Polytech_dijon.png">
    </div>
    <form method="POST">
    <h3>Veuillez entrez votre email</h3>
    <input type="emai" name="email" value="" required>
    <br>
    <input class="button" type="submit" value="recevoir un formulaire d'oublie de mot de passe">
    </form>
</body>
</html>