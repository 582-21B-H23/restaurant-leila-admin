<?php
/**
 * Manipulation des données de carte des vins du restaurant Leila
 */

/**
 * Cherche les vins.
 * 
 * @param boolean $groupe : true si on veut grouper les vins par catégorie,
 *                          false sinon.
 * 
 * @return array : tableau de tableaux contenant les vins
 */
function lireTout($groupe=false) {
  $bd = ouvrirConnexion();
  // La première colonne sera utilisée pour regrouper les enregistrements
  // obtenu de la requête.
  $sql = "SELECT 
            c.nom AS nomCategorie,
            v.*
            FROM vin AS v JOIN categorie AS c ON v.id_categorie = c.id
            ORDER BY rang, prix";
  $articles = lire($bd, $sql);
  if($groupe) {
    $articlesGroupes = [];
    foreach ($articles as $article) {
      $articlesGroupes[$article['nomCategorie']][] = $article;
    }
    return $articlesGroupes;
  }
  return $articles;
}