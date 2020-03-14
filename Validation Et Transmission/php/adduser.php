<?php
if (isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['sexe']) && isset($_POST['listePays'])) {
    // Info Utilisateur
    $pseudo = $_POST['pseudo'];
    $pwd = $_POST['pass'];
    $mail = $_POST['email'];
    $sexe = $_POST['sexe'];
    $pays = $_POST['listePays'];
    $signature = $_POST['signature'];
    $checked_chkbox = $_POST['choix'];
    $offresChosen = "";
    $choix = array(
        1 => "Light",
        2 => "Medium",
        3 => "Speed",
    );

    // Identifie les offres cochées des checkboxes
    foreach ($checked_chkbox as $boxes => $offre) {
        if (array_key_exists(intval($offre), $choix)) {
            $offresChosen .= $choix[intval($offre)] . " ";
        }
    }

    // Database Connexion
    $username = "root";
    $password = "root";
    $hostname = "localhost";
    $ddb = "gestion";

    // Si la connexion est établie avec DDB
    if ($link = mysqli_connect($hostname, $username, $password, $ddb)) {
        // Requête MySQL pour ajouter un utilisateur
        $query = mysqli_query(
        $link,
        "INSERT INTO users (pseudo, password, mail, sexe, pays, choix, signature)
        VALUES ('$pseudo','$pwd','$mail','$sexe', '$pays', '$offresChosen','$signature')
        ");

        // Ferme la connexion DDB
        mysqli_close($link);
        echo "<script> alert('Vous avez été enregistré(e)!'); history.go(-1); </script>";
        
    }
}
