<?php
    // Fichier qui se charge de déconnecter un utilisateur
    require "config.php";
    session_destroy();

    // Suppréssion d'un éventuel cookie
    setcookie("user","");
    
    // Redirection vers homepage
    header('Status: 302 Temporary');
    header('Location: ' . SITE_URL . '/interfaces1.php');
    exit;
?>