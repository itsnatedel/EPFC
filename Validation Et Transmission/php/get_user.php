<?php

//Connexion à la base de données `gestion` 
$username = "root";
$password = "root";
$hostname = "localhost";
$ddb = "gestion";

// Si la connexion est établie avec la DDB
if ($link = mysqli_connect($hostname, $username, $password, $ddb)) {
    if (isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['sexe']) && isset($_POST['listePays'])) {
        $pseudo = $_POST['pseudo'];
        $pwd = $_POST['pass'];
        $mail = $_POST['email'];
        $sexe = $_POST['sexe'];
        $pays = $_POST['listePays'];
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

        // Requête SQL
        $query = mysqli_query($link, "SELECT * FROM users WHERE pseudo='$pseudo' AND mail='$mail'");

        // Si la requête renvoie plus d'un résultat => l'utilisateur existe déjà dans la DDB
        if (mysqli_num_rows($query) > 0) {
?>          <script>
                alert("Vous avez déjà été enregistré(e)!");
                history.go(-1); // Retourne à la page antérieure
            </script>
<?php
            // Ferme la connexion DDB
            mysqli_close($link);
        } else {
            include 'adduser.php';
        }
    }
}
?>