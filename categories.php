<?php
	require('inclusions/entete.inc.php');

	// Lire les catégories pour l'affichage
	require('lib/sql.lib.php');
	require('lib/categorie-data.lib.php');
	
	// Vérifier si une opération est demandée 
	if(isset($_GET['op'])) {
		switch($_GET['op']) {
			case 'ajout':
				ajouter($_POST);
				break;
			case 'modification': 

				break;
			case 'suppression':

				break;
		}
	}
	
	$categories = lireTout();
	$categoriesPrincipales = lireCategoriesPrincipales();
	//print_r($categoriesPrincipales);
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
		<!-- Formulaire d'ajout -->
		<form method="post" class="nouveau" action="categories.php?op=ajout">
			<span></span>
			<span><input type="text" name="nom" value=""></span>
			<span>
				<select name="parent">
					<option value="">Choisir</option>
					<option value="0">-- aucun parent</option>
					<?php foreach($categoriesPrincipales as $cp) : ?>
						<option value="<?= $cp['id']; ?>"><?= $cp['nom']; ?></option>
					<?php endforeach; ?>
				</select>
			</span>
			<span class="action">
				<button type="submit" class="btn btn-ajouter btn-plein">ajouter</button>
			</span>
		</form>

		<!-- Formulaires de chaque enregistrement -->
		<?php foreach($categories as $categorie) : ?>
		<!-- L'attribut action réfère à l'URL qui gère le formulaire -->
		<form method="post">
			
			<span><input readonly type="text" name="id" value="<?= $categorie['id']; ?>"></span>
			<span><input type="text" name="nom" value="<?= $categorie['nom']; ?>"></span>
			<span>
				<select name="parent">
					<option <?= ($categorie['id_parent']==0) ? ' selected ' : ''; ?> value="0">-- aucun parent</option>
					<option <?= ($categorie['id_parent']==1) ? ' selected ' : ''; ?> value="1">Plat</option>
					<option <?= ($categorie['id_parent']==2) ? ' selected ' : ''; ?> value="2">Vin</option>
				</select>
			</span>
			<span class="action">
				<button formaction="categories.php?op=modification" class="btn btn-modifier">modifier</button>
				<button formaction="categories.php?op=suppression" class="btn btn-supprimer">supprimer</button>
			</span>
		</form>
		<?php endforeach; ?>
	</div>
</section>
<?php
	require('inclusions/pied2page.inc.php');
?>