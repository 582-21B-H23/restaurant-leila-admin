<?php
session_start();
require('lib/sql.lib.php');
require('lib/'.$module.'-modele.lib.php');

if(isset($_GET['op'])) {
  switch($_GET['op']) {
    case 'connexion':
      $resultat = un($_POST['courriel']);
      if($resultat) {
        $util = $resultat[0];
        if(password_verify($_POST['mdp'], $util['mdp'])) {
          if($util['confirmation'] != '') {
            $codeErreur = 'e1010';
          }
          if(!$util['actif']) {
            $codeErreur = 'e1020';
          }
          
          // Consigner l'information que l'utilisateur est connecté et 
          // le rediriger vers la page aéquate ('categories.php')

          // On utilise le mécanisme de "session PHP"
          $_SESSION['utilisateur'] = $util;

          // On dirige le browser vers une nouvelle page
          header("Location: categories.php");
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