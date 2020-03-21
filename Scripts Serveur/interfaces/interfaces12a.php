<?php
session_start();
include "config.php";
$message = "";

if (isset($_POST['sendmail'])) {
	if (isset($_POST['email'])) {
		$mail = $_POST['email'];
		$pattern = '/\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/';

		if (preg_match($pattern, $mail)) {
			// Connexion à la DDB
			$mysql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

			$login = mysqli_real_escape_string($mysql, $mail);

			// Requête
			$query = "SELECT email FROM `users` WHERE email='$mail'";

			// Résultat 
			$result = mysqli_query($mysql, $query);

			if ($result) {
				$user = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
			}
			if (mysqli_affected_rows($mysql) == 1) {
				$_SESSION['mail'] = $mail;
				// Redirection -> interfaces12b.php
				header('Location: ' . SITE_URL . '/interfaces12b.php');
				header('Status: 302 Temporary');
				exit;
			} else {
				$message = "L'adresse e-mail indiquée n'est associée à aucun compte.";
			}
			mysqli_close($mysql);
		} else {
			$message = "Veuillez entrer une adresse mail valide !";
		}
	}
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
	<p>Veuillez nous indiquer l'adresse e-mail fournie lors de votre inscription.</p>
	<div id="message" style="color: red;"><?= $message ?></div>
	<form id="frmMail" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<label for="email">e-mail</label><br />
		<input type="text" name="email" /><br />
		<input type="submit" name="sendmail" value="envoyer" />
	</form>

</body>

</html>