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
function un($courriel) 
{
  $bd = ouvrirConnexion();
  $courriel = mysqli_real_escape_string($bd, $courriel);
  $sql = "SELECT * FROM utilisateur WHERE courriel = '$courriel'";
  return lireUn($bd, $sql);
}


function nouveau($nom, $courriel, $mdp, $confirmation) {
  $bd = ouvrirConnexion();
  $nom = mysqli_real_escape_string($bd, $nom);
  $courriel = mysqli_real_escape_string($bd, $courriel);
  $mdp = password_hash($mdp, PASSWORD_DEFAULT);
  $sql = "INSERT INTO utilisateur VALUES (0, '$nom', '$courriel', '$mdp'
          , NOW(), '$confirmation', 0)";
  return creer($bd, $sql);
}


function confirmer($confirmation) {
  $bd = ouvrirConnexion();
  $confirmation = mysqli_real_escape_string($bd, $confirmation);
  $sql = "UPDATE utilisateur SET confirmation='' WHERE confirmation='$confirmation'";
  return modifier($bd, $sql);
}