<?php
// Il est crucial de démarrer la session avant de la détruire
session_start();

// Suppression des variables de session

$_SESSION = array();

// Destruction de la session (supprime le cookie de session sur le navigateur)
session_destroy();

// Redirection vers la page d'accueil ou de connexion
header('Location: index.php');
exit();
?>