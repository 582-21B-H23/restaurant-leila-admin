<?php
session_start();

// Cette page est accessible uniquement à un utilisateur connecté
if(isset($_SESSION['utilisateur'])) {
  header('Location: categories.php');
}

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
      break;
    case 'deconnexion': 
      
      break;
    case 'nouveau':
      
      break;
    
    case 'confirmer':
    
      break;
    
    case 'mdp_oublie':
    
      break; 
  }
}