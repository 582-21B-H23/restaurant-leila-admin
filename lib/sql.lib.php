<?php
/**
 * Librairie de code pour manipulation des données MySQL
 * (utilisant la librairie MySQLi de PHP)
 */
require_once('/config/21b-h23-leila.cfg.php');

function ouvrirConnexion() {
  $cnx = mysqli_connect(BD_HOTE, BD_UTIL, BD_MDP, BD_NOM);
  mysqli_set_charset($cnx, BD_CHARSET);
  return $cnx;
}

function soumettreRequete($cnx, $req) {
  return mysqli_query($cnx, $req);
}

// Les 4 opérations CRUD


/**
 * Exécute une requête SQL de type SELECT
 *
 * @param  MySQLi $cnx : identifiant de connexion MySQLi obtenu préalablement
 * @param  string $req : requête SQL SELECT
 * @param  int $mode : constante pour indiquer si on veut un tableau 
 *              associatif (par défaut) ou autre
 * @see https://www.php.net/manual/en/mysqli-result.fetch-all.php
 * 
 * @return array|boolean : 
 */
function lire($cnx, $req, $mode=MYSQLI_ASSOC) {
  $resultat = soumettreRequete($cnx, $req);
  if($resultat) {
    return mysqli_fetch_all($resultat, $mode);
  }
  return false;
}

function creer($cnx, $req) {
  $resultat = soumettreRequete($cnx, $req);
  // Si l'insertion réussie, retourner l'identifiant de cette insertion
  if($resultat) {
    return mysqli_insert_id($cnx);
  }
}

function modifier($cnx, $req) {
  $resultat = soumettreRequete($cnx, $req);
  if($resultat) {
    return mysqli_affected_rows($cnx);
  }
  return false;
}

function supprimer($cnx, $req) {
  return modifier($cnx, $req);
}