<?php
	$module = 'utilisateur';
	require("lib/$module-controleur.lib.php");
	require('inclusions/entete.inc.php');
?>
<section class="gestion-utilisateur">
	<!-- Formulaire de connexion -->
	<form class="connexion <?= (!isset($_GET['frm']) || $_GET['frm'] == 'connexion') ? 'actif' : '' ; ?>" action="index.php?op=connexion" method="post">
		<legend>Ouvrir une connexion</legend>
		<div class="champs">
			<label for="cnx-courriel">Courriel</label>
			<input type="email" name="courriel" id="cnx-courriel" placeholder="Adresse de courriel">
		</div>
		<div class="champs">
			<label for="cnx-mdp">Mot de passe</label>
			<input type="password" name="mdp" id="cnx-mdp" placeholder="Mot de passe">
		</div>
		<input class="btn btn-connexion" type="submit" value="Connexion">
		<span class="liens">
			<a href="index.php?frm=nouveau" class="nv">Créer un compte</a>
			<a href="index.php?frm=mdp" class="mdp">Mot de passe oublié</a>
		</span>
	</form>

	<!-- Formulaire de création de compte -->
	<form class="nouveau <?= (isset($_GET['frm']) && $_GET['frm'] == 'nouveau') ? 'actif' : '' ; ?>" action="index.php?op=nouveau" method="post">
		<legend>Créer un nouveau compte</legend>
		<div class="champs">
			<label for="nv-courriel">Courriel</label>
			<input type="email" name="courriel" id="nv-courriel" placeholder="Adresse de courriel">
		</div>
		<div class="champs">
			<label for="nv-mdp">Mot de passe</label>
			<input type="password" name="mdp" id="nv-mdp" placeholder="Mot de passe">
		</div>
		<div class="champs">
			<label for="nv-nom">Nom complet</label>
			<input type="text" name="nom_complet" id="nv-nom" placeholder="Prénom suivi du nom">
		</div>
		<input class="btn btn-connexion" type="submit" value="Créer le compte">
		<span class="liens">
			<a href="index.php?frm=connexion" class="cnx">Se connecter</a>
			<a href="index.php?frm=mdp" class="mdp">Mot de passe oublié</a>
		</span>
	</form>

	<!-- Formulaire de mot de passe oublié -->
	<form class="mdp <?= (isset($_GET['frm']) && $_GET['frm'] == 'mdp') ? 'actif' : '' ; ?>" action="index.php?op=mdp" method="post">
		<legend>Demande de réinitialisation du mot de passe</legend>
		<div class="champs">
			<label for="mdp-courriel">Courriel</label>
			<input type="email" name="courriel" id="mdp-courriel" placeholder="Adresse de courriel">
		</div>
		<input class="btn btn-connexion" type="submit" value="Réinitialiser">
		<span class="liens">
			<a href="index.php?frm=connexion" class="cnx">Se connecter</a>
			<a href="index.php?frm=nouveau" class="nv">Créer un compte</a>
		</span>
	</form>
</section>
<?php
	require('inclusions/pied2page.inc.php');
?>
