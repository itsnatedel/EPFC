<?php
session_start();
include "config.php";
$login = $_SESSION['login'];

?>
<!-- Page USER CONNECTÉ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Les interface</title>
    <link type="text/css" rel="stylesheet" href="interfaces.css" media="all" />
</head>

<body>

    <!-- Bouton Déconnexion -->
    <div id="disconnect">
        <a href="<?= SITE_URL ?>/logout.php" name="disconnect">d&eacute;connexion</a>
    </div>

    <h1>mes e-Services</h1>
    <p><em style="color:#009900;">Bienvenue <?= $login ?> !</em></p>
</body>

</html>