<?php require('lib/util.lib.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;900&family=Roboto:wght@400;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="ressources/css/leila-admin.css">
  <link rel="icon" type="image/png" href="ressources/images/favicon.png" />
  <title>Admin :: Restaurant Leila</title>
</head>
<body>
  <?php if(isset($_GET['m'])) : 
      $msgCode = $_GET['m'];
      $msgType = MESSAGES[$msgCode]['type'];
      $msgTexte = MESSAGES[$msgCode]['texte'];
  ?>
  <div class="message <?= $msgType; ?>">
    <?= $msgTexte; ?>
  </div>
  <?php endif; ?>
  <header>
    <h2>Admin - Restaurant Leila</h2>
    <?php if(isset($_SESSION['utilisateur'])) : ?>
      <div class="nav">
        <nav class="navigation-principale">
          <ul>
            <li class="<?= ($module=='categorie') ? 'actif' : '' ?>"><a href="categories.php">Catégories</a></li>
            <li class="<?= ($module=='plat') ? 'actif' : '' ?>"><a href="plats.php">Plats</a></li>
            <li class="<?= ($module=='vin') ? 'actif' : '' ?>"><a href="vins.php">Vins</a></li>
          </ul>
        </nav>
        <div class="profil-utilisateur">
          Bonjour <?= $_SESSION['utilisateur']['nom_complet'] ?>
          <a href="index.php?op=deconnexion">Déconnexion</a>
        </div>
      </div>
    <?php endif; ?>
  </header>
