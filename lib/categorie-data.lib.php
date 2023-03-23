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
  $sql = "SELECT * FROM categorie ORDER BY id_parent";
  return lire($bd, $sql);
}

function ajouter($categorie) {
  $bd = ouvrirConnexion();
  // A compléter...
  $nom = $categorie['nom'];
  $parent = $categorie['parent'];
  // ATTENTION : INJECTION SQL POSSIBLE : à corriger au prochain cours !
  $sql = "INSERT INTO categorie VALUES (NULL, '$nom', NULL, $parent)";
  return creer($bd, $sql);
}

function changer($categorie) {

}

function enlever($idCategorie) {

}