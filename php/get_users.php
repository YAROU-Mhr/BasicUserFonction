<?php


// Inclusion du fichier de connexion à la base de données (bdd.php)
require('bdd.php');



// Définition de la requête SQL pour récupérer tous les utilisateurs de la table 'users'
$sql = "SELECT * FROM users ORDER BY id DESC ";

// Préparation de la requête SQL à être exécutée (cette étape permet de protéger contre les injections SQL)
$result = $bdd->prepare($sql);

// Exécution de la requête SQL préparée
$result->execute();

// Vérification s'il y a des résultats retournés par la requête (nombre de lignes affectées par la dernière requête)
if ($result->rowCount() > 0) {
    // S'il y a des résultats, récupération de toutes les lignes sous forme de tableau associatif
    $users = $result->fetchAll();
} else {
    // Si aucune ligne n'est retournée, initialise la variable $users comme un tableau vide
    $users = [];
}

// Définition de l'en-tête de la réponse HTTP pour indiquer que le contenu est au format JSON
header('Content-Type: application/json');

// Encodage des données des utilisateurs en format JSON et envoi au client
//c'est les informations qui seront affiché dans le tanleau
echo json_encode($users);

?>
