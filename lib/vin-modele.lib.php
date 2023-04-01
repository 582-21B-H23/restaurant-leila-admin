<?php
/**
 * Manipulation des données des vins du restaurant Leila
 */

/**
 * Cherche les vins (pour le gestionnaire de contenu).
 * 
 * @return array : tableau de tableaux contenant les vins
 */
function lireTout() {
  $bd = ouvrirConnexion();
  $sql = "SELECT * FROM vin ORDER BY id_categorie ASC, id DESC";
  return lire($bd, $sql);
}

/**
 * Cherche les vins.
 * Pour affichage sur le site Web (et non pas dans le gestionnaire de contenu)
 * 
 * @param boolean $groupe : true si on veut grouper les vins par catégorie,
 *                          false sinon.
 * 
 * @return array : tableau de tableaux contenant les vins
 */
function lireToutSiteWeb($groupe=false) {
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


/**
 * Cherche les catégories de vins  
 *
 * @return array Tableau de tableaux contenant l'information utile sur 
 * les catégories.
 */
function lireCategoriesVins() {
  $bd = ouvrirConnexion();
  $sql = "SELECT id, nom FROM categorie WHERE id_parent=2";
  return lire($bd, $sql);
}


/**
 * Ajoute un vin.
 *
 * @param  mixed $vin : détail du vin saisit dans le formulaire
 * @return int identifiant du plat inséré dans la BD
 */
function ajouter($vin) {
  $bd = ouvrirConnexion();
  $nom = mysqli_real_escape_string($bd, $vin['nom']);
  $detail = mysqli_real_escape_string($bd, $vin['detail']);
  $provenance = mysqli_real_escape_string($bd, $vin['provenance']);
  $prix = (float)$vin['prix'];
  $id_categorie = (int)$vin['id_categorie']; 
  $sql = "INSERT INTO vin VALUES (NULL, '$nom', '$detail', '$provenance', $prix, $id_categorie)";
  return creer($bd, $sql);
}

/**
 * Modifier un vin.
 *
 * @param  mixed $vin : détail du vin saisit dans le formulaire
 * @return int nombre d'enregistrement modifié (ici toujours 1)
 */
function changer($vin) {
  $bd = ouvrirConnexion();
  $id = (int)$vin['id'];
  $nom = mysqli_real_escape_string($bd, $vin['nom']);
  $detail = mysqli_real_escape_string($bd, $vin['detail']);
  $provenance = mysqli_real_escape_string($bd, $vin['provenance']);
  $prix = (float)$vin['prix'];
  $id_categorie = (int)$vin['id_categorie']; 
  $sql = "UPDATE vin SET 
            nom='$nom', 
            detail='$detail', 
            provenance='$provenance', 
            prix=$prix, 
            id_categorie=$id_categorie 
          WHERE id=$id";
  return modifier($bd, $sql);
}

/**
 * Enlève un vin.
 * @param int $idVin : identifiant du vin à enlever
 * @return int : nombre d'enregistrements enlevés
 */
function enlever($idVin) {
  $id = (int)$idVin;
  $bd = ouvrirConnexion();
  return supprimer($bd, "DELETE FROM vin WHERE id=$id");
}