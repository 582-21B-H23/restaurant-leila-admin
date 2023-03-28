<?php
/**
 * Manipulation des données des catégories du restaurant Leila
 */

/**
 * Cherche les catégories.
 * 
 * @return array : tableau de tableaux contenant les catégories
 */
function lireTout() {
  $bd = ouvrirConnexion();
  $sql = "SELECT * FROM categorie WHERE id <> 0 ORDER BY id_parent ";
  return lire($bd, $sql);
}

function lireCategoriesPrincipales() {
  $bd = ouvrirConnexion();
  $sql = "SELECT * FROM categorie WHERE id <> 0 AND id_parent=0";
  return lire($bd, $sql);
}



function ajouter($categorie) {
  $bd = ouvrirConnexion();
  // A compléter...
  $nom = mysqli_real_escape_string($bd, $categorie['nom']);
  $parent = (int)$categorie['parent']; 
  // ATTENTION : INJECTION SQL POSSIBLE : à corriger au prochain cours !
  $sql = "INSERT INTO categorie VALUES (NULL, '$nom', NULL, $parent)";
  return creer($bd, $sql);
}

function changer($categorie) {

}

function enlever($idCategorie) {

}