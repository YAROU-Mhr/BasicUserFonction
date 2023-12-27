<?php
# Page de traitement d'btn_modifier
if (isset($_POST['btn_modifier'])) {
    # Si le bouton de modification est initialisé

    # J'appelle la connexion à la base de données
    require('bdd.php');

    # Récupération des variables du formulaire
    $id =  $_POST['user_id'];;
    $nom = htmlspecialchars($_POST['f_nom']);
    $prenom = htmlspecialchars($_POST['f_prenom']);
    $adress = htmlspecialchars($_POST['f_adress']);
    $telephone = htmlspecialchars($_POST['f_telephone']);
    $role = htmlspecialchars($_POST['f_role']);
    $email = htmlspecialchars($_POST['f_email']);
    $mdp = htmlspecialchars($_POST['f_mdp']);
    $cmdp = htmlspecialchars($_POST['f_cmdp']);

    # Vérification si l'utilisateur existe déjà dans la base de données
    $select = "SELECT * FROM users WHERE  id = ?";
    $stmt = $bdd->prepare($select);
    $stmt->execute([$id]);

    $user_a_modifier = $stmt->fetch();
    $ancienMdp =  $user_a_modifier['mdp'];

    if ($stmt->rowCount() === 1) {
        # Si la requête renvoie strictement un utilisateur, ces coordonnées existe

        # Vérification si les mots de passe concordent
        if ($mdp == $cmdp) {
            # Cryptage du mot de passe s'il est fourni dans le formulaire
            $mdpHash = ($mdp !== "")   // s'il est fourni dans le formulaire Vérifie si le mot de passe n'est pas une chaîne vide
                ? password_hash($mdp, PASSWORD_DEFAULT)   // Si vrai, hache le mot de passe avec l'algorithme par défaut de PHP
                : $ancienMdp;   // Si faux (mot de passe est une chaîne vide), utilise l'ancien mot de passe


            // die(var_dump($nom, $prenom, $email, $telephone, $adress, $role, $mdpHash, $id, $mdp));
            # Requête de mise à jour dans laquelle on met à jour les champs avec les nouvelles valeurs
            // Requête de mise à jour
            $update = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', telephone='$telephone', adresse='$adress', role='$role', mdp='$mdpHash' WHERE id='$id'";
            $stmt = $bdd->prepare($update);


            // Exécution de la requête avec le mot de passe haché
            $stmt->execute();


            if ($stmt) {
                # Si la requête réussit, redirection vers la liste des utilisateurs avec un message de succès
                echo "<script>alert('Mise à jour effectuée')</script>";
                header("refresh:0.1; url=../liste.php");
            } else {
                # Si la requête échoue, redirection vers le formulaire de modification avec un message d'échec
                echo "<script>alert('Échec de la requête de mise à jour')</script>";
                header("refresh:0.1; url=../form_update_user.php?id=" . $id);
            }
        } else {
            # Si les mots de passe ne concordent pas, redirection vers le formulaire de modification avec un message d'erreur
            echo "<script>alert('Les mots de passe ne sont pas identiques')</script>";
            header("refresh:0.1; url=../form_update_user.php?id=" . $id);
        }
    } else {

        # Si les mots de passe ne concordent pas, redirection vers le formulaire de modification avec un message d'erreur
        # Si la requête renvoie un résultat, ces coordonnées n'existe pas

        echo "<script>alert('L\'utilisateur  $id n'a pas été retrouvé ')</script>";
        header("refresh:0.1; url=../form_update_user.php?id=" . $id);
    }
} else {

    die('mhr error');
    # Si le bouton n'est pas initialisé, redirection vers la page de modification pour éviter les accès directs
    header("location:../form_update_user.php");
}
