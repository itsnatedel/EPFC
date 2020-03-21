<?php
session_start();
include "config.php";

if (isset($_SESSION['mail'])) {

    function generatePassword()
    {
        /** Génère un mot de passe non crypté
         * -> $caract contient tous les caractères et symboles acceptés
         * -> str_shuffle mélange la chaine de caractère
         * -> substr récupère 10 caractères de la chaîne de caractère mélangée
         * -> renvoie un mot de passe semi-random
         */
        $caract = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        $password = substr(str_shuffle($caract), 0, 10);
        return $password;
    }

    $mail = $_SESSION['mail'];

    // Connexion à la DDB
    $mysql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    $mail = mysqli_real_escape_string($mysql, $mail);

    // Requête SQL
    $query = "SELECT * FROM `users` WHERE email='$mail'";

    // Résultat 
    $result = mysqli_query($mysql, $query);

    if ($result) {
        // Stocke les informations du résultats dans un array
        $user_data = array();
        while ($ligne = mysqli_fetch_array($result)) {
            $user_data = array(
                'login' => $ligne['login'],
            );
        }
        $login = $user_data['login'];
        mysqli_free_result($result);
    }

    $pwd = generatePassword();
    $pwdEmail = $pwd;
    
    
    // Appel du script password_hash.php
    include "password_hash.php"; // Renvoie le mot de passe hashé

    // Requête SQL pour modifier l'ancien mot de passe avec le nouveau hashé
    $query = "UPDATE `users` SET password='$pwd' WHERE login='$login'";

    mysqli_query($mysql, $query);

    mysqli_close($mysql);

    // Préparation du mail
    $to = $mail;
    $subject = "Réinitialisation de votre mot de passe";

    // Message de l'email
    $message = 'Bonjour,
    Nous avons bien reçu votre demande d\'oubli de login/mot de passe.
    Voici les informations qui vous permettront de vous connecter :
    Login: ' . $login . '
    Votre nouveau mot de passe : ' . $pwdEmail . '';

    // Headers mail (From est requis)
    $headers = 'From: <support@interfaces.com>';

    // Envoi du mail
    mail($to, $subject, $message, $headers); 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Les interfaces</title>
    <link type="text/css" rel="stylesheet" href="interfaces.css" media="all" />
</head>

<body>
    <h1>R&eacute;cup&eacute;ration de login/mot de passe</h1>
    <p>Un e-mail vous a &eacute;t&eacute; envoy&eacute;. Vous y trouverez vos informations de connexion.</p>
    <p>Retour &agrave; l&rsquo; <a href="<?= SITE_URL ?>/interfaces1.php">accueil</a></p>
</body>

</html>