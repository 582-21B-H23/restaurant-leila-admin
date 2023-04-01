<?php
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

$vins = lireTout();
$categoriesVins = lireCategoriesVins();