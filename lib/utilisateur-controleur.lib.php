<?php
session_start();

// Cette page est accessible uniquement à un utilisateur connecté
// if(isset($_SESSION['utilisateur'])) {
//   header('Location: categories.php');
// }

require('lib/sql.lib.php');
require('lib/'.$module.'-modele.lib.php');

if(isset($_GET['op'])) {
  switch($_GET['op']) {
    case 'connexion':
      $util = un($_POST['courriel']);
      if($util) {
        if(password_verify($_POST['mdp'], $util['mdp'])) {
          if($util['confirmation'] != '') {
            $codeErreur = 'e1010';
          }
          else if(!$util['actif']) {
            $codeErreur = 'e1020';
          }
          else {
            // On utilise le mécanisme de "session PHP"
            $_SESSION['utilisateur'] = $util;
            // On dirige le browser vers une nouvelle page
            header("Location: categories.php");
          }
        }
        else {
          $codeErreur = 'e1000';
        }
      }
      else {
        $codeErreur = 'e1000';
      }
      if(isset($codeErreur)) {
        header("Location: index.php?m=$codeErreur");
      }
      break;
    case 'deconnexion': 
      // Supprimer la variable de session qui établit l'état de connexion
      unset($_SESSION['utilisateur']);
      // Rediriger vers la page de connexion avec un message confirmant
      // déconnexion
      header('Location: index.php?m=e1030');
      break;
    case 'nouveau':
      // Créer un code de confiramtion 
      $cc = uniqid('leila', true);
      $resultat = nouveau($_POST['nom_complet'], $_POST['courriel'], $_POST['mdp'], $cc);
      // Si l'utilisateur est ajouté, alors il faut envoyer le courriel de 
      // confirmation et afficher le message adéquat dans la page de connexion
      if($resultat) {
        // 1) Envoyer un courriel
        $destinataire = $_POST['courriel'];
        $de = 'admin@restoleila.com';
        $sujet = "Confirmer votre compte Leila Admin";
        $message = "
          <p>Pour compléter l'ouverture de votre compte, cliquez le lien 
          suivant : <a href='http://localhost:8080/leila-admin/index.php?op=confirmation&cc=$cc'>
          http://localhost:8080/leila-admin/index.php?op=confirmation&cc=$cc
          </a>
          <p>
          Équipe Leila Admin
          </p>
        ";
        $entetes = [
          'from' => $de,
          'MIME-Version'  =>  '1.0',
          'Content-Type'  =>  'text/html; charset=utf-8'
        ];
        mail($destinataire, $sujet, $message, $entetes);

        // 2) Rediriger vers le formulaire de connexion
        header('Location: index.php?m=e2000');
      }
      // Sinon, ça implique que le courriel est déjà utilisé par un autre 
      // compte --> Afficher le formulaire d'ouverture de compte avec le message
      // d'erreur adéquat
      else {

      }
      break;
    
    case 'confirmation':
      $confirmation = $_GET['cc'];
      confirmer($confirmation);
      header('Location: index.php?m=e2010');
      break;
    
    case 'mdp_oublie':
    
      break; 
  }
}