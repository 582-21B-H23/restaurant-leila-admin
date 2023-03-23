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
  $sql = "SELECT * FROM categorie";
  return lire($bd, $sql);
}

function ajouter($categorie) {
  $bd = ouvrirConnexion();
  // A compléter...
  // $sql = "INSERT INTO categorie VALUES ()";
  return creer($bd, $sql);
}

function changer($categorie) {

}

function enlever($idCategorie) {

}