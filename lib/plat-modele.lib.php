<?php
/**
 * Manipulation des données des plats du restaurant Leila
 */

/**
 * Cherche les plats (pour le gestionnaire de contenu).
 * 
 * @return array : tableau de tableaux contenant les plats
 */
function lireTout() {
  $bd = ouvrirConnexion();
  $sql = "SELECT * FROM plat ORDER BY id_categorie ASC, id DESC";
  return lire($bd, $sql);
}

/**
 * Cherche les plats du menu groupés par catégorie.
 * Pour affichage sur le site Web (et non pas dans le gestionnaire de contenu)
 * 
 * @param boolean $groupe : true si on veut grouper les enregistrements,
 *                          false sinon.
 * 
 * @return array : tableau de tableaux contenant les plats
 */
function lireToutSiteWeb($groupe=false) {
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


/**
 * Cherche les catégories de plats  
 *
 * @return array Tableau de tableaux contenant l'information utile sur 
 * les catégories.
 */
function lireCategoriesPlats() {
  $bd = ouvrirConnexion();
  $sql = "SELECT id, nom FROM categorie WHERE id_parent=1";
  return lire($bd, $sql);
}


/**
 * Ajoute un plat.
 *
 * @param  mixed $plat : détail du plat saisit dans le formulaire
 * @return int identifiant du plat inséré dans la BD
 */
function ajouter($plat) {
  $bd = ouvrirConnexion();
  $nom = mysqli_real_escape_string($bd, $plat['nom']);
  $detail = mysqli_real_escape_string($bd, $plat['detail']);
  $portion = (int)$plat['portion'];
  $prix = (float)$plat['prix'];
  $id_categorie = (int)$plat['id_categorie']; 
  $sql = "INSERT INTO plat VALUES (NULL, '$nom', '$detail', $portion, $prix, $id_categorie)";
  return creer($bd, $sql);
}

/**
 * Modifier un plat.
 *
 * @param  mixed $plat : détail du plat saisit dans le formulaire
 * @return int nombre d'enregistrement modifié (ici toujours 1)
 */
function changer($plat) {
  $bd = ouvrirConnexion();
  $id = (int)$plat['id'];
  $nom = mysqli_real_escape_string($bd, $plat['nom']);
  $detail = mysqli_real_escape_string($bd, $plat['detail']);
  $portion = (int)$plat['portion'];
  $prix = (float)$plat['prix'];
  $id_categorie = (int)$plat['id_categorie']; 
  $sql = "UPDATE plat SET 
            nom='$nom', 
            detail='$detail', 
            `portion`=$portion, /* BIZARREMENT : erreur sur le mot 'portion' comme s'il était un mot réservé dans MySQL ??? */
            prix=$prix, 
            id_categorie=$id_categorie 
          WHERE id=$id";
  echo $sql; 
  return modifier($bd, $sql);
}

/**
 * Enlève un plat.
 * @param int $idPlat : identifiant du plat à enlever
 * @return int : nombre d'enregistrements enlevés
 */
function enlever($idPlat) {
  $id = (int)$idPlat;
  $bd = ouvrirConnexion();
  return supprimer($bd, "DELETE FROM plat WHERE id=$id");
}