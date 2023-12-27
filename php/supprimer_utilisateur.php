<?php
//inclure le fichier de connexion à la base de données (bdd.php)
require('bdd.php');

// Vérifier si l'ID de l'utilisateur est passé en tant que paramètre POST
if (isset($_POST['id'])) {
    // Préparer et exécuter la requête de suppression
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['id' => $_POST['id']]);

    // Vérifier le succès de la suppression
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Utilisateur supprimé avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Échec de la suppression de l\'utilisateur.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de l\'utilisateur non fourni.']);
}
?>
