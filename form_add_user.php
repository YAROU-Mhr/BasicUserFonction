<?php
//ici on a pas les informations de l'utilisateur
require 'php/security_avec_renvoie.php'; //fichier qui vérifie si il est connecté et nous donne des information 
//ici on a pas les informations de l'utilisateur car maintenant on a requie php/security_avec_renvoie.php
//la connection a la base de doné est délà faite dans 'php/security_avec_renvoie.php on répète plus

//on vérifie si il est admin  repellez vous role 0 =user, 1 = admin, 2 = editeur selon notre décision

if ($user['role'] != '1') {
    echo "<script>alert('Vous n'êtes pas administrateur !')</script>";
    header("refresh:0.1; url=index.php");
}

//bon si le role n'est pas différent de  la vie continue

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!--  inclusion du contennus du head sui se trouve dans le dossier inc-->
    <?php require "inc/head.php"; ?>
    <title>Ajout d'utilisateur</title>
</head>

<body class="vh-100 vw-100 overflow-hidden bg-primary d-flex align-items-center justify-content-center">


    <div class="card col-md-6">
        <div class="card-body">
            <form action="php/trt_add_user.php" method="post">
                <!-- <h4 class="text-center" >Inscrivez vous !</h4> -->
                <div class="d-flex justify-content-center align-items-center-flex-column">
                    <h1 class="display-1 text-center "><i class="fas fa-users text-primary"></i></h1>
                </div>
                <div class="d-flex justify-content-center align-items-center-flex-column">
                    <h3 class="display-4 fs-1 text-center ">Ajout d'un utlisateurs !</h3>
                </div>
                <!-- nom et prenom -->
                <div class="d-flex col-12">
                    <div class="mb-3 col-6 me-2">
                        <label for="" class="form-label">Nom</label>
                        <input type="text" name="f_nom" id="" class="form-control" required>
                    </div>
                    <div class="mb-3 col-6 me-2">
                        <label for="" class="form-label">Prenom</label>
                        <input type="text" name="f_prenom" id="" class="form-control" required>
                    </div>
                </div>
                <!-- address et téléphone -->
                <div class="d-flex col-12">
                    <div class="mb-3 col-6 me-2">
                        <label for="" class="form-label">Adress</label>
                        <input type="text" name="f_adress" id="" class="form-control">
                    </div>
                    <div class="mb-3 col-6 me-2">
                        <label for="" class="form-label">Téléphone</label>
                        <input type="number" name="f_telephone" id="" class="form-control" >
                    </div>
                </div>
                <!-- mail & role -->
                <div class="d-flex col-12">
                    <div class="mb-3 col-6 me-1">
                        <label for="" class="form-label">Mail</label>
                        <input type="text" name="f_email" id="" class="form-control" required>
                    </div>
                    <div class="mb-3 col-6 me-1">
                        <label for="" class="form-label">Role</label>
                        <select class="form-select  mb-3" name="f_role" >
                            <option value="0">Utilisateur</option>
                            <option value="1">Administrateur</option>
                            <option value="2">Editeur</option>
                        </select>
                    </div>
                </div>

                <!-- mot de pass et confimation -->
                <div class="d-flex col-12">
                    <div class="mb-3 col-6 me-1">
                        <label for="" class="form-label">Mots de passe</label>
                        <input type="password" name="f_mdp" id="" class="form-control" minlength="5" maxlength="10" required>
                    </div>
                    <div class="mb-3 col-6 me-1">
                        <label for="" class="form-label">Confirmer mot de passe</label>
                        <input type="password" name="f_cmdp" id="" class="form-control" minlength="5" maxlength="10" required>
                    </div>
                </div>

                <button class="btn btn-primary w-100" type="submit" name="btn_ajouter">Ajouter</button>
            </form>

        </div>
    </div>

    <script src="assets/bootstrap/js/script.js"></script>
    <script src="assets/icon/js/script.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
</body>

</html>