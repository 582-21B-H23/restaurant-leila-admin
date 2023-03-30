<?php
	$module = 'categorie';
	require("lib/$module-controleur.lib.php");
	require('inclusions/entete.inc.php');
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
					<?php foreach($categoriesPrincipales as $cp) : ?>	
						<option 
							<?= ($categorie['id_parent']==$cp['id']) ? ' selected ' : ''; ?> 
							value="<?= $cp['id']; ?>"
						>
							<?= $cp['nom']; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</span>
			<span class="action">
				<button type="submit" formaction="categories.php?op=modification" class="btn btn-modifier">modifier</button>
				<button type="submit" formaction="categories.php?op=suppression" class="btn btn-supprimer">supprimer</button>
			</span>
		</form>
		<?php endforeach; ?>
	</div>
</section>
<?php
	require('inclusions/pied2page.inc.php');
?>