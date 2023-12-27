<?php
#Fait toujours une seesion start c'est ligne qui permet de savoir si une connection existe ou pas la sécurité viens après
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--  inclusion du contennus du head sui se trouve dans le dossier inc--> 
        <?php require "inc/head.php"; ?>
        <title>Index</title>
     
    </head>

    <body style="width:100vw; overflow-x:hidden;">

        <div class="container-fluid p-0 m-0">
            <div class="row">
                <?php require('inc/nav.php') ?>
            </div>

            <div class="row">
                <h1>Acceuil</h1>
            </div=>
        
        </div>

        <script src="assets/bootstrap/js/script.js"></script>
        <script src="assets/icon/js/script.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    </body>

</html>