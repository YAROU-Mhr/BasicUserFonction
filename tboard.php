<?php
//ici on a pas les informations de l'utilisateur
require 'php/security_avec_renvoie.php'; //fichier qui vérifie si il est connecté et nous donne des information 
//ici on a pas les informations de l'utilisateur car maintenant on a requie php/security_avec_renvoie.php
 
//la connection a la base de doné est délà faite dans 'php/security_avec_renvoie.php on répète plus
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require "inc/head.php"; ?>
    <title>Tableau Bord</title>

</head>
<body style="width:100vw; overflow-x:hidden;">
    <div class="container-fluid p-0 m-0">
        <div class="row">
         <!-- 
            la nav est une partie casiment identique dans toute la page alors il suffit d'isoler le code et de l'inclure à chaque fois les liens dans la nav sont par rapport à la page dans laquel elle est incluse et non par rapport au dossier 'inc'
            pour aller vers login on aura dans le fichier nav.php
            <a href="login.php" >Login</a>
            et non
            <a href="../login.php" >Login</a>
        -->
            <?php require('inc/nav.php') ?>
        </div>

        <div class="row">
            <h1>Info profil</h1>
        </div>
       
    </div>


    <script src="assets/bootstrap/js/script.js"></script>
    <script src="assets/icon/js/script.js"></script>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
</body>
</html>