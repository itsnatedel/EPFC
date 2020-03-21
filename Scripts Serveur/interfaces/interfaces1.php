<?php
session_start();
require 'config.php';

if (isset($_POST['go'])) {

	if (!empty($_POST['login']) && !empty($_POST['password'])) {
		$login = $_POST['login'];
		$pwd = $_POST['password'];


		// Connexion à la DDB
		$mysql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

		$login = mysqli_real_escape_string($mysql, $login);

		// Requête
		$query = "SELECT login, password FROM `users` WHERE login='$login'";

		// Résultat 
		$result = mysqli_query($mysql, $query);
		var_dump($result);
		if ($result) {
			$user = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
		}
		// Si l'utilisateur est inconnu de la BDD -> redir vers page "Accès Refusé"
		if (mysqli_affected_rows($mysql) == 0) {
			$_SESSION['login'] = $login;
			header('Status: 302 Temporary');
			header('Location: ' . SITE_URL . '/interfaces11b.php');
			exit;
		}
		mysqli_close($mysql);

		// Si Retenir login est coché -> Création du cookie
		if (isset($_POST['keepLogin'])) {
			setcookie("user", $login);
			var_dump($_COOKIE);
		}
		if (password_verify($pwd, $user['password'])) {
			// Auth -> sauvegarde login dans variable session
			$_SESSION['login'] = $login;
			
			// Redir vers la interfaces 1.1.a (user connecté)
			header('Status: 302 Temporary');
			header('Location: ' . SITE_URL . '/interfaces11a.php');
			exit;
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

	<!-- Page d'accueil -->
	<div id="main">
		<h1>Bienvenue chez vous !</h1>
		<p>Cher client,<br />
			D&eacute;sormais, vous pouvez acc&eacute;der &agrave; notre espace personnalis&eacute; et s&eacute;curis&eacute; pour effectuer des demandes sur nos produits.</p>
		<h2>Je suis d&eacute;j&agrave; un utilisateur</h2>
		<p>Veuillez entre votre login (nom d&rsquo;utilisateur) et mot de passe ici &agrave; droite.</p>
		<h2>Je ne suis pas encore un utilisateur</h2>
		<p>Nous vous invitons &agrave; vous enregistrer gratuitement en cliquant sur le bouton &quot;s&rsquo;enregistrer&quot; ci-dessous.</p>
		<p>Merci.</p>
		<form id="frmSign" method="POST" action="<?= SITE_URL ?>/register.php">
			<input type="submit" name="signin" value="s'enregistrer" />
		</form>
	</div>

	<!-- Sign-In -->
	<div id="colonne">

		<div id="divLog">
			<h1>acc&eacute;der &agrave; mes e-Services</h1>
			<!-- interfaces11a.php -->
			<form id="frmLog" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
				<label>Login</label><br />
				<input type="text" name="login" value="<?php echo isset($_COOKIE['user']) ? $_COOKIE['user'] : ''; ?>" required /><br />
				<label>Mot de passe</label><br />
				<input type="text" name="password" required /><br />
				<input type="checkbox" name="keepLogin" /> <label for="keepLogin" class="normal">Retenir login</label><br />
				<input type="reset" value="&gt; effacer" /> <input type="submit" name="go" value="&gt; Go" />
			</form>
		</div>

		<div id="aide">
			<h1>Aide</h1>
			<ul>
				<!-- Bouton oubli login/pwd -->
				<li><a href="<?php echo SITE_URL ?>/interfaces12a.php">Oubli&eacute; mon login/mot de passe</a></li>

				<!-- Bouton Support -->
				<li><a href="<?= SITE_URL ?>/support.html">Support en ligne</a></li>
			</ul>
		</div>

	</div>
</body>

</html>