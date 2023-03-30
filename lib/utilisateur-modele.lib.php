<?php
/**
 * Manipulation des données des utilisateurs
 */

/**
 * Retourner l'info d'un utilisateur.
 * 
 * @param string $courriel : adresse courriel de l'utilisateur.
 * 
 * @return array : tableau associatif contenant l'info de la table.
 */
function un($courriel) {
  $bd = ouvrirConnexion();
  $courriel = mysqli_real_escape_string($bd, $courriel);
  $sql = "SELECT * FROM utilisateur WHERE courriel = '$courriel'";
  return lire($bd, $sql);
}

