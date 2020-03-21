<?php
session_start();
require "config.php";
$message = "";

if (isset($_POST['go'])) {
    if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confPwd'])) {
        $login = $_POST['login'];
        $mail = $_POST['email'];
        $pwd = $_POST['password'];
        $confPwd = $_POST['confPwd'];

        $regexMail = '/\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/';
        $regexPwd = '/.*(?=.*[A-Z])(?=.*[0-9]+)(?=.*[a-z]).*/';

        // Contraintes pour le login
        if (strlen($login) > 60) {
            $message = "Login trop long ! Max. 60 caractères";
        } elseif (empty($login)) {
            $message = "Veuillez entrer un login valide.";
        } else {
            // Contrainte pour l'adresse mail
            if (!preg_match($regexMail, $mail)) {
                $message = "Veuillez entrer une adresse mail valide.";
            } else {
                // Contraintes pour le mot de passe et la confirmation
                if ($pwd !== $confPwd) {
                    $message = "Les mots de passe ne correspondent pas !";
                } elseif (!preg_match($regexPwd, $pwd) || !preg_match($regexPwd, $confPwd)) {
                    $message = "Les mots de passe doivent contenir au moins une majuscule et un chiffre !";
                } elseif (strlen($pwd) > 255 || strlen($confPwd) > 255) {
                    $message = "Les mots de passe sont trop longs !";
                } else {
                    // Appel du script password_hash.php
                    include "password_hash.php"; // Renvoie le mot de passe hashé

                    // Connexion à la DDB
                    $mysql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

                    // Requête SQL SELECT
                    $query = "SELECT email FROM `users` WHERE email='$mail'";

                    // Résultat 
                    $result = mysqli_query($mysql, $query);

                    // Si le mail fait déjà parti de la DDB
                    if (mysqli_affected_rows($mysql) !== 0) {
                        $message = "Vous êtes déjà inscrit !";
                        mysqli_free_result($result);
                    } else {
                        // Requête SQL INSERT
                        $query = "INSERT INTO `users` (login, password, email) VALUES ('$login','$pwd','$mail')";
                        mysqli_query($mysql, $query);
                        $message = "Vous êtes désormais inscrit !";
                        setcookie("user", $login);
                    }

                    mysqli_close($mysql);
                }
            }
        }
    } else {
        $message = "Erreur dans le formulaire";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Interfaces Inscription</title>
    <link type="text/css" rel="stylesheet" href="interfaces.css" media="all" />
</head>

<body>
    <h1>Inscription</h1>

    <div id="message"><?= $message ?? '' ?></div>

    <form id="frmInscri" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Login</label><br />
        <input type="text" name="login" placeholder="Entrez votre nom" required/> <br/>

        <label for="email">Email:</label><br />
        <input type="email" id="email" name="email" placeholder="Entre votre email" required/> <br/>

        <label>Mot de passe (au moins 1 majuscule, 1 chiffre)</label><br />
        <input type="password" name="password" placeholder="Entrez votre mot de passe" required/> <br/>

        <label>Confirmez le mot de passe</label><br />
        <input type="password" name="confPwd" placeholder="Confirmez le mot de passe" required/> <br/>

        <input type="reset" value="&gt; effacer"/> <input type="submit" name="go" value="&gt; Go"/>
    </form>

    <a href="<?= SITE_URL ?>/interfaces1.php">Retour à la page d'accueil</a>
</body>

</html>