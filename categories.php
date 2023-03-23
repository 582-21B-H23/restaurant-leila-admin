<?php
	require('inclusions/entete.inc.php');

	// Lire les catégories pour l'affichage
	require('lib/sql.lib.php');
	require('lib/categorie-data.lib.php');
	$categories = lireTout();
	print_r($categories);
?>
<section class="liste-enregistrements">
	<h2><code>Catégories</code></h2>
	<header>
		<span>id</span>
		<span>nom</span>
		<span>parent</span>
		<span class="action"></span>
	</header>
	<div class="data">
		<form method="post" class="nouveau">
			<span></span>
			<span><input type="text" name="nom" value=""></span>
			<span>
				<select name="parent">
					<option value="">Choisir</option>
					<option value="NULL">-- aucun parent</option>
					<option value="plat">Plat</option>
					<option value="vin">Vin</option>
				</select>
			</span>
			<span class="action">
				<button class="btn btn-ajouter btn-plein">ajouter</button>
			</span>
		</form>
		<form method="post">
			<span>1</span>
			<span><input type="text" name="nom" value="Entrées"></span>
			<span>
				<select name="parent">
					<option value="plat">Plat</option>
					<option value="vin">Vin</option>
				</select>
			</span>
			<span class="action">
				<button class="btn btn-modifier">modifier</button>
				<button class="btn btn-supprimer">supprimer</button>
			</span>
		</form>
	</div>
</section>
<?php
	require('inclusions/pied2page.inc.php');
?>