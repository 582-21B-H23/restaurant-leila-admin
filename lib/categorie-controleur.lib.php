<?php
session_start();

// Cette page est accessible uniquement à un utilisateur connecté
if(!isset($_SESSION['utilisateur'])) {
  header('Location: index.php?m=e1040');
}

require('lib/sql.lib.php');
require('lib/'.$module.'-modele.lib.php');

if(isset($_GET['op'])) {
  switch($_GET['op']) {
    case 'ajout':
      ajouter($_POST);
      break;
    case 'modification': 
      changer($_POST);
      break;
    case 'suppression':
      enlever($_POST['id']);
      break;
  }
}

$categories = lireTout();
$categoriesPrincipales = lireCategoriesPrincipales();