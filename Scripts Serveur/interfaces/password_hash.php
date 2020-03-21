<?php
$hash = password_hash($pwd,PASSWORD_DEFAULT); // Hashage du mot de passe

$pwd = $hash;
?>