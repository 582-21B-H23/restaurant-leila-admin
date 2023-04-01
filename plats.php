<?php
	$module = 'plat';
	require("lib/$module-controleur.lib.php");
	require('inclusions/entete.inc.php');
?>
<section class="liste-enregistrements">
	<h2><code>Plats</code></h2>
	<header>
		<span>id</span>
		<span>nom</span>
		<span>détail</span>
    <span>portion</span>
    <span>prix</span>
    <span>catégorie</span>
		<span class="action"></span>
	</header>
	<div class="data">
		<!-- Formulaire d'ajout -->
		<form method="post" class="nouveau" action="plats.php?op=ajout">
			<span></span>
			<span><input type="text" name="nom" value=""></span>
      <span><input type="text" name="detail" value=""></span>
      <span><input type="text" name="portion" value="1"></span>
      <span><input type="text" name="prix" value=""></span>
			<span>
				<select name="id_categorie">
					<option value="">Choisir</option>
					<?php foreach($categoriesPlats as $cp) : ?>
						<option value="<?= $cp['id']; ?>"><?= $cp['nom']; ?></option>
					<?php endforeach; ?>
				</select>
			</span>
			<span class="action">
				<button type="submit" class="btn btn-ajouter btn-plein">ajouter</button>
			</span>
		</form>

		<!-- Formulaires de chaque enregistrement -->
		<?php foreach($plats as $plat) : ?>
		<!-- L'attribut action réfère à l'URL qui gère le formulaire -->
		<form method="post">
			<span><input readonly type="text" name="id" value="<?= $plat['id']; ?>"></span>
			<span><input type="text" name="nom" value="<?= $plat['nom']; ?>"></span>
			<span><input type="text" name="detail" value="<?= $plat['detail']; ?>"></span>
      <span><input type="text" name="portion" value="<?= $plat['portion']; ?>"></span>
      <span><input type="text" name="prix" value="<?= $plat['prix']; ?>"></span>
      <span>
				<select name="id_categorie">
					<?php foreach($categoriesPlats as $cp) : ?>	
						<option 
							<?= ($plat['id_categorie']==$cp['id']) ? ' selected ' : ''; ?> 
							value="<?= $cp['id']; ?>"
						>
							<?= $cp['nom']; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</span>
			<span class="action">
				<button type="submit" formaction="plats.php?op=modification" class="btn btn-modifier">modifier</button>
				<button type="submit" formaction="plats.php?op=suppression" class="btn btn-supprimer">supprimer</button>
			</span>
		</form>
		<?php endforeach; ?>
	</div>
</section>
<?php
	require('inclusions/pied2page.inc.php');
?>