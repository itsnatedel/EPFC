<?php
session_start();
require 'config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Les interfaces</title>
	<link type="text/css" rel="stylesheet" href="interfaces.css" media="all" />
</head>

<body>
	<!-- Page USER INCONNU -->
	<div id="main">
		<h1>Authentification</h1>
		<p><strong><em style="color:#FF0000;">Acc&egrave;s refus&eacute;&nbsp;!</em></strong><br />
			Votre login/mot de passe est incorrect.</p>
		<h2>Je ne suis pas encore un utilisateur</h2>
		<p>Nous vous invitons &agrave; vous enregistrer gratuitement en cliquant sur le bouton &quot;s&rsquo;enregistrer&quot; ci-dessous.</p>
		<p>Merci.</p>

		<!-- Sign Up -->
		<form id="frmSign" method="POST" action="<?= SITE_URL ?>/register.php">
			<input type="submit" name="signin" value="s'enregistrer" />
		</form>
	</div>

	<div id="colonne">
		<div id="divLog">
			<h1>acc&eacute;der &agrave; mes e-Services</h1>

			<!-- Log In -->
			<form id="frmLog" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
				<label>Login</label><br />
				<input type="text" name="login" value="<?php echo isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?>" /><br />

				<label>Mot de passe</label><br />
				<input type="password" name="password" /><br />

				<input type="checkbox" name="keepLogin" /> <label for="keepLogin" class="normal">Retenir login</label><br />

				<input type="reset" value="&gt; effacer" /> <input type="submit" name="go" value="&gt; Go" />
			</form>

		</div>

		<div id="aide">
			<h1>Aide</h1>
			<ul>
				<li><a href="#">Oubli&eacute; mon login/mot de passe</a></li>
				<li><a href="#">Support en ligne</a></li>
			</ul>
		</div>

	</div>
</body>

</html>