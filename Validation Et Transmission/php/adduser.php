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
    $listePays = array(
        "be" => "Belgique",
        "fr" => "France",
        "it" => "Italie",
        "gr" => "Grèce",
        "es" => "Espagne",
        "gb" => "Royaume-Uni",
        "us" => "États-Unis",
        "ca" => "Canada",
        "ru" => "Russe",
        "ch" => "Chine",
        "jp" => "Japon",
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

    // Sexe de l'utilisateur
    if ($sexe == "h") {
        $sexe = "Homme";
    } else {
        $sexe = "Femme";
    }

    // Pays de l'utilisateur
    if (array_key_exists($pays, $listePays)) {
        $pays = $listePays[$pays];
    }

    // Identifie les offres cochées des checkboxes
    foreach ($checked_chkbox as $boxes => $offre) {
        if (array_key_exists(intval($offre), $choix)) {
            $offresChosen .= $choix[intval($offre)] . " ";
        }
    }

    // Message d'inscription
    $message = "Bienvenu(e) $pseudo \n Sexe: $sexe \n Votre mail : $mail \n Pays: $pays \n  Offre(s) choisie(s) : $offresChosen \n";

    // Identifie l'extension du fichier Word -> .docx .docm .dotx .dotm .doc
    if (!in_array($extension, $wordExtensions)) {
        echo "<script> alert('Le fichier doit être un document Word!'); history.go(-1);</script>";
    } else {
        // Vérifie la taille du fichier Word -> Pas plus de 300 Ko
        if (filesize($file_path) > 300000) {
            echo "<script> alert('Le fichier est trop volumineux! Max. 300 Ko!'); history.go(-1);</script>)";
        } else {
            move_uploaded_file($file_path, $upload_dir . $file_name); // Envoie le fichier vers le dossier uploads
            $newName = $pseudo . "-cv." . $extension; // Nouveau nom du fichier
            rename($upload_dir . $file_name, $upload_dir . $newName); //Renommage du fichier
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
        "
        );

        // Ferme la connexion DDB
        mysqli_close($link);
    }

    // Notification d'inscription
    echo nl2br($message);

    // Crée un JSON dynamique venant de la BDD gestion
    function get_data()
    {
        // Database Connexion
        $username = "root";
        $password = "root";
        $hostname = "localhost";
        $ddb = "gestion";

        $connect = mysqli_connect($hostname, $username, $password, $ddb);
        $sqlResults = "SELECT * FROM users";
        $result = mysqli_query($connect, $sqlResults);
        $user_data = array();
        while ($row = mysqli_fetch_array($result)) { 
            $user_data[] = array(
                'pseudo' => $row["pseudo"],
                'password' => $row["password"],
                'mail' => $row["mail"],
                'sexe' => $row["sexe"],
                'pays' => $row["pays"],
                'choix' => $row["choix"],
                'signature' => $row["signature"],
            );
        }
        return json_encode($user_data);
    }

    $JSONDir = "../JSON/";
    $JSONFileName = date('d-m-Y') . '.json';
    if (file_put_contents($JSONFileName, get_data())) {
        rename($JSONFileName, $JSONDir . $JSONFileName);
    }
}
