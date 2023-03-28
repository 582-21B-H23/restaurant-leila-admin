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
  // Prévenir les injections SQL en assainissant les valeurs provenant 
  // de l'extérieur de mon code
  $nom = mysqli_real_escape_string($bd, $categorie['nom']);
  $parent = (int)$categorie['parent']; 
  $sql = "INSERT INTO categorie VALUES (NULL, '$nom', NULL, $parent)";
  return creer($bd, $sql);
}

function changer($categorie) {
  $bd = ouvrirConnexion();
  $id = (int)$categorie['id'];
  $nom = mysqli_real_escape_string($bd, $categorie['nom']);
  $parent = (int)$categorie['parent']; 
  $sql = "UPDATE categorie SET nom='$nom', id_parent=$parent WHERE id=$id";
  return creer($bd, $sql);
}

/**
 * Enlève une catégorie.
 * @param int $idCategorie : identifiant de la catégorie à enlever
 * @return int : nombre d'enregistrements enlevés
 */
function enlever($idCategorie) {
  $id = (int)$idCategorie;
  $bd = ouvrirConnexion();
  return supprimer($bd, "DELETE FROM categorie WHERE id=$id");
}