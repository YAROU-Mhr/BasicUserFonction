<?php
 require 'php/bdd.php';//appel à la base de donné pour usage de '$bdd'
 session_start(); //allumage de la sessiont
 
 //vérification pour l'empêcher d'atteindre la page étant connecté
 // isset($_SESSION['id_user']) veut dire que la session existe
 // !empty($_SESSION['id_user'] veut dire que la session n'est pas vide
 if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
    echo"<script>alert('Vous êtes déjà connecté !')</script>";
    header("refresh:0.1; url=index.php");
 }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
     <!--  inclusion du contennus du head sui se trouve dans le dossier inc--> 
    <?php require "inc/head.php"; ?>
    <title>Login</title>
</head>
<body class="vh-100 vw-100 overflow-hidden bg-primary d-flex align-items-center justify-content-center">

    
    <div class="card col-md-4">
        <div class="card-body">
            <form action="php/trt_login.php" method="post">
                <div class="d-flex justify-content-center align-items-center-flex-column">
                    <h1 class="display-1 text-center "><i class="fas fa-comments text-primary"></i></h1>            
                </div>
                <div class="d-flex justify-content-center align-items-center-flex-column">
                    <h3 class="display-4 fs-1 text-center ">Connectez vous !</h3>                
                </div>
                
                <!-- mail -->
                <div class="mb-3">
                    <label for="" class="form-label">Mail</label>
                    <input type="email" name="f_email" id="" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Mots de passe</label>
                    <input type="password" name="f_mdp" id="" class="form-control" minlength="5" maxlength="10" required >
                </div>
                 

                <button class="btn btn-primary w-100" type="submit" name="btn_connexion">Se connecter</button>
            </form>

                <p class="pt-2">Vous n'avez pas un compte? <a href="register.php">Inscrivez vous!</a></p>
        </div>
    </div>

    <script src="assets/bootstrap/js/script.js"></script>
    <script src="assets/icon/js/script.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
</body>
</html>