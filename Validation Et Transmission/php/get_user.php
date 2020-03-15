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

        // Récupération du fichier
        $file = $_FILES['cv'];
        $file_name = $file['name']; // Nom du fichier
        $file_path = $file['tmp_name']; // Chemin du fichier

        // Récupération de l'extension du fichier
        $expl = explode(".", $file['name']);
        $extension = end($expl);

        // Chemin du dossier uploads
        $upload_dir = "../uploads/";

        // Liste des extensions Word acceptées par le script
        $wordExtensions = array(
            "docx",
            "docm",
            "dotx",
            "dotm",
            "doc",
        );

        // Identifie les offres cochées des checkboxes
        foreach ($checked_chkbox as $boxes => $offre) {
            if (array_key_exists(intval($offre), $choix)) {
                $offresChosen .= $choix[intval($offre)] . " ";
            }
        }

        // Identifie l'extension du fichier Word -> .docx .docm .dotx .dotm .doc
        if (!in_array($extension, $wordExtensions)) {
            echo "<script> alert('Le fichier doit être un document Word!'); history.go(-1);</script>";
        } else {

            // Vérifie la taille du fichier Word -> Pas plus de 300 Ko 
            if (filesize($file_path) > 300000) {
                echo "<script> alert('Le fichier est trop volumineux! Moins de 300 Ko.');</script>)";
            } else {
                
                move_uploaded_file($file_path, $upload_dir . $file_name); // Envoie le fichier vers le dossier uploads
            }
        }


        // Requête SQL
        $query = mysqli_query($link, "SELECT * FROM users WHERE pseudo='$pseudo' AND mail='$mail'");

        // Si la requête renvoie plus d'un résultat => l'utilisateur existe déjà dans la DDB
        if (mysqli_num_rows($query) > 0) {
?> <script>
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