<?php
    // Script qui se charge de déconnecter un utilisateur
    session_destroy();
    include "config.php";

    // Suppréssion d'un éventuel cookie
    setcookie("user","");
    
    // Redirection vers homepage
    header('Status: 302 Temporary');
    header('Location: ' . SITE_URL . '/interfaces1.php');
    exit;
?>