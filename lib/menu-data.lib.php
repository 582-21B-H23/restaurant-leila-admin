<?php
/**
 * Manipulation des données du menu des plats du restaurant Leila
 */

/**
 * Cherche les plats du menu groupés par catégorie.
 * 
 * @param boolean $groupe : true si on veut grouper les enregistrements,
 *                          false sinon.
 * 
 * @return array : tableau de tableaux contenant les plats
 */
function lireTout($groupe=false) {
  $bd = ouvrirConnexion();
  $sql = "SELECT 
            c.nom AS nomCategorie,
            p.*
            FROM plat AS p JOIN categorie AS c ON p.id_categorie = c.id
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