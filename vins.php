<?php
	$module = 'vin';
	require("lib/$module-controleur.lib.php");
	require('inclusions/entete.inc.php');
?>
<section class="liste-enregistrements">
	<h2><code>Vins</code></h2>
	<header>
		<span>id</span>
		<span>nom</span>
		<span>détail</span>
    <span>provenance</span>
    <span>prix</span>
    <span>catégorie</span>
		<span class="action"></span>
	</header>
	<div class="data">
		<!-- Formulaire d'ajout -->
		<form method="post" class="nouveau" action="vins.php?op=ajout">
			<span></span>
			<span><input type="text" name="nom" value=""></span>
      <span><input type="text" name="detail" value=""></span>
      <span><input type="text" name="provenance" value=""></span>
      <span><input type="text" name="prix" value=""></span>
			<span>
				<select name="id_categorie">
					<option value="">Choisir</option>
					<?php foreach($categoriesVins as $cv) : ?>
						<option value="<?= $cv['id']; ?>"><?= $cv['nom']; ?></option>
					<?php endforeach; ?>
				</select>
			</span>
			<span class="action">
				<button type="submit" class="btn btn-ajouter btn-plein">ajouter</button>
			</span>
		</form>

		<!-- Formulaires de chaque enregistrement -->
		<?php foreach($vins as $vin) : ?>
		<!-- L'attribut action réfère à l'URL qui gère le formulaire -->
		<form method="post">
			<span><input readonly type="text" name="id" value="<?= $vin['id']; ?>"></span>
			<span><input type="text" name="nom" value="<?= $vin['nom']; ?>"></span>
			<span><input type="text" name="detail" value="<?= $vin['detail']; ?>"></span>
      <span><input type="text" name="provenance" value="<?= $vin['provenance']; ?>"></span>
      <span><input type="text" name="prix" value="<?= $vin['prix']; ?>"></span>
      <span>
				<select name="id_categorie">
					<?php foreach($categoriesVins as $cv) : ?>	
						<option 
							<?= ($vin['id_categorie']==$cv['id']) ? ' selected ' : ''; ?> 
							value="<?= $cv['id']; ?>"
						>
							<?= $cv['nom']; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</span>
			<span class="action">
				<button type="submit" formaction="vins.php?op=modification" class="btn btn-modifier">modifier</button>
				<button type="submit" formaction="vins.php?op=suppression" class="btn btn-supprimer">supprimer</button>
			</span>
		</form>
		<?php endforeach; ?>
	</div>
</section>
<?php
	require('inclusions/pied2page.inc.php');
?>